<?php
namespace Models;

class Breed
{
    private $breedid;
    private $name;
    private $size;
    private $type;

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
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }



}