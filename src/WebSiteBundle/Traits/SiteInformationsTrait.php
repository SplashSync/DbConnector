<?php

namespace WebSiteBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site Informations Trait
 */
trait SiteInformationsTrait
{

    /**
     * @var string
     *
     * @ORM\Column(name="ShortDescription", type="string", length=128, nullable=true)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="LongDescription", type="string", length=255, nullable=true)
     */
    private $longDescription;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Company", type="string", length=128, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="Address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="Zip", type="string", length=32, nullable=true)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="Town", type="string", length=255, nullable=true)
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="Country", type="string", length=255, nullable=true)
     */
    private $country;
    
    /**
     * @var string
     *
     * @ORM\Column(name="PublicUrl", type="string", length=512, nullable=true)
     */
    private $publicUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return Site
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     *
     * @return Site
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }
    
    /**
     * Set company
     *
     * @param string $company
     *
     * @return Site
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Site
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return Site
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return Site
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Site
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    /**
     * Set publicUrl
     *
     * @param string $publicUrl
     *
     * @return Site
     */
    public function setPublicUrl($publicUrl)
    {
        $this->publicUrl = $publicUrl;

        return $this;
    }

    /**
     * Get publicUrl
     *
     * @return string
     */
    public function getPublicUrl()
    {
        return $this->publicUrl;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Site
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Site
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

}
