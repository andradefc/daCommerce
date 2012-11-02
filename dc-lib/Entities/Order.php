<?php

namespace Entities;

/** @Entity @Table(name="dc_orders") */
class Order
{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ManyToOne(targetEntity="User") */
    protected $user;

    /** @Column(type="datetime") */
    protected $order_date;

    /** @Column(type="integer", length=1) */
    protected $order_payment_type;

    /** @Column(type="decimal", nullable=true) */
    protected $order_totalprice;

    /** @Column(type="integer") */
    protected $order_status;

    /** @OneToMany(targetEntity="OrderProduct", mappedBy="order",
     *  cascade={"persist"})
     */
    protected $order_products;


    /** Class Constructor
     * --------------------------------------*/

    public function __construct(User $user, $payment_type)
    {
        $this->user                = $user;
        $this->order_payment_type  = $payment_type;
        $this->order_status        = 1;
        $this->order_products      = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /** Getters and Setters
     * --------------------------------------*/

    /* ID */
    public function getOrderId()
    {
        return $this->id;
    }

    /* User */
    public function getOrderUser()
    {
        return $this->order_user;
    }

    public function setOrderUser($user)
    {
        $this->order_user = $user;
    }

    /* Date */
    public function getOrderDate()
    {
        return $this->order_date;
    }

    /* Url */
    public function getOrderUrl()
    {
        return $this->order_date;
    }

    public function setOrderUrl($url)
    {
        $this->order_url = $url;
    }

    /* Products */
    public function getOrderProducts()
    {
        return $this->order_products;
    }

    /** Class Methods
     * --------------------------------------*/

    public function addOrderProduct(Product $product, $amount = 1)
    {
        $this->order_products->add(new \Entities\OrderProduct($this, $product,
            $amount));
    }

}