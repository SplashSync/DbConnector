<?php

namespace Databases\OsPosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsposGiftcards
 *
 * @ORM\Table(name="ospos_giftcards", uniqueConstraints={@ORM\UniqueConstraint(name="giftcard_number", columns={"giftcard_number"})}, indexes={@ORM\Index(name="person_id", columns={"person_id"})})
 * @ORM\Entity
 */
class OsposGiftcards
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="record_time", type="datetime", nullable=false)
     */
    private $recordTime = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="giftcard_number", type="string", length=255, nullable=true)
     */
    private $giftcardNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="giftcard_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $giftcardId;

    /**
     * @var \Databases\OsPosBundle\Entity\OsposPeople
     *
     * @ORM\ManyToOne(targetEntity="Databases\OsPosBundle\Entity\OsposPeople")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="person_id")
     * })
     */
    private $person;



    /**
     * Set recordTime
     *
     * @param \DateTime $recordTime
     *
     * @return OsposGiftcards
     */
    public function setRecordTime($recordTime)
    {
        $this->recordTime = $recordTime;

        return $this;
    }

    /**
     * Get recordTime
     *
     * @return \DateTime
     */
    public function getRecordTime()
    {
        return $this->recordTime;
    }

    /**
     * Set giftcardNumber
     *
     * @param string $giftcardNumber
     *
     * @return OsposGiftcards
     */
    public function setGiftcardNumber($giftcardNumber)
    {
        $this->giftcardNumber = $giftcardNumber;

        return $this;
    }

    /**
     * Get giftcardNumber
     *
     * @return string
     */
    public function getGiftcardNumber()
    {
        return $this->giftcardNumber;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return OsposGiftcards
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
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return OsposGiftcards
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Get giftcardId
     *
     * @return integer
     */
    public function getGiftcardId()
    {
        return $this->giftcardId;
    }

    /**
     * Set person
     *
     * @param \Databases\OsPosBundle\Entity\OsposPeople $person
     *
     * @return OsposGiftcards
     */
    public function setPerson(\Databases\OsPosBundle\Entity\OsposPeople $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Databases\OsPosBundle\Entity\OsposPeople
     */
    public function getPerson()
    {
        return $this->person;
    }
}
