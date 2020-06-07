<?php
class Router implements Apparato
{
    private $name;
    private $model;
    private $typology;
    private $firmware;
    private $ports;
    private $serialNumber;
    
    function __construct($name, $model, $typology, $firmware, $ports, $serialNumber) {
        $this->name = $name;
        $this->model = $model;
        $this->typology = $typology;
        $this->firmware = $firmware;
        $this->ports = $ports;
        $this->serialNumber = $serialNumber;
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

    function setName($name): void {
        $this->name = $name;
    }

    function setModel($model): void {
        $this->model = $model;
    }

    function setType($type): void {
        $this->type = $type;
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


}
?>