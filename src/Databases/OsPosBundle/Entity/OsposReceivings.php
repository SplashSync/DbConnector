<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposReceivings
 *
 * @ORM\Table(name="ospos_receivings", indexes={@ORM\Index(name="supplier_id", columns={"supplier_id"}), @ORM\Index(name="employee_id", columns={"employee_id"}), @ORM\Index(name="reference", columns={"reference"})})
 * @ORM\Entity
 */
class OsposReceivings
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="receiving_time", type="datetime", nullable=false)
     */
    private $receivingTime = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_type", type="string", length=20, nullable=true)
     */
    private $paymentType;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=32, nullable=true)
     */
    private $reference;

    /**
     * @var integer
     *
     * @ORM\Column(name="receiving_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $receivingId;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposEmployees
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposEmployees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee_id", referencedColumnName="person_id")
     * })
     */
    private $employee;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposSuppliers
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposSuppliers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="supplier_id", referencedColumnName="person_id")
     * })
     */
    private $supplier;



    /**
     * Set receivingTime
     *
     * @param \DateTime $receivingTime
     *
     * @return OsposReceivings
     */
    public function setReceivingTime($receivingTime)
    {
        $this->receivingTime = $receivingTime;

        return $this;
    }

    /**
     * Get receivingTime
     *
     * @return \DateTime
     */
    public function getReceivingTime()
    {
        return $this->receivingTime;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return OsposReceivings
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set paymentType
     *
     * @param string $paymentType
     *
     * @return OsposReceivings
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
     * Set reference
     *
     * @param string $reference
     *
     * @return OsposReceivings
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Get receivingId
     *
     * @return integer
     */
    public function getReceivingId()
    {
        return $this->receivingId;
    }

    /**
     * Set employee
     *
     * @param \Databases\OsPosBundle\Entity\OsposEmployees $employee
     *
     * @return OsposReceivings
     */
    public function setEmployee(\Databases\OsPosBundle\Entity\OsposEmployees $employee = null)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get employee
     *
     * @return \Databases\OsPosBundle\Entity\OsposEmployees
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Set supplier
     *
     * @param \Databases\OsPosBundle\Entity\OsposSuppliers $supplier
     *
     * @return OsposReceivings
     */
    public function setSupplier(\Databases\OsPosBundle\Entity\OsposSuppliers $supplier = null)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \Databases\OsPosBundle\Entity\OsposSuppliers
     */
    public function getSupplier()
    {
        return $this->supplier;
    }
}
