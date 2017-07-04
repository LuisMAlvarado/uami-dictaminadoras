<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Dictamen
 *
 * @ORM\Table(name="dictamen")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DictamenRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Dictamen
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
     * @ORM\Column(name="numdictamen", type="string", length=21, nullable=false)
     */
    private $numDictamen;

    /**
     * @ORM\OneToOne(targetEntity="Concurso", mappedBy="dictamen")
     */
    private $concurso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechadictmen", type="datetime", nullable=false)
     */
    private $fechaDictmen;

    /**
     * @var string
     *
     * @ORM\Column(name="nivelasignado", type="string", length=45, nullable=false)
     */
    private $nivelAsignado;

    /**
     * @var string
     *
     * @ORM\Column(name="modalidades", type="text", nullable=false)
     */
    private $modalidades;

    /**
     * @var string
     *
     * @ORM\Column(name="arguemento", type="text", nullable=false)
     */
    private $argumento;

    /**
     * @var string
     *
     * @ORM\Column(name="asesores", type="text", nullable=true)
     */
    private $asesores;

    /**
     * @var string
     *
     * @ORM\Column(name="pdfdictamen", type="string", length=255, nullable=true)
     */
    private $pdfDictamen;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;


    /**
     * AQUI ESTOY GENERANDO LAS FUNCIONES PUBLICAS
     */

    public function __toString()
    {
        return $this->numDictamen;
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
     * Set numDictamen
     *
     * @param string $numDictamen
     *
     * @return Dictamen
     */
    public function setNumDictamen($numDictamen)
    {
        $this->numDictamen = $numDictamen;

        return $this;
    }

    /**
     * Get numDictamen
     *
     * @return string
     */
    public function getNumDictamen()
    {
        return $this->numDictamen;
    }

    /**
     * Set fechaDictmen
     *
     * @param \DateTime $fechaDictmen
     *
     * @return Dictamen
     */
    public function setFechaDictmen($fechaDictmen)
    {
        $this->fechaDictmen = $fechaDictmen;

        return $this;
    }

    /**
     * Get fechaDictmen
     *
     * @return \DateTime
     */
    public function getFechaDictmen()
    {
        return $this->fechaDictmen;
    }

    /**
     * Set nivelAsignado
     *
     * @param string $nivelAsignado
     *
     * @return Dictamen
     */
    public function setNivelAsignado($nivelAsignado)
    {
        $this->nivelAsignado = $nivelAsignado;

        return $this;
    }

    /**
     * Get nivelAsignado
     *
     * @return string
     */
    public function getNivelAsignado()
    {
        return $this->nivelAsignado;
    }

    /**
     * Set modalidades
     *
     * @param string $modalidades
     *
     * @return Dictamen
     */
    public function setModalidades($modalidades)
    {
        $this->modalidades = $modalidades;

        return $this;
    }

    /**
     * Get modalidades
     *
     * @return string
     */
    public function getModalidades()
    {
        return $this->modalidades;
    }

    /**
     * Set argumento
     *
     * @param string $argumento
     *
     * @return Dictamen
     */
    public function setArgumento($argumento)
    {
        $this->argumento = $argumento;

        return $this;
    }

    /**
     * Get argumento
     *
     * @return string
     */
    public function getArgumento()
    {
        return $this->argumento;
    }

    /**
     * Set asesores
     *
     * @param string $asesores
     *
     * @return Dictamen
     */
    public function setAsesores($asesores)
    {
        $this->asesores = $asesores;

        return $this;
    }

    /**
     * Get asesores
     *
     * @return string
     */
    public function getAsesores()
    {
        return $this->asesores;
    }

    /**
     * Set pdfDictamen
     *
     * @param string $pdfDictamen
     *
     * @return Dictamen
     */
    public function setPdfDictamen($pdfDictamen)
    {
        $this->pdfDictamen = $pdfDictamen;

        return $this;
    }

    /**
     * Get pdfDictamen
     *
     * @return string
     */
    public function getPdfDictamen()
    {
        return $this->pdfDictamen;
    }

    /**
     * Set concurso
     *
     * @param \AppBundle\Entity\Concurso $concurso
     *
     * @return Dictamen
     */
    public function setConcurso(\AppBundle\Entity\Concurso $concurso = null)
    {
        $this->concurso = $concurso;

        return $this;
    }

    /**
     * Get concurso
     *
     * @return \AppBundle\Entity\Concurso
     */
    public function getConcurso()
    {
        return $this->concurso;
    }




}
