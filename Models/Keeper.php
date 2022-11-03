<?php
namespace Models;

class Keeper
{
    private $keeperid;
    private $pricing;
    private $rating;
    private $userid;

    /**
     * @return mixed
     */
    public function getPricing()
    {
        return $this->pricing;
    }

    /**
     * @param mixed $pricing
     */
    public function setPricing($pricing)
    {
        $this->pricing = $pricing;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }




    /**
     * Get the value of keeperid
     */ 
    public function getKeeperid()
    {
        return $this->keeperid;
    }

    /**
     * Set the value of keeperid
     *
     * @return  self
     */ 
    public function setKeeperid($keeperid)
    {
        $this->keeperid = $keeperid;

        return $this;
    }

    /**
     * Get the value of userid
     */ 
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     *
     * @return  self
     */ 
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }
}