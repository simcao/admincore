<?php

namespace App\AdminCore\Controller;

use App\AdminCore\Entity\Product;
use App\AdminCore\Form\ProductType;
use App\AdminCore\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository
    )
    {}

    #[Route('/admin/produits', name: 'admin_core_product')]
    public function index(): Response
    {
        return $this->render('admincore/pages/product/index.html.twig', [
            'products' => $this->productRepository->findAll()
        ]);
    }

    #[Route('/admin/produits/nouveau-produit', name: 'admin_core_product_add')]
    public function add(Request $request): Response
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $product = $form->getData();
            $this->productRepository->save($product, true);

            $this->addFlash("success", "Le produit a été enregistré avec succès.");
        }

        return $this->render('admincore/forms/index.html.twig', [
            'form' => $form
        ]);
    }
}