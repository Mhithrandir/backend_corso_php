<?php
    $errore = '';
    if((isset($_GET['action'])) && ($_GET['action'] == 'logout')){
        session_destroy();
        $_SESSION['logged_in'] = 0;
    }
    elseif(isset($_POST['login'])){
        echo 'entrato';
        //ho premuto sul bottone login
        require_once ('classi/database.php');
        $db = new Database();
        //Cerco se esiste un utente nel database
        $result = $db->SingleResult('SELECT * FROM utenti WHERE ((username = :user) AND (password = :pass))', array(
                    'user' => $_POST['username'],
                    'pass' => MD5($_POST['password'])
                  ));
        if(isset($result['id'])){
            //se l'utente esiste
            $db->ScriviLog('Login verificato per l utente : ' . $result['username']);
            $_SESSION['logged_in'] = 1;
            $_SESSION['id_utente'] = $result['id'];
            $_SESSION['password'] = $result['password'];
            $_SESSION['ruolo'] = $result['ruolo'];
            header("location: index.php?app=home");
            exit;
        }
        else{
            $errore = 'Login non riuscito! Username o password errata!';
        }
    }
?>
<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header"><i class="fa fa-fw fa-sign-in"></i>Login</div>
            <div class="card-body">
                <form name="frm_login" action="index.php?app=login" method="post">
                    <div class="form-group">
                        <label for="username"><i class="fa fa-fw fa-user"></i>Username</label>
                        <input class="form-control" name="username" id="username" type="text" aria-describedby="username" placeholder="Inserisci lo Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fa fa-fw fa-key"></i>Password</label>
                        <input class="form-control" name="password" id="password" type="password" placeholder="Inserisci la Password" required>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
                    <?php
                        if($errore != ''){
                            //stampo l'errore
                            ?>
                            <div>
                                <h2><?php echo $errore; ?></h2>
                            </div>
                            <?php
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>