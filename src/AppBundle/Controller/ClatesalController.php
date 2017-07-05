<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Clatesal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Clatesal controller.
 *
 * @Route("clatesal")
 */
class ClatesalController extends Controller
{
    /**
     * Lists all clatesal entities.
     *
     * @Route("/", name="clatesal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clatesals = $em->getRepository('AppBundle:Clatesal')->findAll();

        return $this->render('clatesal/index.html.twig', array(
            'clatesals' => $clatesals,
        ));
    }

    /**
     * Creates a new clatesal entity.
     *
     * @Route("/new", name="clatesal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $clatesal = new Clatesal();
        $form = $this->createForm('AppBundle\Form\ClatesalType', $clatesal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($clatesal);
            $em->flush($clatesal);

            return $this->redirectToRoute('clatesal_show', array(

                'clasificacion' => $clatesal->getClasificacion()->getId(),
                'categoria'=>$clatesal->getCategoria()->getId(),
                'tiempoDedicacion'=>$clatesal->getTiempoDedicacion()->getId(),

                ));
        }

        return $this->render('clatesal/new.html.twig', array(
            'clatesal' => $clatesal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a clatesal entity.
     *
     * @Route("/{clasificacion}/{categoria}/{tiempoDedicacion}", name="clatesal_show")
     * @Method("GET")
     */
    public function showAction($clasificacion, $categoria, $tiempoDedicacion )
    {
        $em = $this->getDoctrine()->getManager();
        $clatesal=$em->getRepository('AppBundle:Clatesal')->findOneBy(array(
            'clasificacion' => $clasificacion,
            'categoria' => $categoria,
            'tiempoDedicacion' => $tiempoDedicacion,
        ));

        $deleteForm = $this->createDeleteForm($clatesal);

        return $this->render('clatesal/show.html.twig', array(
            'clatesal' => $clatesal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing clatesal entity.
     *
     * @Route("/{clasificacion}/{categoria}/{tiempoDedicacion}/edit", name="clatesal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $clasificacion, $categoria, $tiempoDedicacion)
    {
        $em = $this->getDoctrine()->getManager();
        $clatesal=$em->getRepository('AppBundle:Clatesal')->findOneBy(array(
            'clasificacion' => $clasificacion,
            'categoria' => $categoria,
            'tiempoDedicacion' => $tiempoDedicacion,
        ));


        $deleteForm = $this->createDeleteForm($clatesal);
        $editForm = $this->createForm('AppBundle\Form\ClatesalType', $clatesal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clatesal_show', array(
                'clasificacion' => $clatesal->getClasificacion()->getId(),
                'categoria'=>$clatesal->getCategoria()->getId(),
                'tiempoDedicacion'=>$clatesal->getTiempoDedicacion()->getId(),

            ));
        }

        return $this->render('clatesal/edit.html.twig', array(
            'clatesal' => $clatesal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a clatesal entity.
     *
     * @Route("/{clasificacion}/{categoria}/{tiempoDedicacion}", name="clatesal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $clasificacion, $categoria, $tiempoDedicacion)
    {

        $em = $this->getDoctrine()->getManager();
        $clatesal=$em->getRepository('AppBundle:Clatesal')->findOneBy(array(
            'clasificacion' => $clasificacion,
            'categoria' => $categoria,
            'tiempoDedicacion' => $tiempoDedicacion,
        ));


        $form = $this->createDeleteForm($clatesal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clatesal);
            $em->flush($clatesal);
        }

        return $this->redirectToRoute('clatesal_index');
    }

    /**
     * Creates a form to delete a clatesal entity.
     *
     * @param Clatesal $clatesal The clatesal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Clatesal $clatesal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clatesal_delete', array(

                'clasificacion' => $clatesal->getClasificacion()->getId(),
                'categoria'=>$clatesal->getCategoria()->getId(),
                'tiempoDedicacion'=>$clatesal->getTiempoDedicacion()->getId(),

            )))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}