<?php

namespace Tests\Randomuser\Domain\Entity;

use Tests\Randomuser\Domain\ValueObject\Email;
use DateTime;

/**
 * Class User
 * @package Tests\Randomuser\Domain\Entity
 */
class User
{

    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $gender
     */
    private $gender;

    /**
     * @var string $name_title
     */
    private $name_title;

    /**
     * @var string $name_first
     */
    private $name_first;

    /**
     * @var string $name_last
     */
    private $name_last;

    /**
     * @var string $location_street
     */
    private $location_street;

    /**
     * @var string $location_city
     */
    private $location_city;

    /**
     * @var string $location_state
     */
    private $location_state;

    /**
     * @var string $location_postcode
     */
    private $location_postcode;

    /**
     * @var Email $email
     */
    private $email;

    /**
     * @var string $login_username
     */
    private $login_username;

    /**
     * @var string $login_password
     */
    private $login_password;

    /**
     * @var string $login_salt
     */
    private $login_salt;

    /**
     * @var DateTime $dob
     */
    private $dob;

    /**
     * @var DateTime $registered
     */
    private $registered;

    /**
     * @var string $nat
     */
    private $nat;

    /**
     * @var string $picture_large
     */
    private $picture_large;

    /**
     * @var string $picture_medium
     */
    private $picture_medium;

    /**
     * @var string $picture_thumbnail
     */
    private $picture_thumbnail;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getNameTitle()
    {
        return $this->name_title;
    }

    /**
     * @param string $name_title
     */
    public function setNameTitle($name_title)
    {
        $this->name_title = $name_title;
    }

    /**
     * @return string
     */
    public function getNameFirst()
    {
        return $this->name_first;
    }

    /**
     * @param string $name_first
     */
    public function setNameFirst($name_first)
    {
        $this->name_first = $name_first;
    }

    /**
     * @return string
     */
    public function getNameLast()
    {
        return $this->name_last;
    }

    /**
     * @param string $name_last
     */
    public function setNameLast($name_last)
    {
        $this->name_last = $name_last;
    }

    /**
     * @return string
     */
    public function getLocationStreet()
    {
        return $this->location_street;
    }

    /**
     * @param string $location_street
     */
    public function setLocationStreet($location_street)
    {
        $this->location_street = $location_street;
    }

    /**
     * @return string
     */
    public function getLocationCity()
    {
        return $this->location_city;
    }

    /**
     * @param string $location_city
     */
    public function setLocationCity($location_city)
    {
        $this->location_city = $location_city;
    }

    /**
     * @return string
     */
    public function getLocationState()
    {
        return $this->location_state;
    }

    /**
     * @param string $location_state
     */
    public function setLocationState($location_state)
    {
        $this->location_state = $location_state;
    }

    /**
     * @return string
     */
    public function getLocationPostcode()
    {
        return $this->location_postcode;
    }

    /**
     * @param string $location_postcode
     */
    public function setLocationPostcode($location_postcode)
    {
        $this->location_postcode = $location_postcode;
    }

    /**
     * @return Email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLoginUsername()
    {
        return $this->login_username;
    }

    /**
     * @param string $login_username
     */
    public function setLoginUsername($login_username)
    {
        $this->login_username = $login_username;
    }

    /**
     * @return string
     */
    public function getLoginPassword()
    {
        return $this->login_password;
    }

    /**
     * @param string $login_password
     */
    public function setLoginPassword($login_password)
    {
        $this->login_password = $login_password;
    }

    /**
     * @return string
     */
    public function getLoginSalt()
    {
        return $this->login_salt;
    }

    /**
     * @param string $login_salt
     */
    public function setLoginSalt($login_salt)
    {
        $this->login_salt = $login_salt;
    }

    /**
     * @return DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param DateTime $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    /**
     * @return DateTime
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * @param DateTime $registered
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;
    }

    /**
     * @return string
     */
    public function getNat()
    {
        return $this->nat;
    }

    /**
     * @param string $nat
     */
    public function setNat($nat)
    {
        $this->nat = $nat;
    }

    /**
     * @return string
     */
    public function getPictureLarge()
    {
        return $this->picture_large;
    }

    /**
     * @param string $picture_large
     */
    public function setPictureLarge($picture_large)
    {
        $this->picture_large = $picture_large;
    }

    /**
     * @return string
     */
    public function getPictureMedium()
    {
        return $this->picture_medium;
    }

    /**
     * @param string $picture_medium
     */
    public function setPictureMedium($picture_medium)
    {
        $this->picture_medium = $picture_medium;
    }

    /**
     * @return string
     */
    public function getPictureThumbnail()
    {
        return $this->picture_thumbnail;
    }

    /**
     * @param string $picture_thumbnail
     */
    public function setPictureThumbnail($picture_thumbnail)
    {
        $this->picture_thumbnail = $picture_thumbnail;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        $res=[];
        if($this->id>0)
            $res['id']=$this->id;
        if(strlen($this->gender)>0)
            $res['gender']=$this->gender;
        if(strlen($this->name_title)>0)
            $res['name_title']=$this->name_title;
        if(strlen($this->name_first)>0)
            $res['name_first']=$this->name_first;
        if(strlen($this->name_last)>0)
            $res['name_last']=$this->name_last;
        if(strlen($this->location_street)>0)
            $res['location_street']=$this->location_street;
        if(strlen($this->location_city)>0)
            $res['location_city']=$this->location_city;
        if(strlen($this->location_state)>0)
            $res['location_state']=$this->location_state;
        if(strlen($this->location_postcode)>0)
            $res['location_postcode']=$this->location_postcode;
        if($this->email)
            $res['email']=(string)$this->email;
        if(strlen($this->login_username)>0)
            $res['login_username']=$this->login_username;
        if(strlen($this->login_password)>0)
            $res['login_password']=$this->login_password;
        if(strlen($this->login_salt)>0)
            $res['login_salt']=$this->login_salt;
        if($this->dob)
            $res['dob']=$this->dob;
        if($this->registered)
            $res['registered']=$this->registered;
        if(strlen($this->nat)>0)
            $res['nat']=$this->nat;
        if(strlen($this->picture_large)>0)
            $res['picture_large']=$this->picture_large;
        if(strlen($this->picture_medium)>0)
            $res['picture_medium']=$this->picture_medium;
        if(strlen($this->picture_thumbnail)>0)
            $res['picture_thumbnail']=$this->picture_thumbnail;
        return $res;
    }

}