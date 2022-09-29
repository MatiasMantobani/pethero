<?php
    namespace Models;

    use Models\Person as Person;

    class Guardian extends Person
    {
        
        //atributos
        // cuil (string)
        //
        // remuneracion esperada (float)
        // reputacion (float de 1 a 5?)
        // tipo de perro aceptado arreglo (arreglo de S, M y L)
        // Fechas Disponibles[dias][hrs] -> Clase? o Date?
        // Listado Reservas[] (Clase)
	    // Listado reviews [texto,texto,texto...] (Clase)

        //constructor

        
        
        public function __construct($firstName, $lastName, $dni, $adress, $telephone, $email, $password)
        {
            parent::__construct($firstName, $lastName, $dni,$adress,$telephone,$email,$password);   //esto seria el super() de Java
        }

        //metodos 

   

       
    }
