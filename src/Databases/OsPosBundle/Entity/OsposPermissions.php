<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposPermissions
 *
 * @ORM\Table(name="ospos_permissions", indexes={@ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="ospos_permissions_ibfk_2", columns={"location_id"})})
 * @ORM\Entity
 */
class OsposPermissions
{
    /**
     * @var string
     *
     * @ORM\Column(name="permission_id", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $permissionId;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposModules
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="module_id")
     * })
     */
    private $module;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposStockLocations
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposStockLocations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     * })
     */
    private $location;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Databases\OsPosBundle\Entity\OsposEmployees", inversedBy="permission")
     * @ORM\JoinTable(name="ospos_grants",
     *   joinColumns={
     *     @ORM\JoinColumn(name="permission_id", referencedColumnName="permission_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     *   }
     * )
     */
    private $person;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->person = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get permissionId
     *
     * @return string
     */
    public function getPermissionId()
    {
        return $this->permissionId;
    }

    /**
     * Set module
     *
     * @param \Databases\OsPosBundle\Entity\OsposModules $module
     *
     * @return OsposPermissions
     */
    public function setModule(\Databases\OsPosBundle\Entity\OsposModules $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Databases\OsPosBundle\Entity\OsposModules
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set location
     *
     * @param \Databases\OsPosBundle\Entity\OsposStockLocations $location
     *
     * @return OsposPermissions
     */
    public function setLocation(\Databases\OsPosBundle\Entity\OsposStockLocations $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \Databases\OsPosBundle\Entity\OsposStockLocations
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Add person
     *
     * @param \Databases\OsPosBundle\Entity\OsposEmployees $person
     *
     * @return OsposPermissions
     */
    public function addPerson(\Databases\OsPosBundle\Entity\OsposEmployees $person)
    {
        $this->person[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \Databases\OsPosBundle\Entity\OsposEmployees $person
     */
    public function removePerson(\Databases\OsPosBundle\Entity\OsposEmployees $person)
    {
        $this->person->removeElement($person);
    }

    /**
     * Get person
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerson()
    {
        return $this->person;
    }
}
