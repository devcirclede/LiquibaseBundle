<?php

declare(strict_types=1);

namespace Freesoftde\LiquibaseBundle\Service;

use InvalidArgumentException;
use RuntimeException;

class LiquibaseDownload
{

    private const LIQUIBASE_URL = 'https://github.com/liquibase/liquibase/releases/tag/v%1$s/liquibase-%1$s.jar';

    public function download(string $version, string $path): bool
    {
        if (empty($version) || !preg_match('/^\d+\.\d+\.\d+$/', $version)) {
            throw new InvalidArgumentException('Version is not valid');
        }
        if (!is_dir($path)) {
            throw new RuntimeException(sprintf('Directory "%s" does not exist.', $path));
        }
        $versionPath = $path . $version . DIRECTORY_SEPARATOR;
        if (!mkdir($versionPath) && !is_dir($versionPath)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $versionPath));
        }
        $destination = $versionPath . 'liquibase.jar';
        $responseCode = $this->saveLiquibaseJar(
            $destination,
            sprintf(self::LIQUIBASE_URL, $version)
        );

        return 200 === $responseCode;
    }

    /**
     * @param  string $destination
     * @param  string $url
     * @return int
     */
    public function saveLiquibaseJar(string $destination, string $url): int
    {
        $fh = fopen($destination, 'wb');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FILE, $fh);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // this will follow redirects
        curl_setopt(
            $ch,
            CURLOPT_USERAGENT,
            'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1'
        );
        curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        fclose($fh);

        return $responseCode;
    }
}