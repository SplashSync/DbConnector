<?php

namespace WebSiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commits
 *
 * @ORM\Table(name="sites__commits")
 * @ORM\Entity(repositoryClass="WebSiteBundle\Repository\CommitsRepository")
 */
class Commits
{
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="WebSiteBundle\Entity\Site")
     */
    protected $site; 

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="commitedAt", type="datetime")
     */
    private $commitedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="ObjectType", type="string", length=255)
     */
    private $objectType;

    /**
     * @var string
     *
     * @ORM\Column(name="ObjectTable", type="string", length=255, nullable=true)
     */
    private $objectTable;

    /**
     * @var string
     *
     * @ORM\Column(name="ObjectId", type="string", length=255)
     */
    private $objectId;

    /**
     * @var string
     *
     * @ORM\Column(name="Action", type="string", length=255)
     */
    private $action;

    /**
     * @var bool
     *
     * @ORM\Column(name="Notified", type="boolean", nullable=true)
     */
    private $notified;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="notifiedAt", type="datetime", nullable=true)
     */
    private $notifiedAt;


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
     * Set guid
     *
     * @param string $guid
     *
     * @return Commits
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;

        return $this;
    }

    /**
     * Get guid
     *
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Set commitedAt
     *
     * @param \DateTime $commitedAt
     *
     * @return Commits
     */
    public function setCommitedAt($commitedAt)
    {
        $this->commitedAt = $commitedAt;

        return $this;
    }

    /**
     * Get commitedAt
     *
     * @return \DateTime
     */
    public function getCommitedAt()
    {
        return $this->commitedAt;
    }

    /**
     * Set objectType
     *
     * @param string $objectType
     *
     * @return Commits
     */
    public function setObjectType($objectType)
    {
        $this->objectType = $objectType;

        return $this;
    }

    /**
     * Get objectType
     *
     * @return string
     */
    public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * Set objectTable
     *
     * @param string $objectTable
     *
     * @return Commits
     */
    public function setObjectTable($objectTable)
    {
        $this->objectTable = $objectTable;

        return $this;
    }

    /**
     * Get objectTable
     *
     * @return string
     */
    public function getObjectTable()
    {
        return $this->objectTable;
    }

    /**
     * Set objectId
     *
     * @param string $objectId
     *
     * @return Commits
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return string
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return Commits
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set notified
     *
     * @param boolean $notified
     *
     * @return Commits
     */
    public function setNotified($notified)
    {
        $this->notified = $notified;

        return $this;
    }

    /**
     * Get notified
     *
     * @return bool
     */
    public function getNotified()
    {
        return $this->notified;
    }

    /**
     * Set notifiedAt
     *
     * @param \DateTime $notifiedAt
     *
     * @return Commits
     */
    public function setNotifiedAt($notifiedAt)
    {
        $this->notifiedAt = $notifiedAt;

        return $this;
    }

    /**
     * Get notifiedAt
     *
     * @return \DateTime
     */
    public function getNotifiedAt()
    {
        return $this->notifiedAt;
    }

    /**
     * Set site
     *
     * @param \WebSiteBundle\Entity\Site $site
     *
     * @return Commits
     */
    public function setSite(\WebSiteBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \WebSiteBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }
}
