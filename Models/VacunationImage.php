<?php
namespace Models;

class VacunationImage
{
    private $imageid;
    private $name;
    private $petid;

    /**
     * @return mixed
     */
    public function getImageid()
    {
        return $this->imageid;
    }

    /**
     * @param mixed $imageid
     */
    public function setImageid($imageid)
    {
        $this->imageid = $imageid;
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



}
?>