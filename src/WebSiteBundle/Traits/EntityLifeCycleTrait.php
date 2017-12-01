<?php

namespace WebSiteBundle\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Core EntityLifecycle
 *
 */
trait EntityLifeCycleTrait
{
    /**
     * @ORM\Column(name="date_created", type="datetime", nullable=TRUE)
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="date_updated", type="datetime", nullable=TRUE)
     */
    protected $updatedAt;
    
    /** 
     * @ORM\PrePersist() 
     */    
    public function prePersist()
    {
        $this->setCreatedAt(new DateTime);
        $this->setUpdatedAt(new DateTime);
    }

    /** 
     * @ORM\PreUpdate() 
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new DateTime);
    }  
    
    /**
     * @param \DateTime $createdAt
     * @return void
     */
    protected function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    protected function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
}
