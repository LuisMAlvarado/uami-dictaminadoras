<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Estatus
 *
 * @ORM\Table(name="estatus")
 * @ORM\Entity
 */
class Estatus
{
    const EnRevision = 1;
    const EnviadoRG = 2;
    const Publicado = 3;//DEFINICION DE CONSTANTES QUE PUEDEN SER UTILES EN LOS CONTRALADORES
    const RegAspirantes = 4;
    const Dictaminado = 5;
    const DicAsignado = 6;
    const Reconvocado = 7;
    const Cancelado = 8;
    const Desierto = 9;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreEstatus", type="string", length=45, nullable=false)
     */
    private $estatus;


    /**
     * @ORM\ManyToMany(targetEntity="Estatus")
     * @ORM\JoinTable(name="estado_siguiente",
     *      joinColumns={
     *         @ORM\JoinColumn(name="estatus_id", referencedColumnName="id")
     *         },
     *           inverseJoinColumns={
     *             @ORM\JoinColumn(name="estado_siguiente", referencedColumnName="id")
     *          }
     *      )
     */
    private $estadosSiguientes;


    /**
     * INICIAN LOS GET Y SET CON LAS FUNSIONES PUBLICAS
     */

    public function __toString()
    {
        return $this->estatus;
    }

    public function __construct()
    {
        $this->estadosSiguientes = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set estatus
     *
     * @param string $estatus
     *
     * @return Estatus
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return string
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Add estadosSiguiente
     *
     * @param \AppBundle\Entity\Estatus $estadosSiguiente
     *
     * @return Estatus
     */
    public function addEstadosSiguiente(\AppBundle\Entity\Estatus $estadosSiguiente)
    {
        $this->estadosSiguientes[] = $estadosSiguiente;

        return $this;
    }

    /**
     * Remove estadosSiguiente
     *
     * @param \AppBundle\Entity\Estatus $estadosSiguiente
     */
    public function removeEstadosSiguiente(\AppBundle\Entity\Estatus $estadosSiguiente)
    {
        $this->estadosSiguientes->removeElement($estadosSiguiente);
    }

    /**
     * Get estadosSiguientes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstadosSiguientes()
    {
        return $this->estadosSiguientes;
    }
}
