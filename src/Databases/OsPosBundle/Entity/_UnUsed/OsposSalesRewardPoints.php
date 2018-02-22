<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposSalesRewardPoints
 *
 * @ORM\Table(name="ospos_sales_reward_points", indexes={@ORM\Index(name="sale_id", columns={"sale_id"})})
 * @ORM\Entity
 */
class OsposSalesRewardPoints
{
    /**
     * @var float
     *
     * @ORM\Column(name="earned", type="float", precision=10, scale=0, nullable=false)
     */
    private $earned;

    /**
     * @var float
     *
     * @ORM\Column(name="used", type="float", precision=10, scale=0, nullable=false)
     */
    private $used;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * Set earned
     *
     * @param float $earned
     *
     * @return OsposSalesRewardPoints
     */
    public function setEarned($earned)
    {
        $this->earned = $earned;

        return $this;
    }

    /**
     * Get earned
     *
     * @return float
     */
    public function getEarned()
    {
        return $this->earned;
    }

    /**
     * Set used
     *
     * @param float $used
     *
     * @return OsposSalesRewardPoints
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return float
     */
    public function getUsed()
    {
        return $this->used;
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
     * Set sale
     *
     * @param \Databases\OsPosBundle\Entity\OsposSales $sale
     *
     * @return OsposSalesRewardPoints
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
