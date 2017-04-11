<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class RegistroRepository extends EntityRepository
{
    
    public function findAllOrderedByAspiranteRfc($rfcs)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM AppBundle:Registro r
           WHERE r.aspiranteRfc = :rfcs
           ORDER BY r.createAt DESC'
            )->setParameter('rfcs', $rfcs);
        return $query->getResult();
    }
}
