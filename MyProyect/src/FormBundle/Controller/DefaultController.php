<?php

namespace FormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use FormBundle\Entity\Usuario;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $usuario = new Usuario();
        
        $form = $this->createFormBuilder($usuario)
                
            ->add('nombre', TextType::class)
            ->add('apellido', TextType::class)
            ->add('celular', TextType::class)
            ->add('correo', TextType::class)
            ->add('ciudad', TextType::class)
            ->getForm();

         $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
       
        $usuario = $form->getData();

     
       
        $em = $this->getDoctrine()->getManager();
        $em->persist($usuario);
        $em->flush();

        //return $this->redirectToRoute('task_success');
    }
        
        return $this->render('FormBundle:Default:index.html.twig' , array(
        'form' => $form->createView(),));
    }
}
