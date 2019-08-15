<?php declare(strict_types=1);

/**
 * This file is part of the Zuora PHP API Client, a PHP Experts, Inc., Project.
 *
 * Copyright © 2019 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *  GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *  https://www.phpexperts.pro/
 *  https://github.com/phpexpertsinc/Zuora-API-Client
 *
 * This file is licensed under the MIT License.
 */

namespace PHPExperts\ZuoraClient\Helpers;

use PHPExperts\SimpleDTO\SimpleDTO;

trait Cachable
{
    /** @var string */
    private $cachedDTOClass;

    private function setCachedDTOClass(string $dtoClass): void
    {
        $this->cachedDTOClass = $dtoClass;
    }

    private function getCachedFilename(string $id = null): string
    {
        $self = $this->cachedDTOClass;
        if (!$self) {
            throw new \LogicException('setCachedDTOClass() must be called first.');
        }

        $self = str_replace('\\', '_', $self);
        $id = $id !== null ? "-$id" : '';
        $filename = sys_get_temp_dir() . "/$self$id.log";

        return $filename;
    }

    private function cache(SimpleDTO $dto, string $id = null)
    {
        $this->cachedDTOClass = get_class($dto);
        $filename = $this->getCachedFilename($id);
        file_put_contents($filename, serialize($dto));
    }

    /**
     * @param int         $ttl Time in minutes.
     * @param string|null $id
     * @return null|SimpleDTO
     */
    private function fetchCache(int $ttl, string $id = null): ?SimpleDTO
    {
        $filename = $this->getCachedFilename($id);

        if (!is_readable($filename) || filemtime($filename) < time() - ($ttl * 60)) {
            return null;
        }

        try {
            $data = file_get_contents($filename);

            return unserialize($data);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
