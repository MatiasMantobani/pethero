<?php

namespace Models;

use Models\Person as Person;

class Dueno extends Person
{
    //ATRIBUTOS
    private $mascotas;  //deberia ser un array de ids mascotas
    private $reservas; //deberia ser un array
    private $pagos; //deberia ser un array

    //CONSTRUCTOR
    public function __construct($firstName = null, $lastName = null, $dni = null, $adress = null, $telephone = null, $email = null, $password = null, $mascotas = null, $reservas = null, $pagos = null)
    {
        parent::__construct($firstName, $lastName, $dni, $adress, $telephone, $email, $password);   //esto seria el super() de Java
        $this->$mascotas = $mascotas;
        $this->$reservas = $reservas;
        $this->$pagos = $pagos;
        parent::setTipoDeUsuario(1);    //dueno
    }

    //METODOS
    
    //MASCOTAS
    public function getMascotas()
    {
        return $this->mascotas;
    }
    public function setMascotas($mascotas): self
    {
        $this->mascotas = $mascotas;
        return $this;
    }

    //RESERVAS
    public function getReservas()
    {
        return $this->reservas;
    }
    public function setReservas($reservas): self
    {
        $this->reservas = $reservas;
        return $this;
    }

    //PAGOS
    public function getPagos()
    {
        return $this->pagos;
    }
    public function setPagos($pagos): self
    {
        $this->pagos = $pagos;
        return $this;
    }
}
