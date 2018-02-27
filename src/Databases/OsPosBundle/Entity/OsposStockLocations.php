<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposStockLocations
 *
 * @ORM\Table(name="ospos_stock_locations")
 * @ORM\Entity
 */
class OsposStockLocations
{
    /**
     * @var string
     *
     * @ORM\Column(name="location_name", type="string", length=255, nullable=true)
     */
    private $locationName;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="location_id", type="integer")
     */
    private $locationId;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Databases\OsPosBundle\Entity\OsposItems", mappedBy="location")
     */
    private $item;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->item = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set locationName
     *
     * @param string $locationName
     *
     * @return OsposStockLocations
     */
    public function setLocationName($locationName)
    {
        $this->locationName = $locationName;

        return $this;
    }

    /**
     * Get locationName
     *
     * @return string
     */
    public function getLocationName()
    {
        return $this->locationName;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return OsposStockLocations
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
     * Get locationId
     *
     * @return integer
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * Add item
     *
     * @param \Databases\OsPosBundle\Entity\OsposItems $item
     *
     * @return OsposStockLocations
     */
    public function addItem(\Databases\OsPosBundle\Entity\OsposItems $item)
    {
        $this->item[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \Databases\OsPosBundle\Entity\OsposItems $item
     */
    public function removeItem(\Databases\OsPosBundle\Entity\OsposItems $item)
    {
        $this->item->removeElement($item);
    }

    /**
     * Get item
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItem()
    {
        return $this->item;
    }
}
