<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposInventory
 *
 * @ORM\Table(name="ospos_inventory", indexes={@ORM\Index(name="trans_items", columns={"trans_items"}), @ORM\Index(name="trans_user", columns={"trans_user"}), @ORM\Index(name="trans_location", columns={"trans_location"})})
 * @ORM\Entity
 */
class OsposInventory
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="trans_date", type="datetime", nullable=false)
     */
    private $transDate = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="trans_comment", type="text", length=65535, nullable=false)
     */
    private $transComment;

    /**
     * @var string
     *
     * @ORM\Column(name="trans_inventory", type="decimal", precision=15, scale=3, nullable=false)
     */
    private $transInventory = '0.000';

    /**
     * @var integer
     *
     * @ORM\Column(name="trans_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $transId;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposItems
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposItems")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trans_items", referencedColumnName="item_id")
     * })
     */
    private $transItems;

//    /**
//     * @var \Databases\OsPosBundle\Entity\OsposEmployees
//     *
//     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposEmployees")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="trans_user", referencedColumnName="person_id")
//     * })
//     */
    /**
     * @var int
     *
     * @ORM\Column(name="trans_user", type="integer")
     */
    private $transUser;

//    /**
//     * @var \Databases\OsPosBundle\Entity\OsposStockLocations
//     *
//     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposStockLocations")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="trans_location", referencedColumnName="location_id")
//     * })
//     */
    /**
     * @var int
     *
     * @ORM\Column(name="trans_location", type="integer")
     */    
    private $transLocation;



    /**
     * Set transDate
     *
     * @param \DateTime $transDate
     *
     * @return OsposInventory
     */
    public function setTransDate($transDate)
    {
        $this->transDate = $transDate;

        return $this;
    }

    /**
     * Get transDate
     *
     * @return \DateTime
     */
    public function getTransDate()
    {
        return $this->transDate;
    }

    /**
     * Set transComment
     *
     * @param string $transComment
     *
     * @return OsposInventory
     */
    public function setTransComment($transComment)
    {
        $this->transComment = $transComment;

        return $this;
    }

    /**
     * Get transComment
     *
     * @return string
     */
    public function getTransComment()
    {
        return $this->transComment;
    }

    /**
     * Set transInventory
     *
     * @param string $transInventory
     *
     * @return OsposInventory
     */
    public function setTransInventory($transInventory)
    {
        $this->transInventory = $transInventory;

        return $this;
    }

    /**
     * Get transInventory
     *
     * @return string
     */
    public function getTransInventory()
    {
        return $this->transInventory;
    }

    /**
     * Get transId
     *
     * @return integer
     */
    public function getTransId()
    {
        return $this->transId;
    }

    /**
     * Set transItems
     *
     * @param \Databases\OsPosBundle\Entity\OsposItems $transItems
     *
     * @return OsposInventory
     */
    public function setTransItems(\Databases\OsPosBundle\Entity\OsposItems $transItems = null)
    {
        $this->transItems = $transItems;

        return $this;
    }

    /**
     * Get transItems
     *
     * @return \Databases\OsPosBundle\Entity\OsposItems
     */
    public function getTransItems()
    {
        return $this->transItems;
    }

    /**
     * Set transUser
     *
     * @param int $transUser
     *
     * @return OsposInventory
     */
    public function setTransUser( int $transUser)
    {
        $this->transUser = $transUser;

        return $this;
    }

    /**
     * Get transUser
     *
     * @return int
     */
    public function getTransUser()
    {
        return $this->transUser;
    }

    /**
     * Set transLocation
     *
     * @param int $transLocation
     *
     * @return OsposInventory
     */
    public function setTransLocation( int $transLocation )
    {
        $this->transLocation = $transLocation;

        return $this;
    }

    /**
     * Get transLocation
     *
     * @return int
     */
    public function getTransLocation()
    {
        return $this->transLocation;
    }
    
//    /**
//     * Set transUser
//     *
//     * @param \Databases\OsPosBundle\Entity\OsposEmployees $transUser
//     *
//     * @return OsposInventory
//     */
//    public function setTransUser(\Databases\OsPosBundle\Entity\OsposEmployees $transUser = null)
//    {
//        $this->transUser = $transUser;
//
//        return $this;
//    }
//
//    /**
//     * Get transUser
//     *
//     * @return \Databases\OsPosBundle\Entity\OsposEmployees
//     */
//    public function getTransUser()
//    {
//        return $this->transUser;
//    }
//
//    /**
//     * Set transLocation
//     *
//     * @param \Databases\OsPosBundle\Entity\OsposStockLocations $transLocation
//     *
//     * @return OsposInventory
//     */
//    public function setTransLocation(\Databases\OsPosBundle\Entity\OsposStockLocations $transLocation = null)
//    {
//        $this->transLocation = $transLocation;
//
//        return $this;
//    }
//
//    /**
//     * Get transLocation
//     *
//     * @return \Databases\OsPosBundle\Entity\OsposStockLocations
//     */
//    public function getTransLocation()
//    {
//        return $this->transLocation;
//    }
}
