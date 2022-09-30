<?php
    namespace Models;

    use Models\Person as Person;

    class Guardian extends Person
    {
        //atributos
        private $cuil; // int
        private $remuneracion; // float
        private $reputacion; // del 1 al 5, empieza vacio y se va actualizando a medida que cumpla con sus trabajos
        private $tamanoDeMascota;// small, medium, large
        private $disponibilidad; // Date?
        private $reservas; // arreglo apenas se registra esta vacio
        private $reviews; // arreglo apenas se registra esta vacio

        //constructor

        public function __construct($firstName, $lastName, $dni, $adress, $telephone, $email, $password, $cuil, $remuneracion, $tamanoDeMascota, $disponibilidad)
        {
            parent::__construct($firstName, $lastName, $dni,$adress,$telephone,$email,$password);   //esto seria el super() de Java
            $this->cuil = $cuil;
            $this->remuneracion = $remuneracion;
            $this->tamanoDeMascota = $tamanoDeMascota;
            $this->disponibilidad = $disponibilidad;
        }

        /**
         * @return mixed
         */
        public function getCuil()
        {
            return $this->cuil;
        }

        /**
         * @param mixed $cuil
         */
        public function setCuil($cuil)
        {
            $this->cuil = $cuil;
        }

        /**
         * @return mixed
         */
        public function getRemuneracion()
        {
            return $this->remuneracion;
        }

        /**
         * @param mixed $remuneracion
         */
        public function setRemuneracion($remuneracion)
        {
            $this->remuneracion = $remuneracion;
        }

        /**
         * @return float
         */
        public function getReputacion()
        {
            return $this->reputacion;
        }

        /**
         * @param float $reputacion
         */
        public function setReputacion( $reputacion)
        {
            $this->reputacion = $reputacion;
        }

        /**
         * @return array
         */
        public function getTamanoDeMascota()
        {
            return $this->tamanoDeMascota;
        }

        /**
         * @param array $tamanoDeMascota
         */
        public function setTamanoDeMascota($tamanoDeMascota)
        {
            $this->tamanoDeMascota = $tamanoDeMascota;
        }

        /**
         * @return mixed
         */
        public function getDisponibilidad()
        {
            return $this->disponibilidad;
        }

        /**
         * @param mixed $disponibilidad
         */
        public function setDisponibilidad($disponibilidad)
        {
            $this->disponibilidad = $disponibilidad;
        }

        /**
         * @return array
         */
        public function getReservas()
        {
            return $this->reservas;
        }

        /**
         * @param array $reservas
         */
        public function setReservas( $reservas)
        {
            $this->reservas = $reservas;
        }

        /**
         * @return array
         */
        public function getReviews()
        {
            return $this->reviews;
        }

        /**
         * @param array $reviews
         */
        public function setReviews( $reviews)
        {
            $this->reviews = $reviews;
        }



    }
