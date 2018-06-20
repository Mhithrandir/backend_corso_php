<?php
    require_once ('head.php');
    include_once ('classi/menu.php');
    $menu = new menu();
    if(isset($_GET['app'])){
        $elemento = $menu->get('index.php?app=' . $_GET['app']);
        if(!isset($elemento)){
            //visualizzo un errore
            $elemento = $menu->get('404');
        }
    }
    else{
        $elemento = $menu->get('index.php?app=home');
    }
    include_once ($elemento->Link);
?>
</body>
</html>