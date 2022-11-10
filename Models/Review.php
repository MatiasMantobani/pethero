<?php

namespace Models;

class Review
{
    private $reviewid;
    private $emitterid;
    private $receptorid;
    private $reserveid;
    private $rating;
    private $comment;

    /**
     * Get the value of reviewid
     */
    public function getReviewid()
    {
        return $this->reviewid;
    }

    /**
     * Set the value of reviewid
     */
    public function setReviewid($reviewid): self
    {
        $this->reviewid = $reviewid;

        return $this;
    }

    /**
     * Get the value of emitterid
     */
    public function getEmitterid()
    {
        return $this->emitterid;
    }

    /**
     * Set the value of emitterid
     */
    public function setEmitterid($emitterid): self
    {
        $this->emitterid = $emitterid;

        return $this;
    }

    /**
     * Get the value of receptorid
     */
    public function getReceptorid()
    {
        return $this->receptorid;
    }

    /**
     * Set the value of receptorid
     */
    public function setReceptorid($receptorid): self
    {
        $this->receptorid = $receptorid;

        return $this;
    }

    /**
     * Get the value of reserveid
     */
    public function getReserveid()
    {
        return $this->reserveid;
    }

    /**
     * Set the value of reserveid
     */
    public function setReserveid($reserveid): self
    {
        $this->reserveid = $reserveid;

        return $this;
    }

    /**
     * Get the value of rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     */
    public function setRating($rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */
    public function setComment($comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}

?>