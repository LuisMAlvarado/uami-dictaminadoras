<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Plan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Plan controller.
 *
 * @Route("plan")
 */
class PlanController extends Controller
{
    /**
     * Lists all plan entities.
     *
     * @Route("/", name="plan_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plans = $em->getRepository('AppBundle:Plan')->findAll();

        return $this->render('plan/index.html.twig', array(
            'plans' => $plans,
        ));
    }

    /**
     * Finds and displays a plan entity.
     *
     * @Route("/{id}", name="plan_show")
     * @Method("GET")
     */
    public function showAction(Plan $plan)
    {

        return $this->render('plan/show.html.twig', array(
            'plan' => $plan,
        ));
    }
}
