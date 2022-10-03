<?php
namespace Models;

class Mascota
{
   //Nombre
	//Dueño(Clase)
	//Foto (img)
	//Carnet de vacunacion (img)
	//Observaciones
	//Raza
	//Tamaño
	//Video opcional

    private $idDueno;   //implementar
    private $petName;
    private $foto; //Esto va a tener que ser una imagen, no se como ahora
    private $carnetVacunas; //Esto también tiene que ser una imagen
    private $observaciones; //Comentario sobre la mascota
    private $raza;
    private $tamano;    //char S, M, L
    private $video; //como c*rajo implemento esto!? (╯°□°）╯︵ ┻━┻
    //id para cuando haya base de datos
    
    public function __construct($petName, $foto, $carnetVacunas, $observaciones, $raza, $tamano, $video)
    {
        $this->$petName=$petName;
        $this->$foto=$foto;
        $this->$carnetVacunas=$carnetVacunas;
        $this->$observaciones=$observaciones;
        $this->$raza=$raza;
        $this->$tamano=$tamano;
        $this->$video=$video;

    }

    /**
     * Get the value of petName
     */
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
?>