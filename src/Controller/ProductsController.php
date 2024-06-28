<?php

namespace App\Controller;

use App\Cache\PromotionCache;
use App\DTO\LowestPriceEnquiry;
use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;
use App\Filter\PromotionsHandlerInterface;
use App\Repository\ProductRepository;
use App\Repository\PromotionRepository;
use App\Service\Serializer\DTOSerializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class ProductController extends AbstractController
{

    public function __construct(
        private ProductRepository $repository,
        private EntityManagerInterface $entityMenager,
    ) {
    }

    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: ['POST'])]
    public function lowestPrice(
        Request $request,
        int $id,
        DTOSerializer $serializer,
        PromotionsHandlerInterface $promotionsHandler,
        PromotionCache $promotionCache,
    ): Response {

        if ($request->headers->has('force_fail')) {
            return new JsonResponse(
                ['error' => 'Promotions engine error msg'],
                $request->headers->get('force_fail')
            );
        }


        // 1. Deserializacja danych json w obiekt EnquiryDTO
        $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, 'json');

        $product = $this->repository->find($id); // TODO obsluga przypadku braku znalezienia produktu

        $lowestPriceEnquiry->setProduct($product);

        $promotions = $promotionCache->findValidPromotionForProduct($product, $lowestPriceEnquiry->getRequestDate());

        // 2. Przekazanie Enquiry do filtra promocji, oraz promocji, ktore maja zostac apply do naszego enquiry
        $modifiedEnquiry = $promotionsHandler->apply($lowestPriceEnquiry, ...$promotions);


        $reponse = $serializer->serialize($modifiedEnquiry, 'json');

        return new Response($reponse, 200, ['Content-Type' => 'application/json']);
    }
}
