<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
    include_once ('menu.php');
    include_once('classi/database.php');
    $db = new Database();
    if(isset($_GET['action'])){
        if($_GET['action'] == 'save'){
            $db->Query('UPDATE utenti SET password = :password, ruolo = :ruolo WHERE id = :id', array(
                'password' => MD5($_POST['password']),
                'ruolo' => $_POST['ruolo'],
                'id' => $_POST['id']
            ));
        }
        elseif($_GET['action'] == 'new'){
            $db->Query('INSERT INTO utenti (username, password, ruolo) VALUES(:username, :password, :ruolo)', array(
                'password' => MD5($_POST['password']),
                'ruolo' => $_POST['ruolo'],
                'username' => $_POST['username']
            ));
        }
        elseif ($_GET['action'] == 'new'){
            $db->Query('DELETE FROM utenti WHERE id = :id', array(
                'id' => $_GET['id']
            ));
        }
    }
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?app=homepage">Homepage</a></li>
            <li class="breadcrumb-item active">Gestione utenti</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-user"></i> Gestione degli utenti
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Ruolo</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = $db->Query('SELECT * FROM utenti');
                                while($array = $db->Fetch($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $array['id']; ?></td>
                                        <td><?php echo $array['username']; ?></td>
                                        <td>
                                            <?php
                                                if($array['ruolo'] == 0)
                                                    echo 'Amministratore';
                                                else echo 'Utente';
                                            ?>
                                        </td>
                                        <td width="50"><a href="index.php?app=utente&id=<?php echo $array['id']; ?>" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i> Edit</a></td>
                                        <td width="50"><a href="index.php?app=utenti&action=delete&&id=<?php echo $array['id']; ?>" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> Delete</a></td>
                                    </tr>
                                    <?php
                                }
                                $db->Close();
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
