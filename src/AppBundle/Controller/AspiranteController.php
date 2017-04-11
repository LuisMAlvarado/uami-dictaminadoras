<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Aspirante;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Aspirante controller.
 *
 * @Route("aspirante")
 */
class AspiranteController extends Controller
{
    /**
     * Lists all aspirante entities.
     *
     * @Route("/", name="aspirante_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $aspirantes = $em->getRepository('AppBundle:Aspirante')->findAll();

        return $this->render('aspirante/index.html.twig', array(
            'aspirantes' => $aspirantes,
        ));
    }

    /**
     * Creates a new aspirante entity.
     *
     * @Route("/new", name="aspirante_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $aspirante = new Aspirante();
        $form = $this->createForm('AppBundle\Form\AspiranteType', $aspirante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aspirante);
            $em->flush($aspirante);

            return $this->redirectToRoute('aspirante_show', array('id' => $aspirante->getRfc()));
        }

        return $this->render('aspirante/new.html.twig', array(
            'aspirante' => $aspirante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a aspirante entity.
     *
     * @Route("/{id}", name="aspirante_show")
     * @Method("GET")
     */
    public function showAction(Aspirante $aspirante)
    {
        $deleteForm = $this->createDeleteForm($aspirante);

        return $this->render('aspirante/show.html.twig', array(
            'aspirante' => $aspirante,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing aspirante entity.
     *
     * @Route("/{id}/edit", name="aspirante_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Aspirante $aspirante)
    {
        $deleteForm = $this->createDeleteForm($aspirante);
        $editForm = $this->createForm('AppBundle\Form\AspiranteType', $aspirante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('aspirante_edit', array('id' => $aspirante->getRfc()));
        }

        return $this->render('aspirante/edit.html.twig', array(
            'aspirante' => $aspirante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a aspirante entity.
     *
     * @Route("/{id}", name="aspirante_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Aspirante $aspirante)
    {
        $form = $this->createDeleteForm($aspirante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aspirante);
            $em->flush($aspirante);
        }

        return $this->redirectToRoute('aspirante_index');
    }

    /**
     * Creates a form to delete a aspirante entity.
     *
     * @param Aspirante $aspirante The aspirante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Aspirante $aspirante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aspirante_delete', array('id' => $aspirante->getRfc())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
