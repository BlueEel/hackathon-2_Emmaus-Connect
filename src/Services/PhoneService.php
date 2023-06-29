<?php

namespace App\Services;

use App\Repository\PhoneRepository;

class PhoneService
{
    public function __construct(PhoneRepository $phoneRepository)
    {
        $this->PhoneRepository = $phoneRepository;
    }

    public function calculerPrixTelephone(string $brand, string $internalmemory, int $ram, string $releaseYear): int
    {
        $prixBase = 350;

        switch ($brand) {
            case 'Apple':
                $prixBase += 200;
                break;
            case 'Samsung':
                $prixBase += 150;
                break;
            case 'Huawei':
                $prixBase += 100;
                break;
            default:
                $prixBase += 50;
                break;
        }

        if ($internalmemory >= 64 && $internalmemory <= 128) {
            $prixBase += 50;
        } elseif ($internalmemory > 128) {
            $prixBase += 100;
        }

        if ($ram >= 4 && $ram <= 6) {
            $prixBase += 50;
        } elseif ($ram > 6) {
            $prixBase += 100;
        }

        $anneeActuelle = date('Y');
        $anneesDifference = $anneeActuelle - $releaseYear;

        if ($anneesDifference <= 1) {
            $prixBase += 100;
        } elseif ($anneesDifference > 1 && $anneesDifference <= 2) {
            $prixBase += 50;
        } elseif ($anneesDifference > 2 && $anneesDifference <= 3) {
            $prixBase += 25;
        } else {
            $prixBase -= 0;
        }

        return $prixBase;
    }
}
