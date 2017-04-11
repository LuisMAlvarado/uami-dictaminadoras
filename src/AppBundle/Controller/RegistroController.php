<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Registro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Registro controller.
 *
 * @Route("registro")
 */
class RegistroController extends Controller
{
    /**
     * Lists all registro entities.
     *
     * @Route("/", name="registro_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $registros = $em->getRepository('AppBundle:Registro')->findAll();

        return $this->render('registro/index.html.twig', array(
            'registros' => $registros,
        ));
    }

    /**
     * Creates a new registro entity.
     *
     * @Route("/new", name="registro_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $registro = new Registro();
        $form = $this->createForm('AppBundle\Form\RegistroType', $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush($registro);

            return $this->redirectToRoute('registro_show', array('id' => $registro->getId()));
        }

        return $this->render('registro/new.html.twig', array(
            'registro' => $registro,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a registro entity.
     *
     * @Route("/{id}", name="registro_show")
     * @Method("GET")
     */
    public function showAction(Registro $registro)
    {
        $deleteForm = $this->createDeleteForm($registro);

        return $this->render('registro/show.html.twig', array(
            'registro' => $registro,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing registro entity.
     *
     * @Route("/{id}/edit", name="registro_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Registro $registro)
    {
        $deleteForm = $this->createDeleteForm($registro);
        $editForm = $this->createForm('AppBundle\Form\RegistroType', $registro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('registro_edit', array('id' => $registro->getId()));
        }

        return $this->render('registro/edit.html.twig', array(
            'registro' => $registro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a registro entity.
     *
     * @Route("/{id}", name="registro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Registro $registro)
    {
        $form = $this->createDeleteForm($registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($registro);
            $em->flush($registro);
        }

        return $this->redirectToRoute('registro_index');
    }

    /**
     * Creates a form to delete a registro entity.
     *
     * @param Registro $registro The registro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Registro $registro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registro_delete', array('id' => $registro->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
