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
          ORDER BY c.clasificacion ASC'
          )->setParameter('id', $divisionId);


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
    public function findAllOrderedByDictamen($divisionId)

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
}
