<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposAppConfig
 *
 * @ORM\Table(name="ospos_app_config")
 * @ORM\Entity
 */
class OsposAppConfig
{
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=500, nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=50)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $key;



    /**
     * Set value
     *
     * @param string $value
     *
     * @return OsposAppConfig
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
