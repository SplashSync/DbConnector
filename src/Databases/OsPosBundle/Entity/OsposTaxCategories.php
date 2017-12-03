<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposTaxCategories
 *
 * @ORM\Table(name="ospos_tax_categories")
 * @ORM\Entity
 */
class OsposTaxCategories
{
    /**
     * @var string
     *
     * @ORM\Column(name="tax_category", type="string", length=32, nullable=false)
     */
    private $taxCategory;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tax_group_sequence", type="boolean", nullable=false)
     */
    private $taxGroupSequence;

    /**
     * @var integer
     *
     * @ORM\Column(name="tax_category_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $taxCategoryId;



    /**
     * Set taxCategory
     *
     * @param string $taxCategory
     *
     * @return OsposTaxCategories
     */
    public function setTaxCategory($taxCategory)
    {
        $this->taxCategory = $taxCategory;

        return $this;
    }

    /**
     * Get taxCategory
     *
     * @return string
     */
    public function getTaxCategory()
    {
        return $this->taxCategory;
    }

    /**
     * Set taxGroupSequence
     *
     * @param boolean $taxGroupSequence
     *
     * @return OsposTaxCategories
     */
    public function setTaxGroupSequence($taxGroupSequence)
    {
        $this->taxGroupSequence = $taxGroupSequence;

        return $this;
    }

    /**
     * Get taxGroupSequence
     *
     * @return boolean
     */
    public function getTaxGroupSequence()
    {
        return $this->taxGroupSequence;
    }

    /**
     * Get taxCategoryId
     *
     * @return integer
     */
    public function getTaxCategoryId()
    {
        return $this->taxCategoryId;
    }
}
