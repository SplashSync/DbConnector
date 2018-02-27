<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Databases\OsPosBundle\Entity\OsposItems;

/**
 * OsposItemsTaxes
 *
 * @ORM\Entity
 * @ORM\Table(name="ospos_items_taxes")
 * 
 */
class OsposItemsTaxes
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="percent", type="decimal")
     */
    private $percent = 0;


    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE") 
     * @ORM\Column(name="item_id", type="integer") 
     */
    private $item_id;
    
    /**
     * @var \Databases\OsPosBundle\Entity\OsposItems
     * 
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposItems", inversedBy="itemTaxes")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="item_id")
     */
    private $item;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OsposItemsTaxes
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set percent
     *
     * @param string $percent
     *
     * @return OsposItemsTaxes
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent
     *
     * @return string
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Set item
     *
     * @param OsposItems $item
     *
     * @return OsposItemsTaxes
     */
    public function setItem(OsposItems $item)
    {
        $this->item     =   $item;
        $this->item_id  =   $item->getId();
        return $this;
    }

    /**
     * Get item
     *
     * @return \Databases\OsPosBundle\Entity\OsposItems
     */
    public function getItem()
    {
        return $this->item;
    }
    
    /**
     * Set item id
     *
     * @param int $ItemId
     *
     * @return OsposItemsTaxes
     */
    public function setItemId($ItemId)
    {
        $this->item_id     = $ItemId;
        return $this;
    }

    /**
     * Get item id
     *
     * @return OsposItems
     */
    public function getItemId()
    {
        return $this->item_id;
    }    
}
