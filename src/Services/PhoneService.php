<?php

namespace App\Services;

use App\Repository\PhoneRepository;

class PhoneService
{
    public function __construct(PhoneRepository $phoneRepository)
    {
        $this->PhoneRepository = $phoneRepository;
    }

    public function calculerPrixTelephone(string $brand, string $internalmemory, int $ram, string $releaseYear, string $status): int
    {
        $prixBase = 350;
        $pourcentageDeee= 0;
        $pourcentageReparable= 0.5;
        $pourcentageBloque= 0.90;
        $pourcentageReconditionable= 0.95;

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
            case 'Android':
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
        } elseif ($internalmemory < 64) {
            $prixBase += 25;
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

        if ($status === 'DEEE') {
            $prixBase *= $pourcentageDeee;
        } elseif ($status === 'REPARABLE') {
            $prixBase *= $pourcentageReparable;
        } elseif ($status === 'BLOQUE') {
            $prixBase *= $pourcentageBloque;
        }elseif ($status === ' RECONDITIONABLE') {
            $prixBase *= $pourcentageReconditionable;
        }elseif ($status === 'RECONDITIONNE') {
            $prixBase *= (1);
        }

        return $prixBase;
    }
}
