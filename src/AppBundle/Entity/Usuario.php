<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;


/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="fk_Usuario_Role1_idx", columns={"Role_id"}), @ORM\Index(name="fk_Usuario_Division1_idx", columns={"Division_id"}), @ORM\Index(name="fk_usuario_departamento1_idx", columns={"departamento_id"})})
 * @ORM\Entity
 *

 */
class Usuario implements AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="numero_economico", type="integer", length=5, nullable=false)
     * @ORM\Id
     */
    private $numeroEconomico;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_paterno", type="string", length=45, nullable=false)
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_materno", type="string", length=45, nullable=true)
     */
    private $apellidoMaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="correoelectronico", type="string", length=50, nullable=true)
     */
    private $correoElectronico;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean", nullable=false)
     */
    private $enable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="loked", type="boolean", nullable=false)
     */
    private $loked;

    /**
     * @var integer
     *
     * @ORM\Column(name="expired", type="integer", nullable=false)
     */
    private $expired;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=false)
     */
    private $createAt;



    /**
     * @var \Division
     *
     * @ORM\ManyToOne(targetEntity="Division")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Division_id", referencedColumnName="id")
     * })
     */
    private $division;

    /**
     * @var \Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Role_id", referencedColumnName="id")
     * })
     */
    private $role;

    /**
     * @var \Departamento
     *
     * @ORM\ManyToOne(targetEntity="Departamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="departamento_id", referencedColumnName="id")
     * })
     */
    private $departamento;

    /**
     * AQUI ESTOY GENERANDO LAS FUNCIONES PUBLICAS
     */

    public function __construct()
    {
        $this->enable=true;
        $this->locked=false;
        $this->expired=6;
        $this->createAt= new \DateTime('now');
    }

    public function __toString()
    {
        return strval($this->numeroEconomico);

    }

// aqui se construye los elementos para la interface del usuario
    //public function Username ,salt, password , ROLES y serialize

    public function getUsername()
    {
        return $this->numeroEconomico;
    }

    public function getRoles()
    {
        return array($this->role->getRole());
        //  return ['ROLE_DIGITALIZADOR']
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(

            $this->numeroEconomico,
            $this->password,
            //    $this->enable,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (

            $this->numeroEconomico,
            $this->password,
            //    $this->enable,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    //apartir de aqui es AdvancerInterface
    //NonExpired, NonLocked, CredencialesNonExpired e IsEnable
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->enable;
        //return $this->isActive;
    }



    /**
     * Set numeroEconomico
     *
     * @param integer $numeroEconomico
     *
     * @return Usuario
     */
    public function setNumeroEconomico($numeroEconomico)
    {
        $this->numeroEconomico = $numeroEconomico;

        return $this;
    }

    /**
     * Get numeroEconomico
     *
     * @return integer
     */
    public function getNumeroEconomico()
    {
        return $this->numeroEconomico;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Usuario
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
     * Set apellidoPaterno
     *
     * @param string $apellidoPaterno
     *
     * @return Usuario
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    /**
     * Get apellidoPaterno
     *
     * @return string
     */
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    /**
     * Set apellidoMaterno
     *
     * @param string $apellidoMaterno
     *
     * @return Usuario
     */
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    /**
     * Get apellidoMaterno
     *
     * @return string
     */
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     *
     * @return Usuario
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set loked
     *
     * @param boolean $loked
     *
     * @return Usuario
     */
    public function setLoked($loked)
    {
        $this->loked = $loked;

        return $this;
    }

    /**
     * Get loked
     *
     * @return boolean
     */
    public function getLoked()
    {
        return $this->loked;
    }

    /**
     * Set expired
     *
     * @param integer $expired
     *
     * @return Usuario
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;

        return $this;
    }

    /**
     * Get expired
     *
     * @return integer
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Usuario
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
     * Set division
     *
     * @param \AppBundle\Entity\Division $division
     *
     * @return Usuario
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
     * Set role
     *
     * @param \AppBundle\Entity\Role $role
     *
     * @return Usuario
     */
    public function setRole(\AppBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \AppBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set departamento
     *
     * @param \AppBundle\Entity\Departamento $departamento
     *
     * @return Usuario
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
     * Set correoElectronico
     *
     * @param string $correoElectronico
     *
     * @return Usuario
     */
    public function setCorreoElectronico($correoElectronico)
    {
        $this->correoElectronico = $correoElectronico;

        return $this;
    }

    /**
     * Get correoElectronico
     *
     * @return string
     */
    public function getCorreoElectronico()
    {
        return $this->correoElectronico;
    }
}
