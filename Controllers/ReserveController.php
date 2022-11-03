<?php

namespace Controllers;

use Controllers\AuthController as AuthController;
use DAO\ReserveDAO;
use Models\Reserve as Reserve;
use DateInterval;
use DateTime;
use Cassandra\Date;
use Controllers\AvailableDateController as AvailableDateController;
use Models\AvailableDate;
use Controllers\UserController as UserController;

class ReserveController
{
    private $reserveDAO;
    private $petDAO;
    private $UserController;

    public function __construct()
    {
        $this->reserveDAO = new ReserveDAO();
        $this->petController = new PetController();
        $this->UserController = new UserController();
    }

    public function showAddView()
    {
        $listadoMascotas = $this->petController->GetByUserId($_SESSION['userid']);
        require_once(VIEWS_PATH . "reserve-add.php");
    }

    public function showChooseKeeperView($petid, $daterange)
    {
        $pet = $this->petController->PetFinder($petid);
        // var_dump($pet);
        // echo "<br>";

        $breed = $pet->getBreedId();
        // var_dump($breed);
        // echo "<br>";

        //parsear atributos
        $dateArray = explode(",", $daterange);
        $dateStart = new DateTime($dateArray[0]);
        $dateFinish = new DateTime($dateArray[1]);
        
        $AvailableDateController = new AvailableDateController();
        $AvailableDates = $AvailableDateController->getAvailablesListByDatesAndBreed($breed, $dateStart->format('y-m-d'), $dateFinish->format('y-m-d'));

        /** Esta logica filtra los guardianes repetidos.
            Podemos usar esto para no mostrar en la tabal choose-keeper.php al mismo guardian varias veces con distintas fechas.
            Con esto listamos a cada guardian solo una vez, y que el owner seleccione una fecha desde un desplegable que agregaremos a la tabla
         */
        $AvailableKeepers = array();
        $flag = 0;
        foreach($AvailableDates as $keeper){
            $flag = 0;
            foreach ($AvailableKeepers as $keeper2){
                // while($flag == 0){
                if($flag == 0){
                    if($keeper->getUserid() == $keeper2->getUserid()){
                        $flag = 1;
                    }
                    echo","; //falta condicion de corte de while
                }
            }
            if($flag == 0){
                array_push($AvailableKeepers, $this->UserController->GetUserById($keeper->getUserid()));
            }
        }
        /** */
       
        //pasar los datos a la vista
        require_once(VIEWS_PATH . "choose-keeper.php");
    }

    public function Add($petid, $daterange)
    {
        $reserve = new Reserve();

        $reserve->setTransmitterid($_SESSION['userid']); // id del dueno?
        $reserve->setReceiverid(2); // id del guardian seleccionado?
        $reserve->setPetid($petid);
        $reserve->setAmount(100); // varia segun el guardian?

        $this->reserveDAO->Add($reserve);
    }
}
