<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Clasificacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Clasificacion controller.
 *
 * @Route("clasificacion")
 */
class ClasificacionController extends Controller
{
    /**
     * Lists all clasificacion entities.
     *
     * @Route("/", name="clasificacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clasificacions = $em->getRepository('AppBundle:Clasificacion')->findAll();

        return $this->render('clasificacion/index.html.twig', array(
            'clasificacions' => $clasificacions,
        ));
    }

    /**
     * Finds and displays a clasificacion entity.
     *
     * @Route("/{id}", name="clasificacion_show")
     * @Method("GET")
     */
    public function showAction(Clasificacion $clasificacion)
    {

        return $this->render('clasificacion/show.html.twig', array(
            'clasificacion' => $clasificacion,
        ));
    }
}
