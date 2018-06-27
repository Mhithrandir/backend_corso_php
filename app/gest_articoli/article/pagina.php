<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
    include_once ('menu.php');
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <?php
                $app_elem = $menu->get('index.php?app=home');
                echo '<li class="breadcrumb-item"><a href="'
                    . $app_elem->Argomento
                    . '">'
                    . $app_elem->Titolo
                    . '</a></li>';
                if(isset($elemento->Parent)){
                    echo '<li class="breadcrumb-item"><a href="'
                        . $elemento->Parent->Argomento
                        . '">'
                        . $elemento->Parent->Titolo
                        . '</a></li>';
                }
                include_once ('classi/database.php');
                $db = new Database();
                $app = scandir(UPLOAD_DIR);
                $vett_img = array();
                foreach ($app as $a) {
                    if(($a != '.') && ($a != '..')) {
                        $vett_img[] = UPLOAD_DIR . '/' . $a;
                    }
                }
                if(isset($_GET['id'])){
                    ?>
            <li class="breadcrumb-item active">Edit Article</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-newspaper-o"></i> Modifica articolo
            </div>
            <div class="card-body">
                    <?php
                    $id = $_GET['id'];
                    $result = $db->SingleResult('SELECT * FROM articoli WHERE id = :id', array(
                            'id' => $id
                        ));
                    $titolo = $result['titolo'];
                    $contenuto = $result['contenuto'];
                    $immagine = $result['immagine'];
                    $utente = $result['utente'];
                    $action = 'salva';
                    include_once('app/gest_articoli/article/form_articolo.php');
                }
                else{
                    ?>
            <li class="breadcrumb-item active"><?php echo $elemento->Titolo ?></li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-newspaper-o"></i> Crea nuovo articolo</div>
                    <div class="card-body">
                    <?php
                    //crea un nuovo articolo
                    $titolo = $contenuto = $immagine = $utente = $id = '';
                    $action = 'new';
                    include_once('app/gest_articoli/article/form_articolo.php');
                }
                $db->Close();
            ?>
            </div>
        </div>
    </div>
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Your Website 2018</small>
            </div>
        </div>
    </footer>
    <?php
        include_once ('footer.php')
    ?>
    <script>
        $(document).ready(function () {
            $('.incona-medium').each(function () {
                $(this).mousedown(function () {
                    $('.incona-medium').each(function () {
                        $(this).removeClass("active");
                    });
                    $(this).addClass("active");
                    $('#img_selezionata').val($(this).attr('src'));
                });
            });
        });
    </script>
</div>
</body>
