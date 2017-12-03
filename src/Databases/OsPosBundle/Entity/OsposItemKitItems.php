<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposItemKitItems
 *
 * @ORM\Table(name="ospos_item_kit_items", indexes={@ORM\Index(name="ospos_item_kit_items_ibfk_2", columns={"item_id"}), @ORM\Index(name="IDX_3F5F63C3BC771520", columns={"item_kit_id"})})
 * @ORM\Entity
 */
class OsposItemKitItems
{
    /**
     * @var integer
     *
     * @ORM\Column(name="kit_sequence", type="integer", nullable=false)
     */
    private $kitSequence = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="decimal")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $quantity;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposItemKits
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposItemKits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_kit_id", referencedColumnName="item_kit_id")
     * })
     */
    private $itemKit;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposItems
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Databases\OsPosBundle\Entity\OsposItems")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="item_id")
     * })
     */
    private $item;



    /**
     * Set kitSequence
     *
     * @param integer $kitSequence
     *
     * @return OsposItemKitItems
     */
    public function setKitSequence($kitSequence)
    {
        $this->kitSequence = $kitSequence;

        return $this;
    }

    /**
     * Get kitSequence
     *
     * @return integer
     */
    public function getKitSequence()
    {
        return $this->kitSequence;
    }

    /**
     * Set quantity
     *
     * @param string $quantity
     *
     * @return OsposItemKitItems
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set itemKit
     *
     * @param \Databases\OsPosBundle\Entity\OsposItemKits $itemKit
     *
     * @return OsposItemKitItems
     */
    public function setItemKit(\Databases\OsPosBundle\Entity\OsposItemKits $itemKit)
    {
        $this->itemKit = $itemKit;

        return $this;
    }

    /**
     * Get itemKit
     *
     * @return \Databases\OsPosBundle\Entity\OsposItemKits
     */
    public function getItemKit()
    {
        return $this->itemKit;
    }

    /**
     * Set item
     *
     * @param \Databases\OsPosBundle\Entity\OsposItems $item
     *
     * @return OsposItemKitItems
     */
    public function setItem(\Databases\OsPosBundle\Entity\OsposItems $item)
    {
        $this->item = $item;

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
}
