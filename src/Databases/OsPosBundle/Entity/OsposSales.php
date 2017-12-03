<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposSales
 *
 * @ORM\Table(name="ospos_sales", uniqueConstraints={@ORM\UniqueConstraint(name="invoice_number", columns={"invoice_number"})}, indexes={@ORM\Index(name="customer_id", columns={"customer_id"}), @ORM\Index(name="employee_id", columns={"employee_id"}), @ORM\Index(name="sale_time", columns={"sale_time"}), @ORM\Index(name="dinner_table_id", columns={"dinner_table_id"})})
 * @ORM\Entity
 */
class OsposSales
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sale_time", type="datetime", nullable=false)
     */
    private $saleTime = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_number", type="string", length=32, nullable=true)
     */
    private $invoiceNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="quote_number", type="string", length=32, nullable=true)
     */
    private $quoteNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sale_status", type="boolean", nullable=false)
     */
    private $saleStatus = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="sale_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $saleId;

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
     * @var \Databases\OsPosBundle\Entity\OsposCustomers
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposCustomers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="person_id")
     * })
     */
    private $customer;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposDinnerTables
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposDinnerTables")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dinner_table_id", referencedColumnName="dinner_table_id")
     * })
     */
    private $dinnerTable;



    /**
     * Set saleTime
     *
     * @param \DateTime $saleTime
     *
     * @return OsposSales
     */
    public function setSaleTime($saleTime)
    {
        $this->saleTime = $saleTime;

        return $this;
    }

    /**
     * Get saleTime
     *
     * @return \DateTime
     */
    public function getSaleTime()
    {
        return $this->saleTime;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return OsposSales
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
     * Set invoiceNumber
     *
     * @param string $invoiceNumber
     *
     * @return OsposSales
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Get invoiceNumber
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Set quoteNumber
     *
     * @param string $quoteNumber
     *
     * @return OsposSales
     */
    public function setQuoteNumber($quoteNumber)
    {
        $this->quoteNumber = $quoteNumber;

        return $this;
    }

    /**
     * Get quoteNumber
     *
     * @return string
     */
    public function getQuoteNumber()
    {
        return $this->quoteNumber;
    }

    /**
     * Set saleStatus
     *
     * @param boolean $saleStatus
     *
     * @return OsposSales
     */
    public function setSaleStatus($saleStatus)
    {
        $this->saleStatus = $saleStatus;

        return $this;
    }

    /**
     * Get saleStatus
     *
     * @return boolean
     */
    public function getSaleStatus()
    {
        return $this->saleStatus;
    }

    /**
     * Get saleId
     *
     * @return integer
     */
    public function getSaleId()
    {
        return $this->saleId;
    }

    /**
     * Set employee
     *
     * @param \Databases\OsPosBundle\Entity\OsposEmployees $employee
     *
     * @return OsposSales
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
     * Set customer
     *
     * @param \Databases\OsPosBundle\Entity\OsposCustomers $customer
     *
     * @return OsposSales
     */
    public function setCustomer(\Databases\OsPosBundle\Entity\OsposCustomers $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Databases\OsPosBundle\Entity\OsposCustomers
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set dinnerTable
     *
     * @param \Databases\OsPosBundle\Entity\OsposDinnerTables $dinnerTable
     *
     * @return OsposSales
     */
    public function setDinnerTable(\Databases\OsPosBundle\Entity\OsposDinnerTables $dinnerTable = null)
    {
        $this->dinnerTable = $dinnerTable;

        return $this;
    }

    /**
     * Get dinnerTable
     *
     * @return \Databases\OsPosBundle\Entity\OsposDinnerTables
     */
    public function getDinnerTable()
    {
        return $this->dinnerTable;
    }
}
