<?php

namespace adminBundle\Controller;

use adminBundle\Entity\category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Category controller.
 *
 * @Route("category")
 */
class categoryController extends Controller
{
    /**
     * Lists all category entities.
     *
     * @Route("/", name="category_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('adminBundle:category')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        $categories, /* query NOT result */
        $request->query->getInt('page', 1)/*page number*/,
        10/*limit per page*/
        );


        return $this->render('category/index.html.twig', array(
            'categories' => $pagination,
        ));
    }

    /**
     * Creates a new category entity.
     *
     * @Route("/new", name="category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $category->setCreateAt(new \DateTime());      
       
        $form = $this->createForm('adminBundle\Form\categoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush($category);
            $this->addFlash('success','La nouvelle categorie : '.$category->getLibelle().' a ete ajouter avec succes');
            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category entity.
     *
     * @Route("/{id}", name="category_show")
     * @Method("GET")
     */
    public function showAction(category $category)
    {
        $deleteForm = $this->createDeleteForm($category);

        return $this->render('category/show.html.twig', array(
            'category' => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     * @Route("/{id}/edit", name="category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('adminBundle\Form\categoryType', $category);
         $category->setUpdateAt(new \DateTime());     
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','La nouvelle categorie :'.$category->getLibelle().' a ete modifier avec succes');
             return $this->redirectToRoute('category_index');

        }

        return $this->render('category/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),



        ));
       
    }

    /**
     * Deletes a category entity.
     *
     * @Route("/{id}", name="category_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, category $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush($category);
            $this->addFlash('success','La nouvelle categorie : '.$category->getLibelle().' a ete supprimer avec succes');
        }

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a category entity.
     *
     * @param category $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
