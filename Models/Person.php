<?php

namespace Models;

abstract class Person
{
    protected $firstName;
    protected $lastName;
    protected $dni;
    protected $adress;
    protected $telephone;
    protected $email;
    protected $password;
    // protected $id2 = 0;
    // public static $ID = 0;
    // protected $fotoOpcional;



    protected function __construct($firstName, $lastName, $dni, $adress, $telephone, $email, $password)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dni = $dni;
        $this->adress = $adress;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->password = $password;

        // $this->incrementarAtributoEstatico();
        // $this->getIDAuto();
    }

    // public function incrementarAtributoEstatico()    //Podria no ser static pero habra limitaciones
    // {
    //     Person::$ID++;  //con el nombre de la clase
    //     echo "Guardian de clase".Person::$ID;   //debug
    //     echo "<br>";    //debug
    // }

    // // // ID statico NO
    // public function getIDAuto()
    // {
    //     $this->id2 = self::$ID;
    //     echo "guardian de instancia". $this->id2;   //debug
    //     echo "<br>";    //debug
    // }

    // // ID de isntancia
    // public function getID()
    // {
    //     return $this->id2;
    // }

    // public function setID($id2)
    // {
    //     $this->id2 = $id2;
    // }

    // public function setID()
    // {
    //     return self::$ID;
    // }



    //NOMBRE      
    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }


    // APELLIDO
    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }


    //DNI
    public function getDni()
    {
        return $this->dni;
    }


    public function setDni($dni)
    {
        $this->dni = $dni;
    }


    // DIRECCION

    public function getAdress()
    {
        return $this->adress;
    }


    public function setAdress($adress)
    {
        $this->adress = $adress;
    }


    //TELEFONO
    public function getTelephone()
    {
        return $this->telephone;
    }


    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    //MAIL
    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }

    //PASSWORD
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
