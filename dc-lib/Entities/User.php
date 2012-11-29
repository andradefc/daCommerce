<?php

namespace Entities;

/** @Entity @Table(name="dc_users") */
class User
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @Column(type="datetime") */
    protected $user_date;

    /** @Column(type="string", length=255, nullable=true) */
    protected $user_name;

    /** @Column(type="string", length=255, unique=true) */
    protected $user_email;

    /** @Column(type="string", length=255, nullable=true) */
    protected $user_pass;

    /** @Column(type="string", length=255, nullable=true) */
    protected $user_company;

    /** @Column(type="integer", length=1) */
    protected $user_access;

    /** @Column(type="integer", length=1) */
    protected $user_status;

    /**
     * @OneToMany(targetEntity="Order", mappedBy="user")
     **/
    protected $user_orders;

    /**
     * @OneToMany(targetEntity="Product", mappedBy="user")
     **/
    protected $user_products;



    /** Class Constructor
     * --------------------------------------*/

    public function __construct($name, $email, $pass, $access, $company = "")
    {
        $this->user_name     = $name;
        $this->user_email    = $email;
        $this->user_pass     = $pass;
        $this->user_company  = $company;
        $this->user_access   = $access;
        $this->user_status   = 1;
        $this->user_orders   = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user_products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /** Getters and Settters
     * --------------------------------------*/

    /* ID */
    public function getUserId()
    {
        return $this->id;
    }


    /* Date */
    public function getUserDate()
    {
        return $this->user_date;
    }


    /* Name */
    public function getUserName()
    {
        return $this->user_name;
    }

    public function setUserName($name)
    {
        $this->user_name = $name;
    }


    /* Email */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    public function setUserEmail($email)
    {
        $this->user_email = $email;
    }


    /* Password */
    public function getUserPass()
    {
        return $this->user_pass;
    }

    public function setUserPass($pass)
    {
        $this->user_pass = $pass;
    }


    /* Company */
    public function getUserCompany()
    {
        return $this->user_company;
    }

    public function setUserCompany($company)
    {
        $this->user_company = $company;
    }


    /* Status */
    public function getUserStatus()
    {
        return $this->user_status;
    }

    public function setUserStatus($status)
    {
        $this->user_status = $status;
    }

    /* Access */
    public function getUserAccess()
    {
        return $this->user_access;
    }

    public function setUserAccess($access)
    {
        $this->user_access = $access;
    }

    /* Orders */
    public function getUserOrders()
    {
        return $this->user_orders;
    }

    /* Products */
    public function getUserProducts()
    {
        return $this->user_products;
    }

    /** Class Methods
     * --------------------------------------*/

    public function addUserOrder(Order $order)
    {
        $this->getUserOrders()->add($order);
    }

    public function getUserAccessRole()
    {
        switch ($this->getUserAccess()) {
            case 0:
                return 'Administrador';
                break;
            case 1:
                return 'Assinante';
                break;
            case 2:
                return 'Comprador';
                break;

            default:
                return 'Visitante';
                break;
        }
    }

    public function getUserConvertedDate($format = 'd/m/Y H:i:s')
    {
        return $this->getUserDate()->format($format);
    }

    public function getUserStatusRole()
    {
        switch ($this->getUserStatus()) {
            case 1:
                return 'Ativo';
                break;

            default:
                return 'Lixeira';
                break;
        }
    }

}