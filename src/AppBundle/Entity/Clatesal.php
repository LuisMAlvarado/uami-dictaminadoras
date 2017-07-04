<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clatesal
 *
 * @ORM\Table(name="clatesal", uniqueConstraints={@ORM\UniqueConstraint(columns={"clasificacion_id", "categoria_id","tiempodedicacion_id"})}, indexes={@ORM\Index(name="fk_Concurso_clasificacion1_idx", columns={"clasificacion_id"}), @ORM\Index(name="fk_concurso_categoria1_idx", columns={"categoria_id"}), @ORM\Index(name="fk_concurso_tiempodedicacion1_idx", columns={"tiempodedicacion_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClatesalRepository")
 */
class Clatesal
{


    /**
     * @var \Clasificacion
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Clasificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clasificacion_id", referencedColumnName="id")
     * })
     */
    private $clasificacion;

    /**
     * @var \Categoria
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;


    /**
     * @var \TiempoDedicacion
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="TiempoDedicacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tiempodedicacion_id", referencedColumnName="id")
     * })
     */
    private $tiempoDedicacion;



    /**
     * @var string
     *
     * @ORM\Column(name="actividad", type="text")
     */
    private $actividad;

    /**
     * @var string
     *
     * @ORM\Column(name="requisitos", type="text")
     */
    private $requisitos;

    /**
     * @var string
     *
     * @ORM\Column(name="salA", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $salA;

    /**
     * @var string
     *
     * @ORM\Column(name="salB", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $salB;

    /**
     * @var string
     *
     * @ORM\Column(name="tema", type="text", nullable=true)
     */
    private $tema;

    /**
     * @var bool
     *
     * @ORM\Column(name="multiplar", type="boolean", nullable=false)
     */
    private $multiplar;



    public function __construct()
    {

    }

    public function __toString()
    {
        return $this->actividad;
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
     * Set actividad
     *
     * @param string $actividad
     *
     * @return Clatesal
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return string
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set requisitos
     *
     * @param string $requisitos
     *
     * @return Clatesal
     */
    public function setRequisitos($requisitos)
    {
        $this->requisitos = $requisitos;

        return $this;
    }

    /**
     * Get requisitos
     *
     * @return string
     */
    public function getRequisitos()
    {
        return $this->requisitos;
    }

    /**
     * Set salA
     *
     * @param string $salA
     *
     * @return Clatesal
     */
    public function setSalA($salA)
    {
        $this->salA = $salA;

        return $this;
    }

    /**
     * Get salA
     *
     * @return string
     */
    public function getSalA()
    {
        return $this->salA;
    }

    /**
     * Set salB
     *
     * @param string $salB
     *
     * @return Clatesal
     */
    public function setSalB($salB)
    {
        $this->salB = $salB;

        return $this;
    }

    /**
     * Get salB
     *
     * @return string
     */
    public function getSalB()
    {
        return $this->salB;
    }

    /**
     * Set tema
     *
     * @param string $tema
     *
     * @return Clatesal
     */
    public function setTema($tema)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return string
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set multiplar
     *
     * @param boolean $multiplar
     *
     * @return Clatesal
     */
    public function setMultiplar($multiplar)
    {
        $this->multiplar = $multiplar;

        return $this;
    }

    /**
     * Get multiplar
     *
     * @return bool
     */
    public function getMultiplar()
    {
        return $this->multiplar;
    }

    /**
     * Set clasificacion
     *
     * @param string $clasificacion
     *
     * @return Clatesal
     */
    public function setClasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;

        return $this;
    }

    /**
     * Get clasificacion
     *
     * @return string
     */
    public function getClasificacion()
    {
        return $this->clasificacion;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     *
     * @return Clatesal
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set tiempoDedicacion
     *
     * @param string $tiempoDedicacion
     *
     * @return Clatesal
     */
    public function setTiempoDedicacion($tiempoDedicacion)
    {
        $this->tiempoDedicacion = $tiempoDedicacion;

        return $this;
    }

    /**
     * Get tiempoDedicacion
     *
     * @return string
     */
    public function getTiempoDedicacion()
    {
        return $this->tiempoDedicacion;
    }
}
