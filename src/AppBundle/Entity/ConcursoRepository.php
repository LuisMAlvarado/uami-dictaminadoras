<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ConcursoRepository extends EntityRepository
{
    /**
     *  consulta para ver todas los concursos segun la division
     *
     * @param $divisionId
     * @return array
     */
    public function findAllOrderedById($divisionId)
    {
      $query = $this->getEntityManager()
          ->createQuery(
          'SELECT c FROM AppBundle:Concurso c 
          JOIN c.departamento dp
          JOIN dp.division dv
          WHERE dv.id = :id
          ORDER BY c.createAt ASC'
          )->setParameter('id', $divisionId);


        return $query->getResult();
    }

    /**
     *  consulta para ver todas los concursos segun la division POR su estatus
     *
     * @param $divisionId
     * @return array
     */
    public function TodosEstado($divisionId,$est)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c 
          JOIN c.departamento dp
          JOIN dp.division dv
          WHERE dv.id = :id
          AND c.estatus = :est
          ORDER BY c.createAt ASC'
            )->setParameter('id', $divisionId)
            ->setParameter('est', $est)
        ;


        return $query->getResult();
    }




    /**
     *  consulta para ver todas los concursos segun la division
     *
     * @param $divisionId
     * @return array
     */
    public function findAllOrderedByIdxedo($divisionId,$edo)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c 
          JOIN c.departamento dp
          JOIN dp.division dv
          WHERE dv.id = :id
          AND c.estatus = :edo
          ORDER BY c.clasificacion ASC'
            )->setParameter('id', $divisionId)
            ->setParameter('edo', $edo)
        ;


        return $query->getResult();
    }

    /**
     * consulta para ver todas los concursos segun el departamento
     * @param $departamentoId
     * @return array
     *
     */
    public function findAllOrderedById2($departamentoId)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c 
          JOIN c.departamento dp
          WHERE dp.id = :id
          ORDER BY c.clasificacion ASC'
            )->setParameter('id', $departamentoId);


        return $query->getResult();
    }

    /**
     *  consulta para ver todas los concursos segun DEPARTAMENTOP POR su estatus
     *
     * @param $deptoId
     * @return array
     */
    public function EstxDepto($deptoId,$est)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c 
          JOIN c.departamento dp
          WHERE dp.id = :id
          AND c.estatus = :est
          ORDER BY c.createAt ASC'
            )->setParameter('id', $deptoId)
            ->setParameter('est', $est)
        ;


        return $query->getResult();
    }
    
    
    /**
     *ESTA CONSULTA ENCUENTRA TODOS LOS CONCURSOS QUE NO TIENE REGISTRO EL ASPIRANTE
     *
     * @param $fechas
     * @param $rfc
     * @return array
     */
    public function findAllOrderedBynoReg($fechas, $rfc)

