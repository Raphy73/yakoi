<?php
namespace App\Controller;

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
    public function customerHomepage()
    {
        return $this->render('customer/homepage.html.twig', [

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

            return $this->redirectToRoute("home_customer");
        }

        return $this->render('customer/signin.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/produit/{id<\d+>}", name="product")
     */
    public function product($id)
    {
        return $this->render('customer/product-page.html.twig', [

        ]);
    }
}