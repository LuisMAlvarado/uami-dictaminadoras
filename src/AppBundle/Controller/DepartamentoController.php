<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Departamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Departamento controller.
 *
 * @Route("departamento")
 */
class DepartamentoController extends Controller
{
    /**
     * Lists all departamento entities.
     *
     * @Route("/", name="departamento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departamentos = $em->getRepository('AppBundle:Departamento')->findAll();

        return $this->render('departamento/index.html.twig', array(
            'departamentos' => $departamentos,
        ));
    }

    /**
     * Finds and displays a departamento entity.
     *
     * @Route("/{id}", name="departamento_show")
     * @Method("GET")
     */
    public function showAction(Departamento $departamento)
    {

        return $this->render('departamento/show.html.twig', array(
            'departamento' => $departamento,
        ));
    }
}
