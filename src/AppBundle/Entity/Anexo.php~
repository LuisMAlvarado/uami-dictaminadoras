<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Anexo
 *
 * @ORM\Table(name="anexo", uniqueConstraints={@ORM\UniqueConstraint(name="archivo_id_UNIQUE", columns={"archivo_id", "registro_id"})}, indexes={@ORM\Index(name="fk_archivo_has_concurso_archivo1_idx", columns={"archivo_id"}), @ORM\Index(name="fk_anexo_registro1_idx", columns={"registro_id"})})
 * @ORM\Entity
 */
class Anexo
{
    /**
     * @var \Archivo
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Archivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="archivo_id", referencedColumnName="id")
     * })
     */
    private $archivo;

    /**
     * @var \Registro
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Registro", inversedBy="anexos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="registro_id", referencedColumnName="id")
     * })
     */
    private $registro;


    /**
     * @var \FactorTippa
     *
     * @ORM\ManyToOne(targetEntity="FactorTippa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tippa_id", referencedColumnName="id")
     * })
     */
    private $factor2;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="crate_at", type="date", nullable=false)
     */
    private $crateAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_eval", type="datetime", nullable=true)
     */
    private $fechaEval;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntos", type="integer", nullable=true)
     */
    private $puntos;

    /**
     * INICIO LAS FUNCIONES PUBLICAS SET Y GETS
     * _CONTRUCT Y _TOSTRING
     *
     */

    public function __toString()
    {
        return strval($this->factor2);
    }




    /**
     * Set crateAt
     *
     * @param \DateTime $crateAt
     *
     * @return Anexo
     */
    public function setCrateAt($crateAt)
    {
        $this->crateAt = $crateAt;

        return $this;
    }

    /**
     * Get crateAt
     *
     * @return \DateTime
     */
    public function getCrateAt()
    {
        return $this->crateAt;
    }

    /**
     * Set fechaEval
     *
     * @param \DateTime $fechaEval
     *
     * @return Anexo
     */
    public function setFechaEval($fechaEval)
    {
        $this->fechaEval = $fechaEval;

        return $this;
    }

    /**
     * Get fechaEval
     *
     * @return \DateTime
     */
    public function getFechaEval()
    {
        return $this->fechaEval;
    }

    /**
     * Set puntos
     *
     * @param integer $puntos
     *
     * @return Anexo
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;

        return $this;
    }

    /**
     * Get puntos
     *
     * @return integer
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * Set archivo
     *
     * @param \AppBundle\Entity\Archivo $archivo
     *
     * @return Anexo
     */
    public function setArchivo(\AppBundle\Entity\Archivo $archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return \AppBundle\Entity\Archivo
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set registro
     *
     * @param \AppBundle\Entity\Registro $registro
     *
     * @return Anexo
     */
    public function setRegistro(\AppBundle\Entity\Registro $registro = null)
    {
        $this->registro = $registro;

        return $this;
    }

    /**
     * Get registro
     *
     * @return \AppBundle\Entity\Registro
     */
    public function getRegistro()
    {
        return $this->registro;
    }

    /**
     * Set factor2
     *
     * @param \AppBundle\Entity\FactorTippa $factor2
     *
     * @return Anexo
     */
    public function setFactor2(\AppBundle\Entity\FactorTippa $factor2 = null)
    {
        $this->factor2 = $factor2;

        return $this;
    }

    /**
     * Get factor2
     *
     * @return \AppBundle\Entity\FactorTippa
     */
    public function getFactor2()
    {
        return $this->factor2;
    }
}
