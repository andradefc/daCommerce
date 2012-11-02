<?php

namespace Entities;

/** @Entity @Table(name="dc_products") */
class Product
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @Column(type="datetime") */
    protected $product_date;

    /** @Column(type="string", length=255, nullable=true) */
    protected $product_name;

    /** @Column(type="text", nullable=true) */
    protected $product_description;

    /** @Column(type="decimal", nullable=true) */
    protected $product_price;

    /** @Column(type="decimal", nullable=true) */
    protected $product_fromprice;

    /** @Column(type="integer", nullable=true) */
    protected $product_count;

    /** @ManyToOne(targetEntity="Image") */
    protected $product_thumbnail;

    /** @Column(type="integer", nullable=true, length=1) */
    protected $product_status;

    /**
     * @ManyToMany(targetEntity="Image")
     * @JoinTable(name="dc_product_images",
     *      joinColumns={@JoinColumn(name="product_id",
     *          referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id",
     *          referencedColumnName="id")}
     *      )
     */
    protected $product_images;

    /**
     * @OneToMany(targetEntity="Rule", mappedBy="product_id")
     */
    protected $product_rules;

    /** Class Constructor
     * --------------------------------------*/

    public function __construct($name, $description, $price, $fromprice = 0, Image $thumbnail)
    {
        $this->product_name        = $name;
        $this->product_description = $description;
        $this->product_price       = $price;
        $this->product_fromprice   = $fromprice;
        $this->product_count       = 0;
        $this->product_thumbnail   = $thumbnail;
        $this->product_status      = 1;
        $this->product_images      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->product_rules       = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /** Getters and Setters
     * --------------------------------------*/

    /* ID */
    public function getProductId()
    {
        return $this->id;
    }


    /* Date */
    public function getProductDate()
    {
        return $this->product_date;
    }


    /* Name */
    public function getProductName()
    {
        return $this->product_name;
    }

    public function setProductName($name)
    {
        $this->product_name = $name;
    }


    /* Description */
    public function getProductDescription()
    {
        return $this->product_description;
    }

    public function setProductDescription($description)
    {
        $this->product_description = $description;
    }


    /* Price */
    public function getProductPrice()
    {
        return $this->product_price;
    }

    public function setProductPrice($price)
    {
        $this->product_price = $price;
    }


    /* Fromprice */
    public function getProductFromPrice()
    {
        return $this->product_fromprice;
    }

    public function setProductFromPrice($fromprice)
    {
        $this->product_fromprice = $fromprice;
    }


    /* Count */
    public function getProductCount()
    {
        return $this->product_count;
    }

    public function setProductCount($count)
    {
        $this->product_count = $count;
    }


    /* Thumbnail */
    public function getProductThumbnail()
    {
        return $this->product_thumbnail;
    }

    public function setProductThumbnail(Image $thumbnail)
    {
        $this->product_thumbnail = $thumbnail;
    }


    /* Status */
    public function getProductStatus()
    {
        return $this->product_status;
    }

    public function setProductStatus($status)
    {
        $this->product_status = $status;
    }

    /* Images */
    public function getProductImages()
    {
        return $this->product_images;
    }

    /* Rules */
    public function getProductRules()
    {
        return $this->product_rules;
    }

    /** Class Methos
     * --------------------------------------*/

    public function addProductImage(Image $image)
    {
        $this->product_images->add($image);
    }

    public function addProductrule(Rule $rule)
    {
        $this->product_rules->add($rule);
    }

    public function getProductConvertedDate($format = 'd/m/Y H:i:s')
    {
        return $this->getProductDate()->format($format);
    }

    public function getProductStatusRole()
    {
        switch ($this->getProductStatus()) {
            case 1:
                return 'Ativo';
                break;

            default:
                return 'Lixeira';
                break;
        }
    }

}