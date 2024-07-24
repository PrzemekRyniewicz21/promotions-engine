<?php

namespace App\Service\Logger;

use Symfony\Component\HttpKernel\Log\Logger;

class DebugLogger extends Logger
{
    public function log($level, $message, array $context = array()): void
    {
        // Tutaj możesz dodać dowolną logikę zapisu do pliku
        $logMessage = sprintf('[%s] %s', strtoupper($level), $message);

        // Zapisz do pliku w var/log/your_custom_log_file.log
        file_put_contents($this->getLogFile(), $logMessage . PHP_EOL, FILE_APPEND);
    }

    private function getLogFile()
    {
        // Określ nazwę pliku logu i ścieżkę
        return sprintf('%s/%s.log', $this->getLogDir(), 'logi');
    }

    private function getLogDir()
    {
        // Pobierz katalog logów Symfony (var/log)
        return dirname(__DIR__) . '/var/log';
    }
}
