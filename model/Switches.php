<?php
class Switches implements Apparato
{
    private $name;
    private $model;
    private $typology;
    private $firmware;
    private $ports;
    private $serialNumber;
    private $userID;
    
    function __construct($name, $model, $typology, $firmware, $ports, $serialNumber, $userID) {
        $this->name = $name;
        $this->model = $model;
        $this->typology = $typology;
        $this->firmware = $firmware;
        $this->ports = $ports;
        $this->serialNumber = $serialNumber;
        $this->userID = $userID;
    }

    
    function getName() {
        return $this->name;
    }

    function getModel() {
        return $this->model;
    }

    function getType() {
        return $this->typology;
    }

    function getFirmware() {
        return $this->firmware;
    }

    function getPorts() {
        return $this->ports;
    }

    function getSerialNumber() {
        return $this->serialNumber;
    }
    
    function getUserID() {
        return $this->userID;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setModel($model): void {
        $this->model = $model;
    }

    function setType($typology): void {
        $this->typology = $typology;
    }

    function setFirmware($firmware): void {
        $this->firmware = $firmware;
    }

    function setPorts($ports): void {
        $this->ports = $ports;
    }

    function setSerialNumber($serialNumber): void {
        $this->serialNumber = $serialNumber;
    }
    
    function setUserID($userID): void {
        $this->userID = $userID;
    }

}
?>
