<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposCustomersPoints
 *
 * @ORM\Table(name="ospos_customers_points", indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="package_id", columns={"package_id"}), @ORM\Index(name="sale_id", columns={"sale_id"})})
 * @ORM\Entity
 */
class OsposCustomersPoints
{
    /**
     * @var integer
     *
     * @ORM\Column(name="points_earned", type="integer", nullable=false)
     */
    private $pointsEarned;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposCustomers
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposCustomers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     * })
     */
    private $person;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposCustomersPackages
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposCustomersPackages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="package_id", referencedColumnName="package_id")
     * })
     */
    private $package;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposSales
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposSales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale_id", referencedColumnName="sale_id")
     * })
     */
    private $sale;



    /**
     * Set pointsEarned
     *
     * @param integer $pointsEarned
     *
     * @return OsposCustomersPoints
     */
    public function setPointsEarned($pointsEarned)
    {
        $this->pointsEarned = $pointsEarned;

        return $this;
    }

    /**
     * Get pointsEarned
     *
     * @return integer
     */
    public function getPointsEarned()
    {
        return $this->pointsEarned;
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
     * Set person
     *
     * @param \Databases\OsPosBundle\Entity\OsposCustomers $person
     *
     * @return OsposCustomersPoints
     */
    public function setPerson(\Databases\OsPosBundle\Entity\OsposCustomers $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Databases\OsPosBundle\Entity\OsposCustomers
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set package
     *
     * @param \Databases\OsPosBundle\Entity\OsposCustomersPackages $package
     *
     * @return OsposCustomersPoints
     */
    public function setPackage(\Databases\OsPosBundle\Entity\OsposCustomersPackages $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \Databases\OsPosBundle\Entity\OsposCustomersPackages
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set sale
     *
     * @param \Databases\OsPosBundle\Entity\OsposSales $sale
     *
     * @return OsposCustomersPoints
     */
    public function setSale(\Databases\OsPosBundle\Entity\OsposSales $sale = null)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return \Databases\OsPosBundle\Entity\OsposSales
     */
    public function getSale()
    {
        return $this->sale;
    }
}
