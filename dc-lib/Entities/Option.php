<?php

namespace Entities;

/** @Entity @Table(name="dc_options") */
class Option
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @Column(type="string", length=255, nullable=true) */
    protected $option_key;

    /** @Column(type="text", nullable=true) */
    protected $option_value;


    /** Class Constructor
     * --------------------------------------*/

    public function __construct($key, $value)
    {
        $this->option_key    = $key;
        $this->option_value  = $value;
    }

    /** Getters and Setters
     * --------------------------------------*/

    /* ID */
    public function getOptionId()
    {
        return $this->id;
    }

    /* Key */
    public function getOptionKey()
    {
        return $this->option_key;
    }

    public function setOptionKey($key)
    {
        $this->option_key = $key;
    }

    /* Value */
    public function getOptionValue()
    {
        return $this->option_value;
    }

    public function setOptionValue($value)
    {
        $this->option_value = $value;
    }

    /** Class Methods
     * --------------------------------------*/

}