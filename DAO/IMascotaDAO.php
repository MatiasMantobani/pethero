<?php
namespace DAO;
use Models\Mascota as Mascota;

interface IMascotaDAO
{
    function Add(Mascota $mascota);
    function GetAll();
}

?>