<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposSuppliers
 *
 * @ORM\Table(name="ospos_suppliers", uniqueConstraints={@ORM\UniqueConstraint(name="account_number", columns={"account_number"})}, indexes={@ORM\Index(name="person_id", columns={"person_id"})})
 * @ORM\Entity
 */
class OsposSuppliers
{
    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=255, nullable=false)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_name", type="string", length=255, nullable=false)
     */
    private $agencyName;

    /**
     * @var string
     *
     * @ORM\Column(name="account_number", type="string", length=255, nullable=true)
     */
    private $accountNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private $deleted = '0';

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
     * Set companyName
     *
     * @param string $companyName
     *
     * @return OsposSuppliers
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set agencyName
     *
     * @param string $agencyName
     *
     * @return OsposSuppliers
     */
    public function setAgencyName($agencyName)
    {
        $this->agencyName = $agencyName;

        return $this;
    }

    /**
     * Get agencyName
     *
     * @return string
     */
    public function getAgencyName()
    {
        return $this->agencyName;
    }

    /**
     * Set accountNumber
     *
     * @param string $accountNumber
     *
     * @return OsposSuppliers
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return OsposSuppliers
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
     * Set person
     *
     * @param \Databases\OsPosBundle\Entity\OsposPeople $person
     *
     * @return OsposSuppliers
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
}
