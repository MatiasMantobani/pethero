<?php

namespace Models;

class Mascota
{
    //ATRIBUTOS
    private $idDueno;   //implementar
    private $idMascota;   //implementar
    private $petName;
    private $foto;           //img
    private $carnetVacunas; //img
    private $observaciones;
    private $raza;
    private $tamano;    //array S, M, L
    private $video; // implementar como c*rajo implemento esto!? (╯°□°）╯︵ ┻━┻

    //CONSTRUCTOR
    public function __construct($petName=null, $foto=null, $carnetVacunas=null, $observaciones=null, $raza=null, $tamano=null, $video=null)
    {
        $this->$petName = $petName;
        $this->$foto = $foto;
        $this->$carnetVacunas = $carnetVacunas;
        $this->$observaciones = $observaciones;
        $this->$raza = $raza;
        $this->$tamano = $tamano;
        $this->$video = $video;
    }

    //METODOS

    //NOMBRE
    public function getPetName()
    {
        return $this->petName;
    }

    /**
     * Set the value of petName
     */
    public function setPetName($petName): self
    {
        $this->petName = $petName;

        return $this;
    }

    /**
     * Get the value of foto
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     */
    public function setFoto($foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of carnetVacunas
     */
    public function getCarnetVacunas()
    {
        return $this->carnetVacunas;
    }

    /**
     * Set the value of carnetVacunas
     */
    public function setCarnetVacunas($carnetVacunas): self
    {
        $this->carnetVacunas = $carnetVacunas;

        return $this;
    }

    /**
     * Get the value of observaciones
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set the value of observaciones
     */
    public function setObservaciones($observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get the value of raza
     */
    public function getRaza()
    {
        return $this->raza;
    }

    /**
     * Set the value of raza
     */
    public function setRaza($raza): self
    {
        $this->raza = $raza;

        return $this;
    }

    /**
     * Get the value of tamano
     */
    public function getTamano()
    {
        return $this->tamano;
    }

    /**
     * Set the value of tamano
     */
    public function setTamano($tamano): self
    {
        $this->tamano = $tamano;

        return $this;
    }

    /**
     * Get the value of video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set the value of video
     */
    public function setVideo($video): self
    {
        $this->video = $video;

        return $this;
    }
}
