<?php

namespace WebSiteBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use WebSiteBundle\Traits\SiteDatabaseTrait;
use WebSiteBundle\Traits\SiteInformationsTrait;
use WebSiteBundle\Traits\EntityLifeCycleTrait;

/**
 * Site
 *
 * @ORM\Table(name="sites__site")
 * @ORM\Entity(repositoryClass="WebSiteBundle\Repository\SiteRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 */
class Site
{
    use SiteInformationsTrait;
    use SiteDatabaseTrait;
    use EntityLifeCycleTrait;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="SiteName", type="string", length=255, unique=true)
     */
    private $siteName;

    /**
     * @var string
     *
     * @ORM\Column(name="Enabled", type="boolean")
     */
    private $enabled = True;

    
    public function __construct() {
        $this->setDatabaseType('MySql');
        $this->setServerType('OsCommerce_2rc3');
    }

    
    public function __toString() {
        return $this->getSiteName();
    }

    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set siteName
     *
     * @param string $siteName
     *
     * @return Site
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * Get siteName
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->siteName;
    }


    /**
     * Set serverType
     *
     * @param string $serverType
     *
     * @return Site
     */
    public function setServerType($serverType)
    {
        $this->serverType = $serverType;

        return $this;
    }

    /**
     * Get serverType
     *
     * @return string
     */
    public function getServerType()
    {
        return $this->serverType;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Site
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
