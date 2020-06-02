<?php
interface Apparato
{

    public function getName();
    
    public function getModel();
    
    public function getType();
    
    public function getFirmware();

    public function getPorts();

    public function getSerialNumber();
            
    public function setName();
    
    public function setModel();

    public function setTypology();

    public function setFirmware();

    public function setPorts();

    public function setSerialNumber();

}
?>