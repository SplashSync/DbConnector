<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposEmployees
 *
 * @ORM\Table(name="ospos_employees", uniqueConstraints={@ORM\UniqueConstraint(name="username", columns={"username"})}, indexes={@ORM\Index(name="person_id", columns={"person_id"})})
 * @ORM\Entity
 */
class OsposEmployees
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="hash_version", type="integer", nullable=false)
     */
    private $hashVersion = '2';

    /**
     * @var \Databases\OsPosBundle\Entity\OsposPeople
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposPeople")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     * })
     */
    private $person;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Databases\OsPosBundle\Entity\OsposPermissions", mappedBy="person")
     */
    private $permission;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permission = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set username
     *
     * @param string $username
     *
     * @return OsposEmployees
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return OsposEmployees
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
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return OsposEmployees
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set hashVersion
     *
     * @param integer $hashVersion
     *
     * @return OsposEmployees
     */
    public function setHashVersion($hashVersion)
    {
        $this->hashVersion = $hashVersion;

        return $this;
    }

    /**
     * Get hashVersion
     *
     * @return integer
     */
    public function getHashVersion()
    {
        return $this->hashVersion;
    }

    /**
     * Set person
     *
     * @param \Databases\OsPosBundle\Entity\OsposPeople $person
     *
     * @return OsposEmployees
     */
    public function setPerson(\Databases\OsPosBundle\Entity\OsposPeople $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Databases\OsPosBundle\Entity\OsposPeople
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Add permission
     *
     * @param \Databases\OsPosBundle\Entity\OsposPermissions $permission
     *
     * @return OsposEmployees
     */
    public function addPermission(\Databases\OsPosBundle\Entity\OsposPermissions $permission)
    {
        $this->permission[] = $permission;

        return $this;
    }

    /**
     * Remove permission
     *
     * @param \Databases\OsPosBundle\Entity\OsposPermissions $permission
     */
    public function removePermission(\Databases\OsPosBundle\Entity\OsposPermissions $permission)
    {
        $this->permission->removeElement($permission);
    }

    /**
     * Get permission
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermission()
    {
        return $this->permission;
    }
}
