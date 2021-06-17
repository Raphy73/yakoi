<?php
namespace App\Controller;

use App\Entity\Availability;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class CustomerController extends AbstractController
{
    /**
     * @Route("/", name="home_customer")
     */
    public function customerHomepage(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Product::class);
        $products = $repository->findAllProducts();

        return $this->render('customer/homepage.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/inscription", name="signin")
     */
    public function signIn(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $signIn = $form->getData();
            // $signIn->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            $signIn->setRoles(["ROLE_USER"]);
            $entityManager->persist($signIn);
            $entityManager->flush();

            return $this->redirectToRoute("app_login");
        }

        return $this->render('customer/signin.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/produit/{id<\d+>}", name="product", methods={"GET"})
     */
    public function product($id, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Product::class);
        $product = $repository->find($id);

        return $this->render('customer/product-page.html.twig', [
            'product' => $product,
        ]);
    }
}