<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dictamen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Dictamen controller.
 *
 * @Route("dictamen")
 */
class DictamenController extends Controller
{
    /**
     * Lists all Dictamen entities.
     *
     * @Route("/", name="dictamen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dictamens = $em->getRepository('AppBundle:Dictamen')->findAll();

        return $this->render('dictamen/index.html.twig', array(
            'dictamens' => $dictamens,
        ));
    }

    /**
     * Creates a new Dictamen entity.
     *
     * @Route("/new", name="dictamen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $dictaman = new Dictamen();
        $form = $this->createForm('AppBundle\Form\DictamenType', $dictaman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dictaman);
            $em->flush($dictaman);

            return $this->redirectToRoute('dictamen_show', array('id' => $dictaman->getId()));
        }

        return $this->render('dictamen/new.html.twig', array(
            'dictaman' => $dictaman,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Dictamen entity.
     *
     * @Route("/{id}", name="dictamen_show")
     * @Method("GET")
     */
    public function showAction(Dictamen $dictaman)
    {
        $deleteForm = $this->createDeleteForm($dictaman);

        return $this->render('dictamen/show.html.twig', array(
            'dictaman' => $dictaman,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Dictamen entity.
     *
     * @Route("/{id}/edit", name="dictamen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Dictamen $dictaman)
    {
        $deleteForm = $this->createDeleteForm($dictaman);
        $editForm = $this->createForm('AppBundle\Form\DictamenType', $dictaman);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dictamen_edit', array('id' => $dictaman->getId()));
        }

        return $this->render('dictamen/edit.html.twig', array(
            'dictaman' => $dictaman,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Dictamen entity.
     *
     * @Route("/{id}", name="dictamen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Dictamen $dictaman)
    {
        $form = $this->createDeleteForm($dictaman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dictaman);
            $em->flush($dictaman);
        }

        return $this->redirectToRoute('dictamen_index');
    }

    /**
     * Creates a form to delete a dictaman entity.
     *
     * @param Dictamen $dictaman The Dictamen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Dictamen $dictaman)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dictamen_delete', array('id' => $dictaman->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
