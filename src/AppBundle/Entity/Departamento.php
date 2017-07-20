<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="departamento", indexes={@ORM\Index(name="fk_Departamento_Division1_idx", columns={"Division_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepartamentoRepository")
 */
class Departamento
{
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviatura", type="string", length=45, nullable=true)
     */
    private $abreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="dpGrado", type="string", length=4, nullable=true)
     */
    private $dpGrado;

    /**
     * @var string
     *
     * @ORM\Column(name="dpNombre", type="string", length=45, nullable=false)
     */
    private $dpNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="dpApellido_paterno", type="string", length=45, nullable=false)
     */
    private $dpApellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="dpApellido_materno", type="string", length=45, nullable=true)
     */
    private $dpApellidoMaterno;

    /**
     * @var \Division
     *
     * @ORM\ManyToOne(targetEntity="Division")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Division_id", referencedColumnName="id")
     * })
     */
    private $division;


    //esta propiedad recolecta todos los allConcursos del los departamentos para ligarlos
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Concurso", mappedBy="departamento")
     */
    private $allConcursos;


    /**
     * AQUI ESTOY GENERANDO LAS FUNCIONES PUBLICAS
     */

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->allConcursos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Departamento
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
     * Set abreviatura
     *
     * @param string $abreviatura
     *
     * @return Departamento
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set dpGrado
     *
     * @param string $dpGrado
     *
     * @return Departamento
     */
    public function setDpGrado($dpGrado)
    {
        $this->dpGrado = $dpGrado;

        return $this;
    }

    /**
     * Get dpGrado
     *
     * @return string
     */
    public function getDpGrado()
    {
        return $this->dpGrado;
    }

    /**
     * Set dpNombre
     *
     * @param string $dpNombre
     *
     * @return Departamento
     */
    public function setDpNombre($dpNombre)
    {
        $this->dpNombre = $dpNombre;

        return $this;
    }

    /**
     * Get dpNombre
     *
     * @return string
     */
    public function getDpNombre()
    {
        return $this->dpNombre;
    }

    /**
     * @return string
     */
    public function getDpNombreCompleto()
    {
        return $this->dpGrado." ".$this->dpNombre." ".$this->dpApellidoPaterno." ".$this->dpApellidoMaterno;
    }

    /**
     * Set dpApellidoPaterno
     *
     * @param string $dpApellidoPaterno
     *
     * @return Departamento
     */
    public function setDpApellidoPaterno($dpApellidoPaterno)
    {
        $this->dpApellidoPaterno = $dpApellidoPaterno;

        return $this;
    }

    /**
     * Get dpApellidoPaterno
     *
     * @return string
     */
    public function getDpApellidoPaterno()
    {
        return $this->dpApellidoPaterno;
    }

    /**
     * Set dpApellidoMaterno
     *
     * @param string $dpApellidoMaterno
     *
     * @return Departamento
     */
    public function setDpApellidoMaterno($dpApellidoMaterno)
    {
        $this->dpApellidoMaterno = $dpApellidoMaterno;

        return $this;
    }

    /**
     * Get dpApellidoMaterno
     *
     * @return string
     */
    public function getDpApellidoMaterno()
    {
        return $this->dpApellidoMaterno;
    }

    /**
     * Set division
     *
     * @param \AppBundle\Entity\Division $division
     *
     * @return Departamento
     */
    public function setDivision(\AppBundle\Entity\Division $division = null)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return \AppBundle\Entity\Division
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Add allConcurso
     *
     * @param \AppBundle\Entity\Concurso $allConcurso
     *
     * @return Departamento
     */
    public function addAllConcurso(\AppBundle\Entity\Concurso $allConcurso)
    {
        $this->allConcursos[] = $allConcurso;

        return $this;
    }

    /**
     * Remove allConcurso
     *
     * @param \AppBundle\Entity\Concurso $allConcurso
     */
    public function removeAllConcurso(\AppBundle\Entity\Concurso $allConcurso)
    {
        $this->allConcursos->removeElement($allConcurso);
    }

    /**
     * Get allConcursos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAllConcursos()
    {
        return $this->allConcursos;
    }
}
