<?php

namespace WebSiteBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Connection;

//
// DROP TRIGGER IF EXISTS `update`;
// CREATE DEFINER=`root`@`localhost` TRIGGER `update` 
// AFTER UPDATE ON `ospos_items` FOR EACH ROW 
// BEGIN 
// INSERT INTO `splash__DbConnector`.`sites__commits` ( site_id, commitedAt, ObjectType, ObjectId, Action ) 
// VALUES ( 1, SYSDATE(), "product", NEW.item_id, "update" ); 
// END



/**
 * Site Database trait
 */
trait SiteDatabaseTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="DatabaseType", type="string", length=255)
     */
    private $databaseType;

    /**
     * @var string
     *
     * @ORM\Column(name="DatabaseHost", type="string", length=255, nullable=true)
     */
    private $databaseHost;

    /**
     * @var string
     *
     * @ORM\Column(name="DatabasePort", type="string", length=255, nullable=true)
     */
    private $databasePort;

    /**
     * @var string
     *
     * @ORM\Column(name="DatabaseName", type="string", length=255)
     */
    private $databaseName;

    /**
     * @var string
     *
     * @ORM\Column(name="DatabaseUser", type="string", length=255, nullable=true)
     */
    private $databaseUser;

    /**
     * @var string
     *
     * @ORM\Column(name="DatabasePassword", type="string", length=255, nullable=true)
     */
    private $databasePassword;

    /**
     * Get Database Configuration Array
     * 
     * @param Connection    $Connection         Current Database Connection
     * 
     * @return Site
     */
    public function getDatabaseConfiguration($Connection)
    {
        //==============================================================================
        // No Host Defined => Use Current Host & Config 
        if( empty($this->getDatabaseHost()) ) {
            $Params             =   $Connection->getParams();
            $Params['dbname']   =   $this->getDatabaseName();
            return $Params;
        }
        //==============================================================================
        // Host Defined => Use Custom Host & Config 
        return array(
            'driver'    => 'pdo_mysql',
            'host'      => $this->getDatabaseHost(),
            'port'      => (!empty($this->databasePort) ? $this->databasePort : '3306'),
            'dbname'    => $this->getDatabaseName(),
            'user'      => $this->getDatabaseUser(),
            'password'  => $this->getDatabasePassword()
        );
    }    
    
    /**
     * Set databaseType
     *
     * @param string $databaseType
     *
     * @return Site
     */
    public function setDatabaseType($databaseType)
    {
        $this->databaseType = $databaseType;

        return $this;
    }

    /**
     * Get databaseType
     *
     * @return string
     */
    public function getDatabaseType()
    {
        return $this->databaseType;
    }

    /**
     * Set databaseHost
     *
     * @param string $databaseHost
     *
     * @return Site
     */
    public function setDatabaseHost($databaseHost)
    {
        $this->databaseHost = $databaseHost;

        return $this;
    }

    /**
     * Get databaseHost
     *
     * @return string
     */
    public function getDatabaseHost()
    {
        return $this->databaseHost;
    }

    /**
     * Set databasePort
     *
     * @param string $databasePort
     *
     * @return Site
     */
    public function setDatabasePort($databasePort)
    {
        $this->databasePort = $databasePort;

        return $this;
    }

    /**
     * Get databasePort
     *
     * @return string
     */
    public function getDatabasePort()
    {
        return $this->databasePort;
    }

    /**
     * Set databaseName
     *
     * @param string $databaseName
     *
     * @return Site
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;

        return $this;
    }

    /**
     * Get databaseName
     *
     * @return string
     */
    public function getDatabaseName()
    {
        return $this->databaseName;
    }

    /**
     * Set databaseUser
     *
     * @param string $databaseUser
     *
     * @return Site
     */
    public function setDatabaseUser($databaseUser)
    {
        $this->databaseUser = $databaseUser;

        return $this;
    }

    /**
     * Get databaseUser
     *
     * @return string
     */
    public function getDatabaseUser()
    {
        return $this->databaseUser;
    }

    /**
     * Set databasePassword
     *
     * @param string $databasePassword
     *
     * @return Site
     */
    public function setDatabasePassword($databasePassword)
    {
        $this->databasePassword = $databasePassword;

        return $this;
    }

    /**
     * Get databasePassword
     *
     * @return string
     */
    public function getDatabasePassword()
    {
        return $this->databasePassword;
    }


}
