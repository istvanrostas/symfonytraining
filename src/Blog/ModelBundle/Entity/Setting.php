<?php

namespace Blog\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Setting
 *
 * @ORM\Table(name="setting")
 * @ORM\Entity(repositoryClass="Blog\ModelBundle\Repository\SettingRepository")
 */
class Setting
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
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=30, unique=true)
     */
    private $key;

    /**
     * @var bool
     *
     * @ORM\Column(name="value", type="boolean")
     */
    private $value;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return boolean
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param boolean $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


}

