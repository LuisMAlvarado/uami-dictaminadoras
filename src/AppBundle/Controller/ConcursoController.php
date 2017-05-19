<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Concurso;
use AppBundle\Entity\Estatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\ExpressionLanguage\Expression;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Form\ConcursoType;
use Symfony\Component\Validator\Constraints\IsNull;

/**
 * Concurso controller.
 *
 * @Route("concurso")
 */
class ConcursoController extends Controller
{
    /**
     * Lists all concurso entities.
     *
     * @Route("/", name="concurso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $aspi=$this->getUser(); //para el caso aspirante

        if ($this->isGranted(new Expression(' "ROLE_ADMINISTRADOR" in roles'))) {
            $dato=(new \DateTime());
            $concursos= $em->getRepository('AppBundle:Concurso')->findAllOrderedByFecha($dato);
        }
        elseif ($this->isGranted('ROLE_ASPIRANTE')){
            $dato=(new \DateTime());

            //se debe generar una consulta usando un comparador ArrayCollect
            $rfc1=$aspi->getRfc();
            $concursos= $em->getRepository('AppBundle:Concurso')->findAllOrderedBynoReg($dato,$rfc1);

        }

        elseif ($this->isGranted('ROLE_DICTAMINADOR')){
            $concursos= $em->getRepository('AppBundle:Concurso')->findAllOrderedByDictamen($this->getUser()->getDivision()->getId());
        }
        elseif ($this->isGranted('ROLE_ASISTENTEDEP')) {
            //  $concursos = $repository->findBy HAY QUE GENERAR EL ARREGLO PARA QUE DESPLIEGE LOS allConcursos DEL USUARIO
            $concursos = $this->getDoctrine()->getRepository('AppBundle:Concurso')->findAllOrderedById2($this->getUser()->getDepartamento()->getId());
        }
        elseif ($this->isGranted('ROLE_ASISTENTEDIV')) {
            //  $concursos = $repository->findBy HAY QUE GENERAR EL ARREGLO PARA QUE DESPLIEGE LOS allConcursos DEL USUARIO

            $concursos = $this->getDoctrine()->getRepository('AppBundle:Concurso')->findAllOrderedById($this->getUser()->getDivision()->getId());

            //PARA USO DEL ESTATUS
           // $edo='2';
           // $concursos = $this->getDoctrine()->getRepository('AppBundle:Concurso')->findAllOrderedByIdxedo($this->getUser()->getDivision()->getId(),$edo);
        }

        if ($this->isGranted(new Expression(' "ROLE_ASPIRANTE" in roles'))){
            return $this->render('concurso/portada.html.twig', array(
                'concursos' => $concursos,
                'aspirante'=>$aspi,
                'est' => 10,
            ));
        }


        return $this->render('concurso/index.html.twig', array(
            'concursos' => $concursos,
            'est' => 10,

        ));
    }


    /**
     * Lists all concurso entities segun el estado
     *
     * @Route("/est/{est}", name="concurso_indexest")
     * @Method("GET")
     */
    public function indexestAction($est)
    {
        $em = $this->getDoctrine()->getManager();
        $aspi=$this->getUser(); //para el caso aspirante

        if ($this->isGranted(new Expression(' "ROLE_ADMINISTRADOR" in roles'))) {
            $dato=(new \DateTime());
            $concursos= $em->getRepository('AppBundle:Concurso')->findAllOrderedByFecha($dato);
        }
        elseif ($this->isGranted('ROLE_ASPIRANTE')){
            $dato=(new \DateTime());

            //se debe generar una consulta usando un comparador ArrayCollect
            $rfc1=$aspi->getRfc();
            $concursos= $em->getRepository('AppBundle:Concurso')->findAllOrderedBynoReg($dato,$rfc1);

        }

        elseif ($this->isGranted('ROLE_DICTAMINADOR')){
            $concursos= $em->getRepository('AppBundle:Concurso')->findAllOrderedByDictamen($this->getUser()->getDivision()->getId());
        }
        elseif ($this->isGranted('ROLE_ASISTENTEDEP')) {
            //  $concursos = $repository->findBy HAY QUE GENERAR EL ARREGLO PARA QUE DESPLIEGE LOS allConcursos DEL USUARIO
            $concursos = $this->getDoctrine()->getRepository('AppBundle:Concurso')->findAllOrderedById2($this->getUser()->getDepartamento()->getId());
        }
        elseif ($this->isGranted('ROLE_ASISTENTEDIV')) {
            //  $concursos = $repository->findBy HAY QUE GENERAR EL ARREGLO PARA QUE DESPLIEGE LOS allConcursos DEL USUARIO

            //$est=3;
            $concursos = $this->getDoctrine()->getRepository('AppBundle:Concurso')->TodosEstado($this->getUser()->getDivision()->getId(),$est);

            //PARA USO DEL ESTATUS
            // $edo='2';
            // $concursos = $this->getDoctrine()->getRepository('AppBundle:Concurso')->findAllOrderedByIdxedo($this->getUser()->getDivision()->getId(),$edo);
        }

        if ($this->isGranted(new Expression(' "ROLE_ASPIRANTE" in roles'))){
            return $this->render('concurso/portada.html.twig', array(
                'concursos' => $concursos,
                'aspirante'=>$aspi,
                'est' => $est,
            ));
        }


        return $this->render('concurso/index.html.twig', array(
            'concursos' => $concursos,
            'est' => $est,

        ));
    }



