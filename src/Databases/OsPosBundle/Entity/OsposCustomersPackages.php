<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposCustomersPackages
 *
 * @ORM\Table(name="ospos_customers_packages")
 * @ORM\Entity
 */
class OsposCustomersPackages
{
    /**
     * @var string
     *
     * @ORM\Column(name="package_name", type="string", length=255, nullable=true)
     */
    private $packageName;

    /**
     * @var float
     *
     * @ORM\Column(name="points_percent", type="float", precision=10, scale=0, nullable=false)
     */
    private $pointsPercent = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="package_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $packageId;



    /**
     * Set packageName
     *
     * @param string $packageName
     *
     * @return OsposCustomersPackages
     */
    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;

        return $this;
    }

    /**
     * Get packageName
     *
     * @return string
     */
    public function getPackageName()
    {
        return $this->packageName;
    }

    /**
     * Set pointsPercent
     *
     * @param float $pointsPercent
     *
     * @return OsposCustomersPackages
     */
    public function setPointsPercent($pointsPercent)
    {
        $this->pointsPercent = $pointsPercent;

        return $this;
    }

    /**
     * Get pointsPercent
     *
     * @return float
     */
    public function getPointsPercent()
    {
        return $this->pointsPercent;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return OsposCustomersPackages
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
     * Get packageId
     *
     * @return integer
     */
    public function getPackageId()
    {
        return $this->packageId;
    }
}
