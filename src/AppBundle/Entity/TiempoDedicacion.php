<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TiempoDedicacion
 *
 * @ORM\Table(name="tiempo_dedicacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TiempoDedicacionRepository")
 */
class TiempoDedicacion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviacion", type="string", length=20)
     */
    private $abreviacion;

    public function __toString()
    {
        return $this->abreviacion;
}

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TiempoDedicacion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set abreviacion
     *
     * @param string $abreviacion
     *
     * @return TiempoDedicacion
     */
    public function setAbreviacion($abreviacion)
    {
        $this->abreviacion = $abreviacion;

        return $this;
    }

    /**
     * Get abreviacion
     *
     * @return string
     */
    public function getAbreviacion()
    {
        return $this->abreviacion;
    }
}
