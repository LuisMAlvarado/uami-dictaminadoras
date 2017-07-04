<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


class AspiranteRepository extends EntityRepository
{

    /**
     * @param $roleId
     * @return array
     *
     */
    public function findRoleId($roleId)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Role c
           WHERE c.id = :id'
            )->setParameter('id', $roleId);
        return $query->getResult();
    }


    public function findByEnable($estadoenable)

    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM AppBundle:Aspirante a
           
          WHERE a.enable = :estadoenble
           
          ORDER BY a.createAt DESC'
            )->setParameter('estadoenable', $estadoenable);

        return $query->getResult();
    }


}