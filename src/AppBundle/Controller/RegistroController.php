<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Concurso;
use AppBundle\Entity\Registro;
use FPDM\FPDM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\ExpressionLanguage\Expression;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $aspi=$this->getUser();

        if ($this->isGranted(new Expression(' "ROLE_ADMINISTRADOR" in roles'))) {
            $registros = $em->getRepository('AppBundle:Registro')->findAll();
        }

        elseif ($this->isGranted('ROLE_ASPIRANTE')){

            $registros= $em->getRepository('AppBundle:Registro')->findByAspiranteRfc($this->getUser()->getRfc());

        }
        else {
            //  $concursos = $repository->findBy HAY QUE GENERAR EL ARREGLO PARA QUE DESPLIEGE LOS allConcursos DEL USUARIO
            $registros = $em->getRepository('AppBundle:Registro')->findAll();
        }
        
        return $this->render('registro/index.html.twig', array(
            'registros' => $registros,
            'aspirante'=>$aspi,
        ));
    }

    /**  NO USAR!!!
     * PARA RESTAURARLO SOLO QUITA 2 DE ROUTE, NAME Y newAction()
     *
     * Creates a new registro entity. (INAVILITADO)
     *
     * NO SE DEBE USAR ESTE ACTION!!!!!
     *
     * @Route("/{concurso}/2new", name="registro_2new")
     * @Method({"GET", "POST"})
     */
    public function new2Action(Request $request, Concurso $concurso)
    {
        $registro = new Registro();
        $em = $this->getDoctrine()->getManager();
        $concurso2reg= $concurso;

        if ($this->isGranted(new Expression(' "ROLE_ASPIRANTE" in roles'))) {
            $aspi = $this->getUser();
           $registro->setConcurso($concurso2reg);
           $registro->setAspiranteRfc($aspi);
            $form = $this->createForm('AppBundle\Form\RegistroAspType', $registro);
        }
        if ($this->isGranted(new Expression(' "ROLE_ADMINISTRADOR" in roles'))) {
            $form = $this->createForm('AppBundle\Form\RegistroType', $registro);
        }


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush($registro);

            return $this->redirectToRoute('registro_show', array('id' => $registro->getId()));
        }

        if ($this->isGranted(new Expression(' "ROLE_ADMINSTRADOR" in roles'))) {
            return $this->render('registro/new.html.twig', array(
                'registro' => $registro,
                'form' => $form->createView(),
            ));
        }
        elseif ($this->isGranted(new Expression(' "ROLE_ASPIRANTE" in roles or "ROLE_ASISTENTEDIV" in roles'))){
            return $this->render('registro/new.html.twig', array(
                'registro' => $registro,
                'concurso' => $concurso2reg,
                'aspirante' => $aspi,
                'form' => $form->createView(),

            ));

        }

    }





    /**
     * Creates a new registro entity.
     *SE USA PARA REGISTRAR AL ASPIRANTE (IDE) PASANDO EL IDE DEL CONCURSO ANTES HAY UN MODAL
     * @Route("/{concurso}/newasp", name="registro_newasp")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Concurso $concurso)
    {
        $registro = new Registro();
        $em = $this->getDoctrine()->getManager();
        $concurso2reg= $concurso;
        if($this->isGranted(new Expression(' "ROLE_ASPIRANTE" in roles'))){

            $aspi = $this->getUser();
            $registro->setConcurso($concurso2reg);
            $registro->setAspiranteRfc($aspi);
            $em=$this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush($registro);
            return $this->redirectToRoute('registro_index',
                array(
                    'registros' => $em->getRepository('AppBundle:Registro')->findByAspiranteRfc($this->getUser()->getRfc()),

                    'aspirante'=>$aspi,
            ));

        }
        elseif ($this->isGranted(new Expression('"ROLE_ASISTENTEDIV" in roles'))){
            $form = $this->createForm('AppBundle\Form\RegistroType', $registro);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($registro);
                $em->flush($registro);

                return $this->redirectToRoute('registro_show', array('id' => $registro->getId()));
            }

        }

    }

    /**
     *
     * @Route("/{id}/FRAsppdf", name="RAspFORM_pdf")
     * @Method({"GET", "POST"})
     */
    public function pdfFRAspAction(Request $request, Registro $registro)
    {
        $aspi = $registro->getAspiranteRfc();
        $concurso = $registro->getConcurso();

        //$clasificacion = $concurso->getClasificacion();
        //var_dump($clasificacion);exit();
        $fields = array(
            'clasificacionn' => $concurso->getClasificacion()->getNombre() ,
            'numEC'=> $concurso->getNumConcurso(),
            'FechaDIA'=>$concurso->getCreateAt()->format('d'),
            'FechaMES'=>$concurso->getCreateAt()->format('m'),
            'FechaANIO'=>$concurso->getCreateAt()->format('Y'),
            'categoria' => $concurso->getCategoria()->getNombre(),
            'tdedicacionn' =>$concurso->getTiempoDedicacion()->getNombre(),
            'unidadd'=>$concurso->getUnidad(),
            'divisionn'=>$concurso->getDepartamento()->getDivision()->getNombre(),
            'departamentoo'=>$concurso->getDepartamento()->getNombre(),
            'areadepto'=>$concurso->getAreaDepartamental(),
            'horario'=>$concurso->getHorario(),
            'nombre'=>$aspi->getNombre(),
            'apellidoPaterno'=>$aspi->getApellidoPaterno(),
            'apellidoMaterno'=>$aspi->getApellidoMaterno(),
            'nacionalidad'=>$aspi->getNacionalidad(),
            'rfc'=>$aspi->getRfc(),
            'curp'=>$aspi->getCurp(),
            'birthdayDia'=>$aspi->getFechaBirthday()->format('d'),
            'birthdayMes'=>$aspi->getFechaBirthday()->format('m'),
            'birthdayAnio'=>$aspi->getFechaBirthday()->format('Y'),
            'edad'=>$aspi->getEdad(),
            'sexo'=>$aspi->getSexo(),
            'estadoCivil'=>$aspi->getEstadoCivil(),
            'telefonos'=>$aspi->getTelefonos(),
            'correoElectronico'=>$aspi->getCorreoElectronico(),
            'calle'=>$aspi->getCalle(),
            'noExt'=>$aspi->getNoExt(),
            'edif'=>$aspi->getEdif(),
            'depto'=>$aspi->getDepto(),
            'coloniaFracc'=>$aspi->getColoniaFracc(),
            'delegMunc'=>$aspi->getDelegMunc(),
            'estado'=>$aspi->getEstado(),
            'codPost'=>$aspi->getCodPost(),
            'numeroEconomico'=>$aspi->getNumeroEconomico(),
            'NombreCompleto'=>$aspi->getNombreCompleto(),


        );
        /*
                foreach ($concurso->getRegistros() as $i => $registro)
                {
                    $fields['aspirante_'.$i] = $registro->getAspiranteRfc()->getNombreCompleto();
                }
        */
        //       dump($fields); exit();

        $pdf = new FPDM(__DIR__."/../../../formatosPDF/solregAsp.pdf");
        $pdf->Load($fields, true); // second parameter: false if field values are in ISO-8859-1, true if UTF-8
        $pdf->Merge();
        $nombre=preg_replace('/\./', '', $aspi->getRfc().'_'.$concurso->getNumConcurso());
       // $pdf->Output($nombre.'.pdf', 'I');
        $pdf->Output($nombre.'.pdf', 'D');
    }

    /**
     * @Route("/{concurso}/prereg", name="preregistro_show")
     * @Method("GET")
     *
     */
    public function preshowAction(Request $request, Concurso $concurso)
    {
        //$registro = new Registro();
        //$em = $this->getDoctrine()->getManager();
        $aspi=$this->getUser();
        $concur = $concurso;


        if($this->isGranted('ROLE_ASPIRANTE')) {


            return $this->render('registro/preshow.html.twig', array(

                'concurso' => $concur,
                'aspirante' => $aspi,
            ));
        }

    }



    /**
     * Finds and displays a registro entity.
     *
     * @Route("/{id}", name="registro_show")
     * @Method("GET")
     */
    public function showAction(Registro $registro)
    {
        if($this->isGranted('ROLE_ASPIRANTE')) {
            $aspi = $registro->getAspiranteRfc();
            $concur = $registro->getConcurso();
            $deleteForm = $this->createDeleteForm($registro);

            return $this->render('registro/show.html.twig', array(
                'registro' => $registro,
                'delete_form' => $deleteForm->createView(),
                'concurso' => $concur,
                'aspirante' => $aspi,
            ));
        }

        elseif($this->isGranted('ROLE_ADMINISTRADOR')) {
            $deleteForm = $this->createDeleteForm($registro);

            return $this->render('registro/show.html.twig', array(
                'registro' => $registro,
                'delete_form' => $deleteForm->createView(),
            ));
        }

        elseif($this->isGranted('ROLE_ASISTENTEDIV')) {
            $deleteForm = $this->createDeleteForm($registro);
            $concurso=$registro->getConcurso();
            $aspirante=$registro->getAspiranteRfc();
            //var_dump($aspirante);exit();
            return $this->render('registro/show.html.twig', array(
                'registro' => $registro,
                'concurso' => $concurso ,
                'aspirante'=> $aspirante,
                'delete_form' => $deleteForm->createView(),
            ));
        }

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
