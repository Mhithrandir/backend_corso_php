<?php
class menu
{
    function __construct(){
        include_once ('database.php');
        include_once ('elemMenu.php');
        $db = new Database();
        $this->Children = array();
        $result = $db->Query('SELECT * FROM menu WHERE parent IS NULL');
        while($array = $db->Fetch($result)){
            $this->Children[] = new elemMenu($array, null);
            $sottodb = new Database();
            $childs = $sottodb->Query('SELECT * FROM menu WHERE parent = :id', array('id' => end($this->Children)->Id));
            while($vett = $sottodb->Fetch($childs)){
                end($this->Children)->AddChildren(new elemMenu($vett, end($this->Children)));
            }
            $sottodb->Close();
        }
        $db->Close();
    }
    public function toString(){
        $result = '<ul class="navbar-nav navbar-sidenav" id="menuPrincpale">';
        foreach ($this->Children as $child){
            if($child->Visibile) {
                $result .= $child->toString();
            }
        }
        return $result . '</ul>';
    }
    public function get($argomento){
        foreach ($this->Children as $child){
            if($child->Argomento == $argomento)
                return $child;
            elseif ($child->get($argomento) !== null)
                return $child->get($argomento);
        }
        return null;
    }
}