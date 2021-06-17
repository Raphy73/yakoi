<?php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\CategoryType;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Product::class);
        $products = $repository->findAllProducts();

        return $this->render('admin/admin.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/admin/ajouter-produit", name="ajouter-produit")
     */
    public function addProduct(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ProductType::class);

        $form->handleRequest($request);

        $repository = $entityManager->getRepository(Product::class);
        $products = $repository->findAllProducts();

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute("admin", [
                'products' => $products,
            ]);
        }

        return $this->render('admin/new-product.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/supprimer-produit/{id<\d+>}", name="delete_product")
     */
    public function deleteProduct(EntityManagerInterface $entityManager, $id)
    {
        $repository = $entityManager->getRepository(Product::class);
        $productToDelete = $repository->find($id);
        $entityManager->remove($productToDelete);
        $entityManager->flush();

        $products = $repository->findAllProducts();

        return $this->render('admin/admin.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/admin/edit-product/{id<\d+>}", name="edit_product")
     */
    public function editProduct(Request $request, EntityManagerInterface $entityManager, $id)
    {
        $repository = $entityManager->getRepository(Product::class);
        $productToEdit = $repository->find($id);

        $form = $this->createForm(ProductType::class, $productToEdit);
        $form->handleRequest($request);

        $products = $repository->findAllProducts();

        if ($form->isSubmitted() && $form->isValid()) {
            $editProduct = $form->getData();
            $entityManager->persist($editProduct);
            $entityManager->flush();

            return $this->redirectToRoute("admin", [
                'products' => $products,
            ]);
        }

        return $this->render('admin/edit-product.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/categories", name="categories")
     */
    public function categories(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Category::class);
        $categories = $repository->findAllCategories();

        return $this->render('admin/category.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/supprimer-categorie/{id<\d+>}", name="delete_category")
     */
    public function deleteCategory(EntityManagerInterface $entityManager, $id)
    {
        $repository = $entityManager->getRepository(Category::class);
        $categoryToDelete = $repository->find($id);
        $entityManager->remove($categoryToDelete);
        $entityManager->flush();

        $categories = $repository->findAllCategories();

        return $this->render('admin/category.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/admin/ajouter-categorie", name="add_category")
     */
    public function ajouterCategory(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);

        $repository = $entityManager->getRepository(Category::class);
        $categories = $repository->findAllCategories();

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute("categories", [
                'categories' => $categories,
            ]);
        }

        return $this->render('admin/new-category.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}