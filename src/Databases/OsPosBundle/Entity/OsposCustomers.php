<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Splash\Bundle\Annotation as SPL;

use Databases\OsPosBundle\Entity\ThirdParty\PeopleRedirectionTrait;

/**
 * OsposCustomers
 *
 * @ORM\Table(name="ospos_customers", uniqueConstraints={@ORM\UniqueConstraint(name="account_number", columns={"account_number"})}, indexes={@ORM\Index(name="person_id", columns={"person_id"}), @ORM\Index(name="package_id", columns={"package_id"})})
 * @ORM\Entity
 * 
 * @author B. Paquier <contact@splashsync.com>
 * @SPL\Object( type                    =   "ThirdParty",
 *              disabled                =   false,
 *              name                    =   "Customer",
 *              description             =   "OsPos Customer Object",
 *              icon                    =   "fa fa-user",
 *              enable_push_created     =    false,
 *              target                  =   "Databases\OsPosBundle\Entity\OsposCustomers",
 *              transformer_service     =   "splash.databases.ospos.transformer"
 * )
 * 
 * @ORM\HasLifecycleCallbacks
 * 
 */
class OsposCustomers
{
    use PeopleRedirectionTrait;
    
    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=255, nullable=true)
     * 
     * @SPL\Field(  
     *          id      =   "companyName",
     *          type    =   "varchar",
     *          name    =   "User Id",
     *          itemtype=   "http://schema.org/Organization", itemprop="legalName",
     *          write   =   false,
     *          inlist  =   true,
     * )
     *  
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="account_number", type="string", length=255, nullable=true)
     */
    private $accountNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="taxable", type="integer", nullable=false)
     */
    private $taxable = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="sales_tax_code", type="string", length=32, nullable=false)
     */
    private $salesTaxCode = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="discount_percent", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $discountPercent = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer", nullable=true)
     */
    private $points;

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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposPeople", cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     * ORM\Column(name="person_id", type="integer")
     */
    private $person;
    
    private $id;
    
    /**
     * @var \Databases\OsPosBundle\Entity\OsposCustomersPackages
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposCustomersPackages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="package_id", referencedColumnName="package_id")
     * })
     */
    private $package;

    //====================================================================//
    // Customer Construct Function
    //====================================================================//

    public function __construct() {
        $this->setPerson( new OsposPeople() );
    }

    //==============================================================================
    //      Lifecycle          
    //==============================================================================
    
    /** 
     * @ORM\PrePersist() 
     */    
    public function prePersist()
    {
//        //====================================================================//
//        // Set Dates
//        $this->setCreatedAt(new DateTime);
//        $this->setUpdatedAt(new DateTime);
//
//        //====================================================================//
//        // Set Info
//        $this->setInfo(new Info);
//        
//        //====================================================================//
//        // Generate Unique Identifier
//        $this->newIdentifier();
//        
//        //====================================================================//
//        // Generate Unique Encryption Key
//        $this->newCryptKey();        
        
//        dump($this);
    }


    //====================================================================//
    // Splash Specific Getters & Setters
    //====================================================================//

    /**
     * get Object Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getPerson()->getPersonId();
    }
    
    //====================================================================//
    // Simple Getters & Setters
    //====================================================================//
    
    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return OsposCustomers
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
     * Set accountNumber
     *
     * @param string $accountNumber
     *
     * @return OsposCustomers
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
     * Set taxable
     *
     * @param integer $taxable
     *
     * @return OsposCustomers
     */
    public function setTaxable($taxable)
    {
        $this->taxable = $taxable;

        return $this;
    }

    /**
     * Get taxable
     *
     * @return integer
     */
    public function getTaxable()
    {
        return $this->taxable;
    }

    /**
     * Set salesTaxCode
     *
     * @param string $salesTaxCode
     *
     * @return OsposCustomers
     */
    public function setSalesTaxCode($salesTaxCode)
    {
        $this->salesTaxCode = $salesTaxCode;

        return $this;
    }

    /**
     * Get salesTaxCode
     *
     * @return string
     */
    public function getSalesTaxCode()
    {
        return $this->salesTaxCode;
    }

    /**
     * Set discountPercent
     *
     * @param string $discountPercent
     *
     * @return OsposCustomers
     */
    public function setDiscountPercent($discountPercent)
    {
        $this->discountPercent = $discountPercent;

        return $this;
    }

    /**
     * Get discountPercent
     *
     * @return string
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return OsposCustomers
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return OsposCustomers
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
     * @return OsposCustomers
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

    /**
     * Set package
     *
     * @param \Databases\OsPosBundle\Entity\OsposCustomersPackages $package
     *
     * @return OsposCustomers
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
}
