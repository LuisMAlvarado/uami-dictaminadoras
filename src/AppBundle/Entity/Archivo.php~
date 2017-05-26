<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Archivo
 *
 * @ORM\Table(name="archivo", indexes={@ORM\Index(name="fk_archivo_aspirante1_idx", columns={"aspirante_rfc"})})
 * @ORM\Entity
 */
class Archivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var \FactorTippa
     *
     * @ORM\ManyToOne(targetEntity="FactorTippa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tippa_id", referencedColumnName="id")
     * })
     */
    private $factor1;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=false)
     */
    private $createAt;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="string", length=255, nullable=true)
     */
    private $pdf;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_delete", type="boolean", nullable=true)
     */
    private $isDelete;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=false)
     */
    private $updateAt;

    /**
     * @var \Aspirante
     *
     * @ORM\ManyToOne(targetEntity="Aspirante" , inversedBy="archivos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aspirante_rfc", referencedColumnName="rfc")
     * })
     */
    private $aspiranteRfc;

    /**
     * INICIAN LAS FUNCIONES PUBLICAS
     * CONSTRUCT Y TO STRING
     *
     */

    public function __construct()
    {
        $this ->isActive =true;
        $this ->isDelete =false;
        $this->createAt= new \DateTime('now');
    }

    public function __toString()
    {
        return strval($this->factor1);
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
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Archivo
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set pdf
     *
     * @param string $pdf
     *
     * @return Archivo
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Archivo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Archivo
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Archivo
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Archivo
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set aspiranteRfc
     *
     * @param \AppBundle\Entity\Aspirante $aspiranteRfc
     *
     * @return Archivo
     */
    public function setAspiranteRfc(\AppBundle\Entity\Aspirante $aspiranteRfc = null)
    {
        $this->aspiranteRfc = $aspiranteRfc;

        return $this;
    }

    /**
     * Get aspiranteRfc
     *
     * @return \AppBundle\Entity\Aspirante
     */
    public function getAspiranteRfc()
    {
        return $this->aspiranteRfc;
    }

    /**
     * Set factor1
     *
     * @param \AppBundle\Entity\FactorTippa $factor1
     *
     * @return Archivo
     */
    public function setFactor1(\AppBundle\Entity\FactorTippa $factor1 = null)
    {
        $this->factor1 = $factor1;

        return $this;
    }

    /**
     * Get factor1
     *
     * @return \AppBundle\Entity\FactorTippa
     */
    public function getFactor1()
    {
        return $this->factor1;
    }
}
