<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Criteria;

/**
 * Concurso
 *
 * @ORM\Table(name="concurso", indexes={@ORM\Index(name="fk_Concurso_Departamento1_idx", columns={"Departamento_id"}), @ORM\Index(name="fk_concurso_dictamen1_idx", columns={"dictamen_id"}), @ORM\Index(name="fk_concurso_estatus1_idx", columns={"estatus_id"}),@ORM\Index(name="fk_Concurso_clasificacion1_idx", columns={"clasificacion_id"}), @ORM\Index(name="fk_concurso_categoria1_idx", columns={"categoria_id"}), @ORM\Index(name="fk_concurso_tiempodedicacion1_idx", columns={"tiempodedicacion_id"})})
 *
 *
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ConcursoRepository")
 */
class Concurso
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
     * @var string
     *
     * @ORM\Column(name="numconcurso", type="string", length=17, nullable=true)
     */
    private $numConcurso;

    /**
     * @var string
     *
     * @ORM\Column(name="plaza", type="string", length=45, nullable=true)
     */
    private $plaza;

    /**
     * @var string
     *
     * @ORM\Column(name="pdfconcurso", type="string", length=255, nullable=true)
     */
    private $pdfConcurso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=false)
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechapublicacion", type="date", nullable=false)
     */
    private $fechaPublicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="unidad", type="string", length=45, nullable=true)
     */
    private $unidad;

    /**
     * @var string
     *
     * @ORM\Column(name="areadepartamental", type="string", length=150, nullable=true)
     */
    private $areaDepartamental;


    /**
     * @var \Clasificacion
     *
     * @ORM\ManyToOne(targetEntity="Clasificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clasificacion_id", referencedColumnName="id")
     * })
     */
    private $clasificacion;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var \TiempoDedicacion
     *
     * @ORM\ManyToOne(targetEntity="TiempoDedicacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tiempodedicacion_id", referencedColumnName="id")
     * })
     */
    private $tiempoDedicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="horario", type="text", nullable=true)
     */
    private $horario;

    /**
     * @var string
     *
     * @ORM\Column(name="causal", type="text", nullable=true)
     */
    private $causal;

    /**
     * @var string
     *
     * @ORM\Column(name="causaltxt", type="text", nullable=true)
     */
    private $causaltxt;

    /**
     * @var string
     *
     * @ORM\Column(name="salario_a", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $salarioA;

    /**
     * @var string
     *
     * @ORM\Column(name="salario_b", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $salarioB;

    /**
     * @var string
     *
     * @ORM\Column(name="actividades", type="text", nullable=true)
     */
    private $actividades;

    /**
     * @var string
     *
     * @ORM\Column(name="aconocimiento", type="text", nullable=true)
     */
    private $aConocimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="disciplina", type="text", nullable=true)
     */
    private $disciplina;

    /**
     * @var string
     *
     * @ORM\Column(name="requisitos", type="text", nullable=true)
     */
    private $requisitos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechain", type="date", nullable=false)
     */
    private $fechaIn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechater", type="date", nullable=false)
     */
    private $fechaTer;

    /**
     * @var integer
     *
     * @ORM\Column(name="tp_hClase", type="integer", nullable=true)
     */
    private $tpHclase;

    /**
     * @var integer
     *
     * @ORM\Column(name="tp_hAcademia", type="integer", nullable=true)
     */
    private $tpHacademia;

    /**
     * @var integer
     *
     * @ORM\Column(name="tp_hAyudantia", type="integer", nullable=true)
     */
    private $tpHayudantia;

    /**
     * @var string
     *
     * @ORM\Column(name="clave_plaza", type="string", length=45, nullable=true)
     */
    private $clavePlaza;

    /**
     * @var \Departamento
     *
     * @ORM\ManyToOne(targetEntity="Departamento" , inversedBy="allConcursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Departamento_id", referencedColumnName="id")
     * })
     */
    private $departamento;

    /**
     * @var \Dictamen
     *
     * @ORM\OneToOne(targetEntity="Dictamen", inversedBy="concurso" , cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dictamen_id", referencedColumnName="id")
     * })
     * @Assert\Valid
     */
    private $dictamen;

    /**
     * @var \Estatus
     *
     * @ORM\ManyToOne(targetEntity="Estatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estatus_id", referencedColumnName="id")
     * })
     */
    private $estatus;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Registro", mappedBy="concurso")
     * @ORM\OrderBy({"aspiranteRfc" = "ASC"})
     */
    private $registros;

    /**
     * AQUI ESTOY GENERANDO LAS FUNCIONES PUBLICAS
     */

    public function __construct()
    {

        $this->createAt = new \DateTime('now');
        $this->fechaPublicacion = new \DateTime('now');
        $this->unidad = 'IZTAPALAPA';

        $this->registros = new ArrayCollection();
    }

    public function __toString()
    {
        return strval($this->id);
    }

    public function __clone()
    {

        $this->id = null;
        $this->createAt = new \DateTime('now');
        $this->fechaPublicacion = new \DateTime('now');
        $this->fechaIn = null;
        $this->fechaTer = null;
        $this->pdfConcurso = null;
        $this->estatus = null;

        $this->registros = new ArrayCollection();
        // TODO: Implement __clone() method.

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
     * Set numConcurso
     *
     * @param string $numConcurso
     *
     * @return Concurso
     */
    public function setNumConcurso($numConcurso)
    {
        $this->numConcurso = $numConcurso;

        return $this;
    }

    /**
     * Get numConcurso
     *
     * @return string
     */
    public function getNumConcurso()
    {
        return $this->numConcurso;
    }

    /**
     * Set plaza
     *
     * @param string $plaza
     *
     * @return Concurso
     */
    public function setPlaza($plaza)
    {
        $this->plaza = $plaza;

        return $this;
    }

    /**
     * Get plaza
     *
     * @return string
     */
    public function getPlaza()
    {
        return $this->plaza;
    }

    /**
     * Set pdfConcurso
     *
     * @param string $pdfConcurso
     *
     * @return Concurso
     */
    public function setPdfConcurso($pdfConcurso)
    {
        $this->pdfConcurso = $pdfConcurso;

        return $this;
    }

    /**
     * Get pdfConcurso
     *
     * @return string
     */
    public function getPdfConcurso()
    {
        return $this->pdfConcurso;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Concurso
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
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     *
     * @return Concurso
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return \DateTime
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * Set unidad
     *
     * @param string $unidad
     *
     * @return Concurso
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return string
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set areaDepartamental
     *
     * @param string $areaDepartamental
     *
     * @return Concurso
     */
    public function setAreaDepartamental($areaDepartamental)
    {
        $this->areaDepartamental = $areaDepartamental;

        return $this;
    }

    /**
     * Get areaDepartamental
     *
     * @return string
     */
    public function getAreaDepartamental()
    {
        return $this->areaDepartamental;
    }


    /**
     * Set horario
     *
     * @param string $horario
     *
     * @return Concurso
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return string
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set causal
     *
     * @param string $causal
     *
     * @return Concurso
     */
    public function setCausal($causal)
    {
        $this->causal = $causal;

        return $this;
    }

    /**
     * Get causal
     *
     * @return string
     */
    public function getCausal()
    {
        return $this->causal;
    }

    /**
     * Set salarioA
     *
     * @param string $salarioA
     *
     * @return Concurso
     */
    public function setSalarioA($salarioA)
    {
        $this->salarioA = $salarioA;

        return $this;
    }

    /**
     * Get salarioA
     *
     * @return string
     */
    public function getSalarioA()
    {
        return $this->salarioA;
    }

    /**
     * Set salarioB
     *
     * @param string $salarioB
     *
     * @return Concurso
     */
    public function setSalarioB($salarioB)
    {
        $this->salarioB = $salarioB;

        return $this;
    }

    /**
     * Get salarioB
     *
     * @return string
     */
    public function getSalarioB()
    {
        return $this->salarioB;
    }

    //VALIDADORES


    /**
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */

    public function validaNoCECPublico(ExecutionContextInterface $context)
    {
        if ($this->estatus->getId() == Estatus::EnviadoRG && $this->numConcurso == null ){
            $context->buildViolation('Ingrese Numero de Convocatoria')
                ->atPath('numConcurso')
                ->addViolation();

        }
    }

    /**
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */
    public function validasalario(ExecutionContextInterface $context)
    {
        if (($this->salarioA == null && $this->salarioB != null)) {
            $context->buildViolation('NO salarios VACIOS')
                ->atPath('salarioA')
                ->addViolation();
        }
        /**elseif (($this->salarioA != null && $this->salarioB == null )){
         * $context->buildViolation('NO salarios VACIOS')
         * ->atPath('salarioB')
         * ->addViolation();
         * }*/

        if ($this->salarioA < 0) {
            $context->buildViolation('Salario INICIAL mal escrito')
                ->atPath('salarioA')
                ->addViolation();
        }

        if ($this->salarioB < 0) {
            $context->buildViolation('Salario FINAL mal escrito')
                ->atPath('salarioB')
                ->addViolation();
        }
        if ($this->salarioB != 0 or $this->salarioB != null) {
            if ($this->salarioB < $this->salarioA) {
                $context->buildViolation('Salario FINAL es menor al INICIAL')
                    ->atPath('salarioB')
                    ->addViolation();
            }
        }
    }

    /**
     * Set actividades
     *
     * @param string $actividades
     *
     * @return Concurso
     */
    public function setActividades($actividades)
    {
        $this->actividades = $actividades;

        return $this;
    }

    /**
     * Get actividades
     *
     * @return string
     */
    public function getActividades()
    {
        return $this->actividades;
    }

    /**
     * Set aConocimiento
     *
     * @param string $aConocimiento
     *
     * @return Concurso
     */
    public function setAConocimiento($aConocimiento)
    {
        $this->aConocimiento = $aConocimiento;

        return $this;
    }

    /**
     * Get aConocimiento
     *
     * @return string
     */
    public function getAConocimiento()
    {
        return $this->aConocimiento;
    }

    /**
     * Set disciplina
     *
     * @param string $disciplina
     *
     * @return Concurso
     */
    public function setDisciplina($disciplina)
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get disciplina
     *
     * @return string
     */
    public function getDisciplina()
    {
        return $this->disciplina;
    }

    /**
     * Set requisitos
     *
     * @param string $requisitos
     *
     * @return Concurso
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
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */
    public function validafechas(ExecutionContextInterface $context)
    {
        if (($this->fechaIn == null && $this->fechaTer != null) || ($this->fechaIn != null && $this->fechaTer == null)) {
            $context->buildViolation('NO fechas VACIAS')
                ->atPath('fechaIn')
                ->addViolation();
        }

        if ($this->fechaIn < $this->createAt) {
            $context->buildViolation('La [FECHA INICIO] debe ser mayor que la [FECHA ELABORACION]')
                ->atPath('fechaIn')
                ->addViolation();
        }


        if ($this->fechaTer <= $this->fechaIn) {
            $context->buildViolation('La [FECHA TERMINO] debe ser mayor que [FECHA INICIO]')
                ->atPath('fechaTer')
                ->addViolation();
        }
    }

    /**
     * Set fechaIn
     *
     * @param \DateTime $fechaIn
     *
     * @return Concurso
     */
    public function setFechaIn($fechaIn)
    {
        $this->fechaIn = $fechaIn;

        return $this;
    }

    /**
     * Get fechaIn
     *
     * @return \DateTime
     */
    public function getFechaIn()
    {
        return $this->fechaIn;
    }

    /**
     * Set fechaTer
     *
     * @param \DateTime $fechaTer
     *
     * @return Concurso
     */
    public function setFechaTer($fechaTer)
    {
        $this->fechaTer = $fechaTer;

        return $this;
    }

    /**
     * Get fechaTer
     *
     * @return \DateTime
     */
    public function getFechaTer()
    {
        return $this->fechaTer;
    }

    /**
     * Set tpHclase
     *
     * @param integer $tpHclase
     *
     * @return Concurso
     */
    public function setTpHclase($tpHclase)
    {
        $this->tpHclase = $tpHclase;

        return $this;
    }

    /**
     * Get tpHclase
     *
     * @return integer
     */
    public function getTpHclase()
    {
        return $this->tpHclase;
    }

    /**
     * Set tpHacademia
     *
     * @param integer $tpHacademia
     *
     * @return Concurso
     */
    public function setTpHacademia($tpHacademia)
    {
        $this->tpHacademia = $tpHacademia;

        return $this;
    }

    /**
     * Get tpHacademia
     *
     * @return integer
     */
    public function getTpHacademia()
    {
        return $this->tpHacademia;
    }

    /**
     * Set tpHayudantia
     *
     * @param integer $tpHayudantia
     *
     * @return Concurso
     */
    public function setTpHayudantia($tpHayudantia)
    {
        $this->tpHayudantia = $tpHayudantia;

        return $this;
    }

    /**
     * Get tpHayudantia
     *
     * @return integer
     */
    public function getTpHayudantia()
    {
        return $this->tpHayudantia;
    }

    /**
     * Set clavePlaza
     *
     * @param string $clavePlaza
     *
     * @return Concurso
     */
    public function setClavePlaza($clavePlaza)
    {
        $this->clavePlaza = $clavePlaza;

        return $this;
    }

    /**
     * Get clavePlaza
     *
     * @return string
     */
    public function getClavePlaza()
    {
        return $this->clavePlaza;
    }

    /**
     * Set departamento
     *
     * @param \AppBundle\Entity\Departamento $departamento
     *
     * @return Concurso
     */
    public function setDepartamento(\AppBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return \AppBundle\Entity\Departamento
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set dictamen
     *
     * @param \AppBundle\Entity\Dictamen $dictamen
     *
     * @return Concurso
     */
    public function setDictamen(\AppBundle\Entity\Dictamen $dictamen = null)
    {
        $this->dictamen = $dictamen;

        $dictamen->setConcurso($this);

        return $this;
    }

    /**
     * Get dictamen
     *
     * @return \AppBundle\Entity\Dictamen
     */
    public function getDictamen()
    {
        return $this->dictamen;
    }

    /**
     * Set estatus
     *
     * @param \AppBundle\Entity\Estatus $estatus
     *
     * @return Concurso
     */
    public function setEstatus(\AppBundle\Entity\Estatus $estatus = null)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return \AppBundle\Entity\Estatus
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Add registro
     *
     * @param \AppBundle\Entity\Registro $registro
     *
     * @return Concurso
     */
    public function addRegistro(\AppBundle\Entity\Registro $registro)
    {
        $this->registros[] = $registro;

        return $this;
    }

    /**
     * Remove registro
     *
     * @param \AppBundle\Entity\Registro $registro
     */
    public function removeRegistro(\AppBundle\Entity\Registro $registro)
    {
        $this->registros->removeElement($registro);
    }

    /**
     * Get registros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegistros()
    {
        return $this->registros;
    }

    public function getRegistrosCompletos()
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('puntaje', 20));

        return $this->registros->matching($criteria);
    }

    public function getGanador()
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('prelacion', 0));

        $result = $this->registros->matching($criteria);
        
        return $result[0];
    }

    /**
     * Set clasificacion
     *
     * @param \AppBundle\Entity\Clasificacion $clasificacion
     *
     * @return Concurso
     */
    public function setClasificacion(\AppBundle\Entity\Clasificacion $clasificacion = null)
    {
        $this->clasificacion = $clasificacion;

        return $this;
    }

    /**
     * Get clasificacion
     *
     * @return \AppBundle\Entity\Clasificacion
     */
    public function getClasificacion()
    {
        return $this->clasificacion;
    }

    /**
     * Set categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     *
     * @return Concurso
     */
    public function setCategoria(\AppBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set tiempoDedicacion
     *
     * @param \AppBundle\Entity\TiempoDedicacion $tiempoDedicacion
     *
     * @return Concurso
     */
    public function setTiempoDedicacion(\AppBundle\Entity\TiempoDedicacion $tiempoDedicacion = null)
    {
        $this->tiempoDedicacion = $tiempoDedicacion;

        return $this;
    }

    /**
     * Get tiempoDedicacion
     *
     * @return \AppBundle\Entity\TiempoDedicacion
     */
    public function getTiempoDedicacion()
    {
        return $this->tiempoDedicacion;
    }

    /**
     * Set causaltxt
     *
     * @param string $causaltxt
     *
     * @return Concurso
     */
    public function setCausaltxt($causaltxt)
    {
        $this->causaltxt = $causaltxt;

        return $this;
    }

    /**
     * Get causaltxt
     *
     * @return string
     */
    public function getCausaltxt()
    {
        return $this->causaltxt;
    }

    public function getCausalC()
    {
        return $this->causal." ".$this->causaltxt;
    }
}
