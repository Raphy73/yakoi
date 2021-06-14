<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}