{
    $query = $this->getEntityManager()
        ->createQuery(
            'SELECT c FROM AppBundle:Concurso c
                  LEFT JOIN c.registros r
                  LEFT JOIN r.aspiranteRfc a
          WHERE c.fechaPublicacion < :dates
              AND c NOT IN ( SELECT  c1 
                                    FROM AppBundle:Concurso c1
                                        JOIN c1.registros r1
                                        JOIN r1.aspiranteRfc a1
                                    WHERE a1.rfc = :rfc
               )           
          ORDER BY c.departamento ASC'
        )->setParameter('dates', $fechas)
        ->setParameter('rfc', $rfc)
    ;



    return $query->getResult();
}

    public function PublicadonoReg($estp, $rfc)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c
                  LEFT JOIN c.registros r
                  LEFT JOIN r.aspiranteRfc a
          WHERE c.estatus = :estp
              AND c NOT IN ( SELECT  c1 
                                    FROM AppBundle:Concurso c1
                                        JOIN c1.registros r1
                                        JOIN r1.aspiranteRfc a1
                                    WHERE a1.rfc = :rfc
               )           
          ORDER BY c.departamento ASC'
            )->setParameter('estp', $estp)
            ->setParameter('rfc', $rfc)
        ;



        return $query->getResult();
    }



    /**
     * @param $estp
     * @return array
     *
     */

    public function EstadoPublicado($estp)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c
           
          WHERE c.estatus = :estadop
           
          ORDER BY c.fechaPublicacion DESC'
            )->setParameter('estadop', $estp);

        return $query->getResult();
    }




    /**
     * CONSULTA PARA ENTREGAR LOS CONSUROSOS POR FECHA ACTUAL
     * @param $hoy
     * @return array
     *
     */

    public function findAllOrderedByFecha($hoy)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c
           
          WHERE c.fechaPublicacion <= :dates
           
          ORDER BY c.fechaPublicacion DESC'
            )->setParameter('dates', $hoy);

        return $query->getResult();
    }

    /**
     * BUSQUEDA DE CONCURSOS VIGENTES
     * @param $hoy
     * @return array
     *
     */

    public function findAllOrderedByFechaV($hoy)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c
           
          WHERE c.fechaPublicacion >= :dates
           
          ORDER BY c.fechaPublicacion DESC'
            )->setParameter('dates', $hoy);


        return $query->getResult();
    }

    /**
     * CONSULTA PARA ENLISTAR TODOS LOS CONCURSOS QUE NO TIENE DICTAMEN
     *
     * @param $divisionId
     * @return array
     *
     */
    public function ConcursoSinDictamen($divisionId)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c
          JOIN c.departamento dp
          JOIN dp.division dv
          WHERE dv.id = :id AND c.dictamen IS NULL
           
          ORDER BY c.fechaPublicacion DESC'
            )->setParameter('id', $divisionId);


        return $query->getResult();
    }

    /**
     * CONSULTA PARA ENLISTAR A TODOS LOS CONCURSOS SEGUN ESTADO SIN #DICTAMEN!!!
     *
     * @param $divisionId
     * @return array
     *
     */
    public function EdoSinDictamen2($divisionId,$mdic)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c
          JOIN c.departamento dp
          JOIN dp.division dv
          WHERE dv.id = :id AND c.estatus = :mdic AND c.dictamen IS NULL
           
          ORDER BY c.fechaPublicacion DESC'
            )->setParameter('id', $divisionId)
            ->setParameter('mdic', $mdic)
        ;


        return $query->getResult();
    }

    /**
     * CONSULTA PARA ENLISTAR A TODOS LOS CONCURSOS SEGUN ESTADO CON #DICTAMEN!!!
     *
     * @param $divisionId
     * @return array
     *
     */
    public function EdoConDictamen2($divisionId,$mdic)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c
          JOIN c.departamento dp
          JOIN dp.division dv
          WHERE dv.id = :id AND c.estatus = :mdic AND c.dictamen IS NOT NULL
           
          ORDER BY c.fechaPublicacion DESC'
            )->setParameter('id', $divisionId)
            ->setParameter('mdic', $mdic)
        ;


        return $query->getResult();
    }

    /**
     * CONSULTA PARA ENLISTAR A TODOS LOS CONCURSOS SEGUN ESTADO CON #DICTAMEN!!!
     *
     * @param $divisionId
     * @return array
     *
     */
    public function EdoNoImportaDictamen($divisionId,$mdic)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c
          JOIN c.departamento dp
          JOIN dp.division dv
          WHERE dv.id = :id AND c.estatus = :mdic
           
          ORDER BY c.fechaPublicacion DESC'
            )->setParameter('id', $divisionId)
            ->setParameter('mdic', $mdic)
        ;


        return $query->getResult();
    }

    /**
     * CONSULTA PARA ENLISTAR A TODOS LOS CONCURSOS MAYORES A LA VARIABLE DEFINIDA POR $MDIC
     *
     * @param $divisionId
     * @return array
     *
     */
    public function EstadoMayorQue($divisionId,$mdic)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Concurso c
          JOIN c.departamento dp
          JOIN dp.division dv
          WHERE dv.id = :id AND c.estatus > :mdic 
           
          ORDER BY c.fechaPublicacion DESC'
            )->setParameter('id', $divisionId)
            ->setParameter('mdic', $mdic)
        ;


        return $query->getResult();
    }
}
