<?php

namespace Entities;

/** @Entity @Table(name="dc_order_products") */
class OrderProduct
{

    /** @Id @ManyToOne(targetEntity="Order") */
    protected $order;

    /** @Id @ManyToOne(targetEntity="Product") */
    protected $product;

    /** @Column(type="integer") */
    protected $product_amount = 1;

    /** @Column(type="decimal") */
    protected $product_price;


    /** Class Constructor
     * --------------------------------------*/

    public function __construct(Order $order, Product $product, $amount = 1)
    {
        $this->order          = $order;
        $this->product        = $product;
        $this->product_amount = $amount;
        $this->product_price  = $product->getProductPrice();
    }

    /** Getters and Setters
     * --------------------------------------*/

    /* Order */
    public function getOrderId() {
        return $this->order_id;
    }


    /* Product */
    public function getProductId() {
        return $this->product_id;
    }


    /* Amount */
    public function getProductAmount() {
        return $this->product_amount;
    }


    /* Price */
    public function getProductPrice() {
        return $this->product_price;
    }

    public function setProductPrice($price) {
        $this->product_price = $price;
    }

    /** Class Methods
     * --------------------------------------*/

    public function setProductAmount($amount = 1, $type = 'add') {
        if ($type == 'add'){
            $this->product_amount += $amount;
        }elseif ($type == 'remove'){
            $this->product_amount -= $amount;
        }else{
            $this->product_amount =  $amount;
        }
    }



}