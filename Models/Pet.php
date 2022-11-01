<?php
namespace Models;

class Pet
{
    private $petid;
    private $userid;
    private $status;
    private $breedid;
    private $name;
    private $observations;

    /**
     * @return mixed
     */
    public function getPetid()
    {
        return $this->petid;
    }

    /**
     * @param mixed $petid
     */
    public function setPetid($petid)
    {
        $this->petid = $petid;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getBreedid()
    {
        return $this->breedid;
    }

    /**
     * @param mixed $breedid
     */
    public function setBreedid($breedid)
    {
        $this->breedid = $breedid;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * @param mixed $observations
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;
    }



}