<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Aspirante;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
     * @security("has_role('ROLE_ADMINISTRADOR')")
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
     * @security("has_role('ROLE_ASPIRANTE_CREATE')")

     */
    public function newAction(Request $request)
    {
        $aspirante = new Aspirante();
        $roleId = 5;
        $role = $this->getDoctrine()->getRepository('AppBundle:Role')->find($roleId);
        $aspirante ->setRole($role);
        $form = $this->createForm('AppBundle\Form\AspiranteType', $aspirante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Líneas agregadas por el usuario

            $salt = md5(time());

            $encoder = $this->get('security.encoder_factory')->getEncoder($aspirante);
            $passwordCodificado = $encoder->encodePassword(
                $form->getData()->getPassword(),
                $salt
            );
            $form->getdata()->setPassword($passwordCodificado);
            $form->getdata()->setSalt($salt);

            // Hasta aquí llegan las líneas agregadas

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
     * @Security("has_role('ROLE_ADMINISTRADOR')")
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
     * Finds and displays a Aspirante entity.
     *
     * @Route("/asp/{id}", name="aspirante_aspshow")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMINISTRADOR') or (user.getRfc() == aspirante.getRfc()) ")
     */
    public function aspshowAction(Aspirante $aspirante)
    {
        $deleteForm = $this->createDeleteForm($aspirante);

        return $this->render('aspirante/aspshow.html.twig', array(
            'aspirante' => $aspirante,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing aspirante entity.
     *
     * @Route("/{id}/edit", name="aspirante_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMINISTRADOR') or (has_role('ROLE_ASPIRANTE_UPDATE') and user.getRfc() == aspirante.getRfc()) ")
     */
    public function editAction(Request $request, Aspirante $aspirante)
    {
        $em = $this->getDoctrine()->getManager();
        $passwordOriginal = $aspirante->getPassword();
        $deleteForm = $this->createDeleteForm($aspirante);
        $editForm = $this->createForm('AppBundle\Form\AspiranteType', $aspirante);
        $editForm->handleRequest($request);
        $roleId = 5;
        $role = $this->getDoctrine()->getRepository('AppBundle:Role')->find($roleId);
        $aspirante->setRole($role);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            //$this->getDoctrine()->getManager()->flush();
            
            // Líneas agregadas para la codificación del password
            if (null == $editForm->getData()->getPassword()) {
                $editForm->getData()->setPassword($passwordOriginal);
            } else {
                $salt = md5(time());


                $encoder = $this->get('security.encoder_factory')->getEncoder($aspirante);
                $passwordCodificado = $encoder->encodePassword(
                    $editForm->getData()->getPassword(),
                    $salt
                );
                $editForm->getdata()->setPassword($passwordCodificado);
                $editForm->getdata()->setSalt($salt);
                // $editForm->getdata()->setRole($role);
            }
            // Aquí terminan las líneas agregadas
            
            $em->persist($aspirante);
            $em->flush();

//AQUI PORN LA CONDICION SI ES ASPIRANTE o NO!!! para enviarlo al ASPSHOW!!!!
            if ($this->isGranted('ROLE_ASPIRANTE')) {
                return $this->redirectToRoute('aspirante_aspshow', array('id' => $aspirante->getRfc()));
            } else {
                return $this->redirectToRoute('aspirante_show', array('id' => $aspirante->getRfc()));

            }
            
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