    /**
     * Creates a new concurso entity.
     *
     * @Route("/new", name="concurso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $concurso = new Concurso();
        $newestatus = $this->getDoctrine()->getRepository('AppBundle:Estatus')->find(Estatus::Publicado); //Estatus::"nombre_variable" definida en ENTIDAD en este caso Estatus
        $concurso ->setEstatus($newestatus);

        $form = $this->createForm('AppBundle\Form\ConcursoType', $concurso);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($concurso);
            $em->flush($concurso);

            return $this->redirectToRoute('concurso_show', array('id' => $concurso->getId()));
        }

        return $this->render('concurso/new.html.twig', array(
            'concurso' => $concurso,
            'form' => $form->createView(),
        ));
        

    }

    /**
     * Finds and displays a concurso entity.
     *
     * @Route("/{id}", name="concurso_show")
     * @Method("GET")
     */
    public function showAction(Concurso $concurso)
    {
        $deleteForm = $this->createDeleteForm($concurso);
        $dias = $concurso->getFechaIn()->diff($concurso->getFechaTer())->format('%Y AÑOS - %M MESES - %D DÍAS');
        return $this->render('concurso/show.html.twig', array(
            'concurso' => $concurso,
            'delete_form' => $deleteForm->createView(),
            'dias' => $dias,
        ));
    }

    /**
     * Finds and displays a Concurso entity.
     *
     * @Route("/{id}/regs", name="concurso_showreg")
     * @Method("GET")
     */
    public function showregAction(Concurso $concurso)
    {
        $deleteForm = $this->createDeleteForm($concurso);

        // $dias = $concurso->getFechaIn()->diff($concurso->getFechaTer())->format('%Y AÑOS - %M MESES - %D DÍAS');

        return $this->render('concurso/showreg.html.twig', array(
            'concurso' => $concurso,
            'delete_form' => $deleteForm->createView(),
            //   'dias' => $dias,
        ));
    }
    
    
    /**
     * Finds and genera PDFs a Concurso entity.
     *
     * @Route("/{id}/pdfs", name="concurso_showpdfs")
     * @Method("GET")
     */
    public function showpdfsAction(Concurso $concurso)
    {

        $dias = $concurso->getFechaIn()->diff($concurso->getFechaTer())->format('%Y AÑOS - %M MESES - %D DÍAS');

        $html = $this->renderView('concurso/pdfshowc1.html.twig', array(
            'concurso' => $concurso,
            'dias' => $dias,
        ));

        $html2 = $this->renderView('concurso/pdfshowc2.html.twig', array(
            'concurso' => $concurso,
            'dias' => $dias,
        ));

        // $dimensiones=array (8.5,11);
        $pdfObj = $this->get("white_october.tcpdf")->create();
        $pdfObj->setPrintHeader(false);
        $pdfObj->setPrintFooter(false);
        $pdfObj->SetAuthor('LuisM-Dictaminadora');
        $pdfObj->SetTitle('Concurso_' . $concurso->getNumConcurso());
        $pdfObj->SetFont('helvetica', '', 7);
        $pdfObj->AddPage('P', 'mm', 'Letter');
        $pdfObj->writeHTML($html, true, true, true, false, '');
        $pdfObj->AddPage('P', 'mm', 'Letter');
        $pdfObj->writeHTML($html2, true, true, true, false, '');
        // $y1=$pdfObj->GetY()-50;
        //  $pdfObj->writeHTMLCell(194, '', 6, 90, $html2, 0, 1, 0, true, 'L', true);

        $pdfObj->Output('Concurso_'.$concurso->getNumConcurso().'.pdf', 'I');
    }


    /**
     * Displays a form to edit an existing concurso entity.
     *
     * @Route("/{id}/edit", name="concurso_edit")
     * @Method({"GET", "POST"})
     * @Security("(has_role('ROLE_CONCURSO_UPDATE') and user.getDivision() == concurso.getDepartamento().getDivision()) or has_role('ROLE_ADMINISTRADOR')")
     */
    public function editAction(Request $request, Concurso $concurso)
    {
        $deleteForm = $this->createDeleteForm($concurso);
        $editForm = $this->createForm('AppBundle\Form\ConcursoType', $concurso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('concurso_show', array('id' => $concurso->getId()));
        }

        return $this->render('concurso/edit.html.twig', array(
            'concurso' => $concurso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/{concurso}/reconvocar/", name="reconvocar_edit")
     *
     *
     * @Method({"GET", "POST"})
     *
     */

public function reconvocarAction(Request $request, Concurso $concurso)// SE USA JUNTO CON EL @rotue {"propiedad"} y en conjunto con el twig cuando pasas Ruta(Controlador) pasas a la funcion esa Entidad
{
    $reconcurso = clone $concurso;

    $newestatus = $this->getDoctrine()->getRepository('AppBundle:Estatus')->find(Estatus::PUBLICADO); //Estatus::"nombre_variable" definida en ENTIDAD en este caso Estatus
    $reconcurso ->setEstatus($newestatus);

    $form = $this->createForm('AppBundle\Form\ConcursoType', $reconcurso);
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
    ));

}


    /**
     * Deletes a concurso entity.
     *
     * @Route("/{id}", name="concurso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Concurso $concurso)
    {
        $form = $this->createDeleteForm($concurso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($concurso);
            $em->flush($concurso);
        }

        return $this->redirectToRoute('concurso_index');
    }

    /**
     * Creates a form to delete a concurso entity.
     *
     * @param Concurso $concurso The concurso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Concurso $concurso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('concurso_delete', array('id' => $concurso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
