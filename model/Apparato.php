<?php
interface Apparato
{

    public function getName();
    
    public function getModel();
    
    public function getType();
    
    public function getFirmware();

    public function getPorts();

    public function getSerialNumber();
            
    public function setName($name);
    
    public function setModel($model);

    public function setType($type);

    public function setFirmware($firmware);

    public function setPorts($ports);

    public function setSerialNumber($serialNumber);

}
?>