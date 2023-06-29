<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Form\CalculatorType;
use App\Services\PhoneService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalculatorController extends AbstractController
{
    #[Route('/calculator', name: 'app_calculator')]
    public function index(
        Request $request, 
        PhoneService $phoneService, 
        EntityManagerInterface $entityManager,
        ): Response
    {
        $Phone = new Phone();

        $form = $this->createForm(CalculatorType::class, $Phone);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $brand = $data->getBrand();
            $internalmemory = $data->getInternalmemory();
            $ram = $data->getRam();
            $date = $data->getReleaseYear();
            if ($date instanceof \DateTimeInterface) {
                $releaseYear = $date->format('Y');
            }
            $result = $phoneService->calculerPrixTelephone($brand, $internalmemory, $ram, $releaseYear);

            $entityManager->persist($Phone);
            $entityManager->flush();

            $this->addFlash('success', 'L\'estimation a été validée avec succès !✅');

            return $this->render('calculator/result.html.twig', [
                'result' => $result,
                'phone' => $Phone,
            ]);
        }

        return $this->render('calculator/index.html.twig', [
            'CalculatorForm' => $form->createView(),
        ]);
    }
}
