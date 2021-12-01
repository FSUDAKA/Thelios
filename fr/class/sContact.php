<?php

require_once './class/Sites.php';

class sContact extends Sites{
    protected $table = "SITE_CONTACT";
    protected $mysqli;

    public function setPicContact($fileName, $eventId){
        $sql = "UPDATE `SITE_CONTACT` SET PIC_CONTACT='".mysqli_real_escape_string($this->mysqli, $fileName)."' WHERE EVENT_ID = '".$eventId."'";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
       return mysqli_fetch_array($req);
    }

    public function addContact ($txtContactSt, $mailContact, $idEvent){
        $sql = "UPDATE `SITE_CONTACT` 
                SET `TXT_CONTACT_ST` = '".mysqli_real_escape_string($this->mysqli, $txtContactSt)."',
                    `MAIL_CONTACT` = '".mysqli_real_escape_string($this->mysqli, $mailContact)."' 
                WHERE `EVENT_ID` = '".$idEvent."';";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_fetch_array($this->mysqli, $req);
    }

}