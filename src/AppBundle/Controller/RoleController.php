<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Role controller.
 *
 * @Route("role")
 */
class RoleController extends Controller
{
    /**
     * Lists all role entities.
     *
     * @Route("/", name="role_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $roles = $em->getRepository('AppBundle:Role')->findAll();

        return $this->render('role/index.html.twig', array(
            'roles' => $roles,
        ));
    }

    /**
     * Finds and displays a role entity.
     *
     * @Route("/{id}", name="role_show")
     * @Method("GET")
     */
    public function showAction(Role $role)
    {

        return $this->render('role/show.html.twig', array(
            'role' => $role,
        ));
    }
}
