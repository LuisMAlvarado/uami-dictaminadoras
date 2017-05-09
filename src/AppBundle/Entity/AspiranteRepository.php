<?php
/**
 * Created by PhpStorm.
 * User: luismicoms
 * Date: 30/03/17
 * Time: 19:33
 */

namespace AppBundle\Entity;
use Doctrine\ORM\EntityRepository;


class AspiranteRepository extends EntityRepository
{
    public function findRoleId($roleId)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Role c
           WHERE c.id = :id'
            )->setParameter('id', $roleId);
        return $query->getResult();
    }


}