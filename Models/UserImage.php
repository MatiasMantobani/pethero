<?php
namespace Models;

class UserImage
{
    private $imageid;
    private $name;
    private $userid;

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






}
?>