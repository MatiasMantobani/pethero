<?php
    namespace Controllers;

    use Models\Payment as Payment;
    use DAO\PeymentDAO as paymentDAO;

    class PaymentController
    {
        private $paymentDAO;

        public function __construct()
        {
            $this->paymentDAO = new PaymentDAO();
        }


        public function Add($payment){
            return $this->paymentDAO->Add($payment);
        }

        public function GetAllByUserId($userid){
            return $this->paymentDAO->GetAllByUserId($userid);
        }




    }
?>