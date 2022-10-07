<?php
    namespace DAO;

    use Models\Dueno as Dueno;

    interface IDuenoDAO
    {
        function Add(Dueno $dueno);
        function GetAll();
        function Remove($dni);
    }
?>