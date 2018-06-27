<?php
class elemMenu
{
    function __construct($array, $parent)
    {
        $this->Id = $array['id'];
        $this->Indice = $array['indice'];
        $this->Titolo = $array['titolo'];
        $this->Link = $array['link'];
        $this->Visibile = $array['visibile'];
        $this->Argomento = $array['argomento'];
        $this->Icona = $array['icona'];
        $this->Parent = $array['parent'];
        $this->Children = array();
        $this->Parent = $parent;
    }
    public function AddChildren($elem){
        $this->Children[] = $elem;
    }
    public function HasChildren(){
        return (count($this->Children) > 0);
    }
    public function toString(){
        if($this->HasChildren()){
            $active = 'collapse';
            if(((isset($_GET['app'])) && ($this->isActive($_GET['app']))) || ((isset($_GET['app'])) && ($this->isChildrenActive($_GET['app'])))){
                $active = '';
            }
            $stringa_tot = '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="'
                . $this->Titolo
                . '"><a class="nav-link nav-link-' . $active . ' ' . $active . '" data-toggle="collapse" href="#'
                . $this->Titolo
                . '" data-parent="#menuPrincpale">'
                . $this->Icona
                . '<span class="nav-link-text"> '
                . $this->Titolo
                . '</span></a><ul class="sidenav-second-level ' . $active . '" id="'
                . $this->Titolo
                . '">';
            foreach ($this->Children as $child){
                $stringa_tot .= $child->toString();
            }
            return $stringa_tot . '</ul></li>';
        }
        else{
            $active = '';
            if((isset($_GET['app'])) && ($this->isActive($_GET['app']))){
                $active = 'active';
            }
            return '<li class="nav-item ' . $active . '" data-toggle="tooltip" data-placement="right" title="'
                . $this->Titolo
                . '"><a class="nav-link" href="'
                . $this->Argomento
                . '">'
                . $this->Icona
                . '<span class="nav-link-text"> '
                . $this->Titolo
                . '</span></a></li>';
        }
    }
    public function get($argomento){
        if(!$this->HasChildren())
            return null;
        foreach ($this->Children as $child){
            if($child->Argomento == $argomento)
                return $child;
            elseif ($child->get($argomento) !== null)
                return $child->get($argomento);
        }
    }
    public function isActive($app){
        return (strpos($this->Argomento, $app) != false);
    }
    public function isChildrenActive($app){
        if(!$this->HasChildren()) return false;
        foreach ($this->Children as $child){
            if($child->isActive($app)) return true;
        }
        return false;
    }
}
?>