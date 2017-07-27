<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Archivo;
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
     * @security("has_role('ROLE_ADMINISTRADOR') or has_role('ROLE_ASISTENTEDIV')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->isGranted('ROLE_ADMINISTRADOR')){
            $aspirantes = $em->getRepository('AppBundle:Aspirante')->findAll();
        }
    elseif ($this->isGranted('ROLE_ASISTENTEDIV')) {
        //  $concursos = $repository->findBy HAY QUE GENERAR EL ARREGLO PARA QUE DESPLIEGE LOS allConcursos DEL USUARIO
        $estadoenable = 0 ;
    $aspirantes = $this->getDoctrine()->getRepository('AppBundle:Aspirante')->findByEnable($estadoenable);
    }


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
     * Crear un PRE - new aspirante entity.
     *
     * @Route("/prenew", name="aspirante_prenew")
     * @Method({"GET", "POST"})

     */
    public function prenewAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $aspirante = new Aspirante();
        //$copEstudios = new Archivo();
        //$identificacion = new Archivo();
        //$aspirante->addArchivo($copEstudios);
        //$aspirante->addArchivo($identificacion);
        $roleId = 5;
        $role = $this->getDoctrine()->getRepository('AppBundle:Role')->find($roleId);
        $aspirante ->setRole($role);
        $form = $this->createForm('AppBundle\Form\AspirantePreType', $aspirante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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

            return $this->redirectToRoute('preaspirante_show', array('id' => $aspirante->getRfc()));
        }

        return $this->render('aspirante/prenew.html.twig', array(
            'aspirante' => $aspirante,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a aspirante entity.
     *
     * @Route("/prenew/{id}", name="preaspirante_show")
     * @Method("GET")
     *
     */
    public function preshowAction(Aspirante $aspirante)
    {
        $deleteForm = $this->createDeleteForm($aspirante);

        return $this->render('aspirante/preshow.html.twig', array(
            'aspirante' => $aspirante,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Finds and displays a aspirante entity.
     *
     * @Route("/{id}", name="aspirante_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMINISTRADOR') or has_role('ROLE_ASISTENTEDIV') ")
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
     * @Security("has_role('ROLE_ADMINISTRADOR')or has_role('ROLE_ASISTENTEDIV') or (has_role('ROLE_ASPIRANTE_UPDATE') and user.getRfc() == aspirante.getRfc()) ")
     */
    public function editAction(Request $request, Aspirante $aspirante)
    {
        $em = $this->getDoctrine()->getManager();
        $passwordOriginal = $aspirante->getPassword();
        $roleId = 5;
        $role = $this->getDoctrine()->getRepository('AppBundle:Role')->find($roleId);
        $aspirante->setRole($role);
        $archivos = clone $aspirante->getArchivos(); //CLONO ARCHIVOS

        $deleteForm = $this->createDeleteForm($aspirante);
        $editForm = $this->createForm('AppBundle\Form\AspiranteType', $aspirante);
        $editForm->handleRequest($request);


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

            //dump($archivos);exit();
            foreach ($archivos as $archivo) {
             
                if (false === $aspirante->getArchivos()->contains($archivo)) {
                    $aspirante->removeArchivo($archivo);
                    $em->remove($archivo);
                    dump($archivo);
                }

            }
          //  exit;


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
     * @Route("/{aspirante}/enable/", name="aspirante_enable")
     *
     *
     * @Method({"GET", "POST"})
     *
     */

    public function enableAspAction(Request $request, Aspirante $aspirante)// SE USA JUNTO CON EL @rotue {"propiedad"} y en conjunto con el twig cuando pasas Ruta(Controlador) pasas a la funcion esa Entidad
    {


        //$newestatus = $this->getDoctrine()->getRepository('AppBundle:Estatus')->find($nest);
        //Estatus::"nombre_variable" definida en ENTIDAD en este caso Estatus
        $enableasp = true;
        $aspirante ->setEnable($enableasp);

        $em = $this->getDoctrine()->getManager();
        $em->persist($aspirante);
        $em->flush($aspirante);
        return $this->redirectToRoute('aspirante_show', array('id' => $aspirante->getRfc()));

        /**QUITO ESTO PARA QUE ENVIE DIRECTO AL CAMBIO
         * $form = $this->createForm('AppBundle\Form\ConcursoType', $reconcurso);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($reconcurso);
        $em->flush($reconcurso);

        return $this->redirectToRoute('concurso_show', array('id' => $reconcurso->getId()));
        }

        return $this->render('concurso/new.html.twig', array(
        'concurso' => $reconcurso,
        'form' => $form->createView(),
        )); */

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
