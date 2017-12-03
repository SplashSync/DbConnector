<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposModules
 *
 * @ORM\Table(name="ospos_modules", uniqueConstraints={@ORM\UniqueConstraint(name="desc_lang_key", columns={"desc_lang_key"}), @ORM\UniqueConstraint(name="name_lang_key", columns={"name_lang_key"})})
 * @ORM\Entity
 */
class OsposModules
{
    /**
     * @var string
     *
     * @ORM\Column(name="name_lang_key", type="string", length=255, nullable=false)
     */
    private $nameLangKey;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_lang_key", type="string", length=255, nullable=false)
     */
    private $descLangKey;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer", nullable=false)
     */
    private $sort;

    /**
     * @var string
     *
     * @ORM\Column(name="module_id", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $moduleId;



    /**
     * Set nameLangKey
     *
     * @param string $nameLangKey
     *
     * @return OsposModules
     */
    public function setNameLangKey($nameLangKey)
    {
        $this->nameLangKey = $nameLangKey;

        return $this;
    }

    /**
     * Get nameLangKey
     *
     * @return string
     */
    public function getNameLangKey()
    {
        return $this->nameLangKey;
    }

    /**
     * Set descLangKey
     *
     * @param string $descLangKey
     *
     * @return OsposModules
     */
    public function setDescLangKey($descLangKey)
    {
        $this->descLangKey = $descLangKey;

        return $this;
    }

    /**
     * Get descLangKey
     *
     * @return string
     */
    public function getDescLangKey()
    {
        return $this->descLangKey;
    }

    /**
     * Set sort
     *
     * @param integer $sort
     *
     * @return OsposModules
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Get moduleId
     *
     * @return string
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }
}
