<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Archivo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Archivo controller.
 *
 * @Route("archivo")
 */
class ArchivoController extends Controller
{
    /**
     * Lists all archivo entities.
     *
     * @Route("/", name="archivo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $archivos = $em->getRepository('AppBundle:Archivo')->findAll();

        return $this->render('archivo/index.html.twig', array(
            'archivos' => $archivos,
        ));
    }

    /**
     * Creates a new archivo entity.
     *
     * @Route("/new", name="archivo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $archivo = new Archivo();
        $form = $this->createForm('AppBundle\Form\ArchivoType', $archivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($archivo);
            $em->flush($archivo);

            return $this->redirectToRoute('archivo_show', array('id' => $archivo->getId()));
        }

        return $this->render('archivo/new.html.twig', array(
            'archivo' => $archivo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a archivo entity.
     *
     * @Route("/{id}", name="archivo_show")
     * @Method("GET")
     */
    public function showAction(Archivo $archivo)
    {
        $deleteForm = $this->createDeleteForm($archivo);

        return $this->render('archivo/show.html.twig', array(
            'archivo' => $archivo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing archivo entity.
     *
     * @Route("/{id}/edit", name="archivo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Archivo $archivo)
    {
        $deleteForm = $this->createDeleteForm($archivo);
        $editForm = $this->createForm('AppBundle\Form\ArchivoType', $archivo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('archivo_edit', array('id' => $archivo->getId()));
        }

        return $this->render('archivo/edit.html.twig', array(
            'archivo' => $archivo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a archivo entity.
     *
     * @Route("/{id}", name="archivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Archivo $archivo)
    {
        $form = $this->createDeleteForm($archivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($archivo);
            $em->flush($archivo);
        }

        return $this->redirectToRoute('archivo_index');
    }

    /**
     * Creates a form to delete a archivo entity.
     *
     * @param Archivo $archivo The archivo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Archivo $archivo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('archivo_delete', array('id' => $archivo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
