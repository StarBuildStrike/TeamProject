<?php
class Pill
{
    public function __construct($tn, $n, $f, $p)
    {
        $this->tradeName = $tn;
        $this->name = $n;
        $this->formula = $f;
        $this->price = $p;
        $this->lowerName = str_replace(' ', '', $this->tradeName);
        $this->lowerName = strtolower($this->lowerName);
    }
    function getTradeName() {
        return $this->tradeName;
    }
    function getName() {
        return $this->Name;
    }
    function getLowerName() {
        return $this->lowerName;
    }
    function getFormula() {
        return $this->Formula;
    }
    function getPrice() {
        return $this->price;
    }
    function showBottle() {
        return "<img src=\"img/$this->tradeName.jpg\" width = \"30\">";
    }
    function showCheckBox() {
        return "<input type=\"checkbox\" name=\"" . $this->lowerName ."\" value=\"yes\">";
        
    }
}
?>
