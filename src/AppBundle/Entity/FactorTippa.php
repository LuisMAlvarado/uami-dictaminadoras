<?php
/**
 * Created by PhpStorm.
 * User: luismicoms
 * Date: 10/04/17
 * Time: 16:17
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * FactorTippa
 *
 * @ORM\Table(name="tippa")
 * @ORM\Entity
 */

class FactorTippa
{

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=10, nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="actividad", type="text", nullable=true)
     */
    private $actividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntosmin", type="integer", nullable=true)
     */
    private $puntosmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntosmax", type="integer", nullable=true)
     */
    private $puntosmax;

    /**
     * @var integer
     *
     * @ORM\Column(name="tope", type="integer", nullable=true)
     */
    private $tope;



    /**
     * INICIAN LOS GET Y SET CON LAS FUNSIONES PUBLICAS
     */

    public function __toString()
    {
        return $this->id;
    }






    /**
     * Set id
     *
     * @param string $id
     *
     * @return FactorTippa
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
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
     * @return FactorTippa
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
     * Set puntosmin
     *
     * @param integer $puntosmin
     *
     * @return FactorTippa
     */
    public function setPuntosmin($puntosmin)
    {
        $this->puntosmin = $puntosmin;

        return $this;
    }

    /**
     * Get puntosmin
     *
     * @return integer
     */
    public function getPuntosmin()
    {
        return $this->puntosmin;
    }

    /**
     * Set puntosmax
     *
     * @param integer $puntosmax
     *
     * @return FactorTippa
     */
    public function setPuntosmax($puntosmax)
    {
        $this->puntosmax = $puntosmax;

        return $this;
    }

    /**
     * Get puntosmax
     *
     * @return integer
     */
    public function getPuntosmax()
    {
        return $this->puntosmax;
    }

    /**
     * Set tope
     *
     * @param integer $tope
     *
     * @return FactorTippa
     */
    public function setTope($tope)
    {
        $this->tope = $tope;

        return $this;
    }

    /**
     * Get tope
     *
     * @return integer
     */
    public function getTope()
    {
        return $this->tope;
    }
}
