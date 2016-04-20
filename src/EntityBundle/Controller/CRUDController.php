<?php

namespace EntityBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EntityBundle\Entity\Product;

class CRUDController extends Controller
{
    public function creatAction($name, $category, $description)
    {
        $product = new Product();
        $product->setName($name);
        $product->setCategory($category);
        $product->setDescription($description);
        $product->setCreationDate(date('d-m-Y'));
        $product->setCode($code);

        $em->flush();
        return $this->render('EntityBundle:Default:index.html.twig');
    }


    public function updateAction($productId, $name, $category, $description)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('EntityBundle:Product')->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $productId
            );
        }

        $product->setName($name);
        $product->setCategory($category);
        $product->setDescription($description);

        $em->flush();
        return $this->render('EntityBundle:Default:index.html.twig');
    }

    public function deleteAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('EntityBundle:Product')->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $productId
            );
        }

        $em->remove($product);
        $em->flush();
        return $this->render('EntityBundle:Default:index.html.twig');
    }

    public function readAction()
    {
        $products = $this->getDoctrine()->getRepository('EntityBundle:Product')->findAll();
        var_dump($products);
        return $this->render('EntityBundle:Default:index.html.twig');
    }
}