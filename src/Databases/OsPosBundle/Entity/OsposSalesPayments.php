<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposSalesPayments
 *
 * @ORM\Table(name="ospos_sales_payments", indexes={@ORM\Index(name="sale_id", columns={"sale_id"})})
 * @ORM\Entity
 */
class OsposSalesPayments
{
    /**
     * @var string
     *
     * @ORM\Column(name="payment_amount", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $paymentAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_type", type="string", length=40)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $paymentType;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposSales
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposSales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale_id", referencedColumnName="sale_id")
     * })
     */
    private $sale;



    /**
     * Set paymentAmount
     *
     * @param string $paymentAmount
     *
     * @return OsposSalesPayments
     */
    public function setPaymentAmount($paymentAmount)
    {
        $this->paymentAmount = $paymentAmount;

        return $this;
    }

    /**
     * Get paymentAmount
     *
     * @return string
     */
    public function getPaymentAmount()
    {
        return $this->paymentAmount;
    }

    /**
     * Set paymentType
     *
     * @param string $paymentType
     *
     * @return OsposSalesPayments
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set sale
     *
     * @param \Databases\OsPosBundle\Entity\OsposSales $sale
     *
     * @return OsposSalesPayments
     */
    public function setSale(\Databases\OsPosBundle\Entity\OsposSales $sale)
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
