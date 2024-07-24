<?php

namespace App\Controller;

<<<<<<< HEAD
=======
use App\Cache\PromotionCache;
>>>>>>> dev
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
<<<<<<< HEAD
=======
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
>>>>>>> dev

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
<<<<<<< HEAD
=======
        PromotionCache $promotionCache,
>>>>>>> dev
    ): Response {

        if ($request->headers->has('force_fail')) {
            return new JsonResponse(
                ['error' => 'Promotions engine error msg'],
                $request->headers->get('force_fail')
            );
        }


        // 1. Deserializacja danych json w obiekt EnquiryDTO
<<<<<<< HEAD
        /** @var LowestPriceEnquiry $lowestPriceEnquiry */
=======
>>>>>>> dev
        $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, 'json');

        $product = $this->repository->find($id); // TODO obsluga przypadku braku znalezienia produktu

        $lowestPriceEnquiry->setProduct($product);

<<<<<<< HEAD
        // var_dump($lowestPriceEnquiry->getRequestDate());
        // dd(date_create_immutable($lowestPriceEnquiry->getRequestDate()));

        $promotions = $this->entityMenager->getRepository(Promotion::class)->getValidPromotionsForProduct(
            $product,
            date_create_immutable($lowestPriceEnquiry->getRequestDate()),
        );

        // dd($promotions);
=======
        $promotions = $promotionCache->findValidPromotionForProduct($product, $lowestPriceEnquiry->getRequestDate());
>>>>>>> dev

        // 2. Przekazanie Enquiry do filtra promocji, oraz promocji, ktore maja zostac apply do naszego enquiry
        $modifiedEnquiry = $promotionsHandler->apply($lowestPriceEnquiry, ...$promotions);


        $reponse = $serializer->serialize($modifiedEnquiry, 'json');

        return new Response($reponse, 200, ['Content-Type' => 'application/json']);
    }
}
