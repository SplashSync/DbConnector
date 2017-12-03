<?php

/*
 * Copyright (C) 2011-2018  Splash Sync       <contact@splashsync.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */

namespace Databases\OsPosBundle\Entity\ThirdParty;

use Splash\Bundle\Annotation as SPL;

/**
 * Description of PeopleRedirection
 *
 * @author nanard33
 */
trait PeopleRedirectionTrait {
    
    /**
     * @var string
     *
     * @SPL\Field(  
     *          id      =   "firstName",
     *          type    =   "varchar",
     *          name    =   "First Name",
     *          itemtype=   "http://schema.org/Person", itemprop="familyName",
     *          inlist  =   true,
     *          required=   true,
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @SPL\Field(  
     *          id      =   "lastName",
     *          type    =   "varchar",
     *          name    =   "Last Name",
     *          itemtype=   "http://schema.org/Person", itemprop="givenName",
     *          inlist  =   true,
     *          required=   true,
     * )
     */
    private $lastName;

    /**
     * @var integer
     *
     * @SPL\Field(  
     *          id      =   "gender",
     *          type    =   "varchar",
     *          name    =   "Gender",
     *          itemtype=   "http://schema.org/Person", itemprop="gender",
     * )
     * 
     */
    private $gender;

    /**
     * @var string
     *
     * @SPL\Field(  
     *          id      =   "phoneNumber",
     *          type    =   "phone",
     *          name    =   "Phone Number",
     *          itemtype=   "http://schema.org/PostalAddress", itemprop="telephone",
     * )
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @SPL\Field(  
     *          id      =   "email",
     *          type    =   "email",
     *          name    =   "Email",
     *          itemtype=   "http://schema.org/ContactPoint", itemprop="email",
     *          inlist  =   true,
     *          required=   true,
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @SPL\Field(  
     *          id      =   "address1",
     *          type    =   "varchar",
     *          name    =   "Street",
     *          itemtype=   "http://schema.org/PostalAddress", itemprop="streetAddress",
     *          required=   true,
     * )
     */
    private $address1;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="address_2", type="string", length=255, nullable=false)
//     */
//    private $address2;

    /**
     * @var string
     *
     * @SPL\Field(  
     *          id      =   "city",
     *          type    =   "varchar",
     *          name    =   "City Name",
     *          itemtype=   "http://schema.org/PostalAddress", itemprop="addressLocality",
     *          required=   true,
     * )
     */
    private $city;

    /**
     * @var string
     *
     * @SPL\Field(  
     *          id      =   "state",
     *          type    =   "state",
     *          name    =   "Province Code",
     *          itemtype=   "http://schema.org/PostalAddress", itemprop="addressRegion",
     *          write   =   false,
     * )
     */
    private $state;

    /**
     * @var string
     *
     * @SPL\Field(  
     *          id      =   "zip",
     *          type    =   "varchar",
     *          name    =   "Zip/Postal Code",
     *          itemtype=   "http://schema.org/PostalAddress", itemprop="postalCode",
     *          inlist  =   true,
     *          required=   false,
     * )
     */
    private $zip;

    /**
     * @var string
     *
     * @SPL\Field(  
     *          id      =   "country",
     *          type    =   "country",
     *          name    =   "Country Code",
     *          itemtype=   "http://schema.org/PostalAddress", itemprop="addressCountry",
     *          inlist  =   true,
     *          required=   false,
     * )
     */
    private $country;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="comments", type="text", length=65535, nullable=false)
//     */
//    private $comments;

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return OsposPeople
     */
    public function setFirstName($firstName)
    {
        $this->getPerson()->setFirstName($firstName);

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->getPerson()->getFirstName();
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return OsposPeople
     */
    public function setLastName($lastName)
    {
        $this->getPerson()->setLastName($lastName);

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->getPerson()->getLastName();
    }

    /**
     * Set gender
     *
     * @param integer $gender
     *
     * @return OsposPeople
     */
    public function setGender($gender)
    {
        $this->getPerson()->setGender($gender);

        return $this;
    }

    /**
     * Get gender
     * @example 0 => Male // 1 => Female // 2 => Neutral
     * @return integer
     */
    public function getGender()
    {
        return $this->getPerson()->getGender();
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return OsposPeople
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->getPerson()->setPhoneNumber($phoneNumber);

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->getPerson()->getPhoneNumber();
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return OsposPeople
     */
    public function setEmail($email)
    {
        $this->getPerson()->setEmail($email);

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getPerson()->getEmail();
    }

    /**
     * Set address1
     *
     * @param string $address1
     *
     * @return OsposPeople
     */
    public function setAddress1($address1)
    {
        $this->getPerson()->setAddress1($address1);

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->getPerson()->getAddress1();
    }

//    /**
//     * Set address2
//     *
//     * @param string $address2
//     *
//     * @return OsposPeople
//     */
//    public function setAddress2($address2)
//    {
//        $this->getPerson()->address2 = $address2;
//
//        return $this;
//    }
//
//    /**
//     * Get address2
//     *
//     * @return string
//     */
//    public function getAddress2()
//    {
//        return $this->getPerson()->address2;
//    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return OsposPeople
     */
    public function setCity($city)
    {
        $this->getPerson()->setCity($city);

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->getPerson()->getCity();
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return OsposPeople
     */
    public function setState($state)
    {
        $this->getPerson()->setState($state);

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->getPerson()->getState();
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return OsposPeople
     */
    public function setZip($zip)
    {
        $this->getPerson()->setZip($zip);

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->getPerson()->getZip();
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return OsposPeople
     */
    public function setCountry($country)
    {
        $this->getPerson()->setCountry($country);

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->getPerson()->getCountry();
    }

//    /**
//     * Set comments
//     *
//     * @param string $comments
//     *
//     * @return OsposPeople
//     */
//    public function setComments($comments)
//    {
//        $this->getPerson()->comments = $comments;
//
//        return $this;
//    }
//
//    /**
//     * Get comments
//     *
//     * @return string
//     */
//    public function getComments()
//    {
//        return $this->getPerson()->comments;
//    }

    /**
     * Get personId
     *
     * @return integer
     */
    public function getPersonId()
    {
        return $this->getPerson()->personId;
    }
   
}
