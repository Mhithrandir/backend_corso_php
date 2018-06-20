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
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $result = $db->SingleResult('SELECT * FROM utenti WHERE id = :id', array(
                        'id' => $id
                    ));
            ?>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-user"></i> Modifica utente
            </div>
            <div class="card-body">
                <form method="post" action="index.php?app=utenti&action=save" name="edit_user">
                    <div class="form-group">
                        <label for="utente">Username</label>
                        <label id="utente"><?php echo $result['username']; ?></label>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" name="password" id="password" type="password" aria-describedby="password" placeholder="Inserisci una nuova password" required>
                    </div>
                    <div class="form-group">
                        <label for="ruolo">Ruolo</label>
                        <select class="form-control" name="ruolo" id="ruolo" type="ruolo" aria-describedby="ruolo" required>
                            <?php
                                $selected_utente = '';
                                $selected_admin = '';
                                echo $result['ruolo'];
                                if($result['ruolo'] == 1){
                                    $selected_utente = 'selected';
                                }
                                else{
                                    $selected_admin = 'selected';
                                }
                            ?>
                            <option value="1" <?php echo $selected_utente; ?>>Utente</option>
                            <option value="0" <?php echo $selected_admin; ?>>Amministratore</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                    <input type="submit" class="btn btn-primary" name="salva_login" value="Save">
                </form>
                <?php
                }
                else {
                ?>
            <li class="breadcrumb-item active">Add User</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-user-plus"></i> <?php echo $elemento->Titolo ?>
            </div>
            <div class="card-body">
                <form method="post" action="index.php?app=utenti&action=new" name="edit_user">
                    <div class="form-group">
                        <label for="utente">Username</label>
                        <input class="form-control" name="utente" id="utente" type="utente" aria-describedby="utente" placeholder="Inserisci lo username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" name="password" id="password" type="password" aria-describedby="password" placeholder="Inserisci una nuova password" required>
                    </div>
                    <div class="form-group">
                        <label for="ruolo">Ruolo</label>
                        <select class="form-control" name="ruolo" id="ruolo" type="ruolo" aria-describedby="ruolo" required>
                            <option value="1">Utente</option>
                            <option value="0">Amministratore</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="salva_login" value="Save">
                </form>
                <?php
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
</div>
</body>
