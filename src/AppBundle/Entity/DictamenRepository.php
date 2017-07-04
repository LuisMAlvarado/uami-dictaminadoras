<?php
/**
 * Created by PhpStorm.
 * User: luismicoms
 * Date: 30/03/17
 * Time: 18:06
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
class DictamenRepository extends EntityRepository

{
    public function AllporDiv($divisionId)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT d FROM AppBundle:Dictamen d
          JOIN d.concurso dc
          JOIN dc.departamento dcd
          JOIN dcd.division dcdd
          WHERE dcdd.id = :id
          ORDER BY d.fechaDictmen ASC'
            )->setParameter('id', $divisionId);


        return $query->getResult();
    }

}