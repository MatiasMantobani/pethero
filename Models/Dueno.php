<?php
namespace Models;

use Models\Person as Person;

class Dueno extends Person
{
    private $mascotas;  //deberia ser un array
    private $reservas; //deberia ser un array
    private $pagos; //deberia ser un array
    
    public function __construct($firstName, $lastName, $dni, $adress, $telephone, $email, $password,$mascotas,$reservas,$pagos )
    {
        parent::__construct($firstName, $lastName, $dni,$adress,$telephone,$email,$password);   //esto seria el super() de Java
        $this->$mascotas=$mascotas;
        $this->$reservas=$reservas;
        $this->$pagos=$pagos;
    }

    /**
     * Get the value of mascotas
     */
    public function getMascotas()
    {
        return $this->mascotas;
    }

    /**
     * Set the value of mascotas
     */
    public function setMascotas($mascotas): self
    {
        $this->mascotas = $mascotas;

        return $this;
    }

    /**
     * Get the value of reservas
     */
    public function getReservas()
    {
        return $this->reservas;
    }

    /**
     * Set the value of reservas
     */
    public function setReservas($reservas): self
    {
        $this->reservas = $reservas;

        return $this;
    }

    /**
     * Get the value of pagos
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    /**
     * Set the value of pagos
     */
    public function setPagos($pagos): self
    {
        $this->pagos = $pagos;

        return $this;
    }
}

?>