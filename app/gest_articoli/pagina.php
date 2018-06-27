<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
    include_once ('menu.php');
    include_once('classi/database.php');
    $db = new Database();
    if(isset($_GET['action'])){
        if((!isset($_POST['img'])) || ((isset($_POST['img'])) && (empty($_POST['img'])))){
            //non ho selezionato nessuna immagine dalla galleria
            include_once('classi/class.upload.php');
            $handle = new upload($_FILES['image'], 'it-IT');
            //Accetta tutte le tipologie di immagini
            $handle -> allowed = 'image/*';
            $nome = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES['image']['name']);
            if($handle -> uploaded){
                $handle -> file_new_name_body = $nome;
                $handle -> image_resize = true;
                $handle -> image_x = 100;
                $handle -> image_ratio_y = true;
                $handle -> process('upload/');
                if($handle -> processed){
                    //Elimina i file dalla cartella temporanea
                    $handle -> clean();
                }
            }
            $immagine = UPLOAD_DIR . '/' . $_FILES['image']['name'];
        }
        else{
            $immagine = $_POST['img'];
        }
        if($_GET['action'] == 'salva'){
            $db->Query('UPDATE articoli SET titolo = :titolo, contenuto = :contenuto, modifica = :modifica, utente = :utente, immagine = :immagine WHERE id = :id', array(
                    'titolo' => $_POST['titolo'],
                    'contenuto' => $_POST['contenuto'],
                    'modifica' => date('Y-m-d H:i:s'),
                    'utente' => $_POST['utente'],
                    'immagine' => $immagine,
                    'id' => $_POST['id']
                ));
        }
        elseif($_GET['action'] == 'new'){
            $db->Query('INSERT INTO articoli (titolo, contenuto, inserimento, modifica, utente, immagine) VALUES(:titolo, :contenuto, :inserimento, :modifica, :utente, :immagine)', array(
                    'titolo' => $_POST['titolo'],
                    'contenuto' => $_POST['contenuto'],
                    'inserimento' => date('Y-m-d H:i:s'),
                    'modifica' => date('Y-m-d H:i:s'),
                    'utente' => $_POST['utente'],
                    'immagine' => $immagine
                ));
        }
        elseif($_GET['action'] == 'delete'){
            $db->Query('DELETE FROM articoli WHERE id = :id', array( 'id' => $_GET['id'] ));
        }
    }
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
                echo '<li class="breadcrumb-item active">' . $elemento->Titolo . '</li>';
            ?>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-newspaper-o"></i> Gestione news</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Inserimento</th>
                                <th>modifica</th>
                                <th>autore</th>
                                <th>immagine</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = $db->Query('SELECT * FROM articoli');
                                while($array = $db->Fetch($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $array['titolo']; ?></td>
                                        <td><?php echo $array['inserimento']; ?></td>
                                        <td><?php echo $array['modifica']; ?></td>
                                        <td>
                                            <?php
                                                $user = $db->SingleResult('SELECT username FROM utenti WHERE id = :id', array(
                                                        'id' => $array['utente']
                                                    ));
                                                echo $user['username'];
                                            ?>
                                        </td>
                                        <td><img class="incona-small" src="<?php echo $array['immagine']; ?>" alt="<?php echo $array['immagine']; ?>"/></td>
                                        <td width="50"><a href="index.php?app=article&id=<?php echo $array['id']; ?>" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i> Edit</a></td>
                                        <td width="50"><a href="index.php?app=gest_articoli&action=delete&id=<?php echo $array['id']; ?>" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> Delete</a></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
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
</div>
</body>
<?php
    $db->Close();
?>