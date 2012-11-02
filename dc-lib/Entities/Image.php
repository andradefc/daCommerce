<?php

namespace Entities;

/** @Entity @Table(name="dc_images") */
class Image
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @Column(type="datetime") */
    protected $image_date;

    /** @Column(type="string", length=255, nullable=true) */
    protected $image_url;


    /** Class Constructor
     * --------------------------------------*/

    public function __construct($url)
    {
        $this->image_url  = $url;
    }

    /** Getters and Setters
     * --------------------------------------*/

    /* ID */
    public function getImageId()
    {
        return $this->id;
    }

    /* Date */
    public function getImageDate()
    {
        return $this->image_date;
    }

    /* URL */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    public function setImageUrl($url)
    {
        $this->image_url = $url;
    }

    /** Class Methods
     * --------------------------------------*/

}