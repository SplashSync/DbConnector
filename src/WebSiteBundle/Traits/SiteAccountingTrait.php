<?php

namespace WebSiteBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

//
// DROP TRIGGER IF EXISTS `update`;
// CREATE DEFINER=`root`@`localhost` TRIGGER `update` 
// AFTER UPDATE ON `ospos_items` FOR EACH ROW 
// BEGIN 
// INSERT INTO `splash__DbConnector`.`sites__commits` ( site_id, commitedAt, ObjectType, ObjectId, Action ) 
// VALUES ( 1, SYSDATE(), "product", NEW.item_id, "update" ); 
// END



/**
 * Site Splash Account trait
 */
trait SiteAccountingTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="AccountId", type="string", length=255)
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="AccountKey", type="string", length=255)
     */
    private $accountKey;

    /**
     * @var bool
     *
     * @ORM\Column(name="ExpertMode", type="boolean", nullable=true)
     */
    private $expertMode;
    
    /**
     * @var string
     *
     * @ORM\Column(name="AccountHost", type="string", length=255, nullable=true)
     */
    private $accountHost;

    /**
     * Set accountId
     *
     * @param string $accountId
     *
     * @return Site
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set accountKey
     *
     * @param string $accountKey
     *
     * @return Site
     */
    public function setAccountKey($accountKey)
    {
        $this->accountKey = $accountKey;

        return $this;
    }

    /**
     * Get accountKey
     *
     * @return string
     */
    public function getAccountKey()
    {
        return $this->accountKey;
    }


    /**
     * Set expertMode
     *
     * @param boolean $expertMode
     *
     * @return Site
     */
    public function setExpertMode($expertMode)
    {
        $this->expertMode = $expertMode;

        return $this;
    }

    /**
     * Get expertMode
     *
     * @return boolean
     */
    public function getExpertMode()
    {
        return $this->expertMode;
    }

    /**
     * Set accountHost
     *
     * @param string $accountHost
     *
     * @return Site
     */
    public function setAccountHost($accountHost)
    {
        $this->accountHost = $accountHost;

        return $this;
    }

    /**
     * Get accountHost
     *
     * @return string
     */
    public function getAccountHost()
    {
        return $this->accountHost;
    }
}
