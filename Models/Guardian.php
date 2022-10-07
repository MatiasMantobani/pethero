<?php

namespace Models;

use Models\Person as Person;

class Guardian extends Person
{
    //ATRIBUTOS
    private $cuil; // int
    private $remuneracion; // float
    private $reputacion; // del 1 al 5, empieza vacio y se va actualizando a medida que cumpla con sus trabajos
    private $tamanoDeMascota; // small, medium, large
    private $disponibilidad; // Date?
    private $reservas; // arreglo apenas se registra esta vacio
    private $reviews; // arreglo apenas se registra esta vacio


    //CONSTRUCTOR
    public function __construct($firstName = null, $lastName = null, $dni = null, $adress = null, $telephone = null, $email = null, $password = null, $cuil = null, $remuneracion = null, $tamanoDeMascota = null, $disponibilidad = null)
    {
        parent::__construct($firstName, $lastName, $dni, $adress, $telephone, $email, $password);   //esto seria el super() de Java
        $this->cuil = $cuil;
        $this->remuneracion = $remuneracion;
        $this->tamanoDeMascota = $tamanoDeMascota;
        $this->disponibilidad = $disponibilidad;
        parent::setTipoDeUsuario(2);    //guardian
    }

    //METODOS

    //CUIL
    public function getCuil()
    {
        return $this->cuil;
    }
    public function setCuil($cuil)
    {
        $this->cuil = $cuil;
    }

    //REMUNERACION
    public function getRemuneracion()
    {
        return $this->remuneracion;
    }
    public function setRemuneracion($remuneracion)
    {
        $this->remuneracion = $remuneracion;
    }

    //REPUTACION
    public function getReputacion()
    {
        return $this->reputacion;
    }
    public function setReputacion($reputacion)
    {
        $this->reputacion = $reputacion;
    }

    //TAMAÑO MASCOTA
    public function getTamanoDeMascota()
    {
        return $this->tamanoDeMascota;
    }
    public function setTamanoDeMascota($tamanoDeMascota)
    {
        $this->tamanoDeMascota = $tamanoDeMascota;
    }

    //DISPONIBILIDAD
    public function getDisponibilidad()
    {
        return $this->disponibilidad;
    }
    public function setDisponibilidad($disponibilidad)
    {
        $this->disponibilidad = $disponibilidad;
    }

    //RESERVAS
    public function getReservas()
    {
        return $this->reservas;
    }
    public function setReservas($reservas)
    {
        $this->reservas = $reservas;
    }

    //REVIEWS
    public function getReviews()
    {
        return $this->reviews;
    }
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }
}
