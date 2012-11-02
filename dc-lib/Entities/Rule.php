<?php

namespace Entities;

/** @Entity @Table(name="dc_rules") */
class Rule
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Product", inversedBy="product_rules")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product_id;

    /** @Column(type="string", length=255, nullable=true) */
    protected $rule_key;

    /** @Column(type="string", length=255, nullable=true) */
    protected $rule_value;


    /** Class Constructor
     * --------------------------------------*/

    public function __construct($product, $key, $value)
    {
        $this->product_id = $product;
        $this->rule_key   = $key;
        $this->rule_value = $value;
    }

    /** Getters and Setters
     * --------------------------------------*/

    /* ID */
    public function getRuleId()
    {
        return $this->id;
    }


    /* Product */
    public function getRuleProduct()
    {
        return $this->product_id;
    }

    public function setRuleProduct($product)
    {
        $this->product_id = $product;
    }


    /* Key */
    public function getRuleKey()
    {
        return $this->rule_key;
    }

    public function setRuleKey($key)
    {
        $this->rule_key = $key;
    }


    /* Value */
    public function getRuleValue()
    {
        return $this->rule_value;
    }

    public function setRuleValue($value)
    {
        $this->rule_value = $key;
    }

    /** Class Methods
     * --------------------------------------*/

}