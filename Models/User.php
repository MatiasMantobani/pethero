<?php
    namespace Models;

    class User
    {
        private $userid;
        private $email;
        private $password;
        private $type;
        private $dni;
        private $cuit;
        private $name;
        private $surname;
        private $phone;
        private $status;

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

        /**
         * @return mixed
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed $email
         */
        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return mixed
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * @param mixed $password
         */
        public function setPassword($password)
        {
            $this->password = $password;
        }

        /**
         * @return mixed
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * @param mixed $type
         */
        public function setType($type)
        {
            $this->type = $type;
        }

        /**
         * @return mixed
         */
        public function getDni()
        {
            return $this->dni;
        }

        /**
         * @param mixed $dni
         */
        public function setDni($dni)
        {
            $this->dni = $dni;
        }

        /**
         * @return mixed
         */
        public function getCuit()
        {
            return $this->cuit;
        }

        /**
         * @param mixed $cuit
         */
        public function setCuit($cuit)
        {
            $this->cuit = $cuit;
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
        public function getSurname()
        {
            return $this->surname;
        }

        /**
         * @param mixed $surname
         */
        public function setSurname($surname)
        {
            $this->surname = $surname;
        }

        /**
         * @return mixed
         */
        public function getPhone()
        {
            return $this->phone;
        }

        /**
         * @param mixed $phone
         */
        public function setPhone($phone)
        {
            $this->phone = $phone;
        }

        /**
         * @return mixed
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * @param mixed $status
         */
        public function setStatus($status)
        {
            $this->status = $status;
        }



    }

?>