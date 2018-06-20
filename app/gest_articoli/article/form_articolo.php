<form action="index.php?app=homepage&action=<?php echo $action;?>" method="post" name="modifica">
    <div class="form-group">
        <label for="titolo">Titolo</label>
        <input class="form-control" name="titolo" id="titolo" type="text" aria-describedby="titolo" value="<?php echo $titolo; ?>" placeholder="Inserisci il titolo">
    </div>
    <div class="form-group">
        <label for="contenuto">Contenuto</label>
        <textarea id="contenuto" name="contenuto"><?php echo $contenuto; ?></textarea>
    </div>
    <div class="form-group">
        <label for="file">Carica Immagine:</label>
        <input type="file" name="image" id="file" class="form-control">
    </div>
    <div class="form-group">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-file-image-o"></i> Seleziona un'immagine da galleria:
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    foreach ($vett_img as $a) {
                        ($a == $immagine) ? $active = 'active' : $active = '';
                        ?>
                        <div class="col">
                            <img class="incona-medium <?php echo $active; ?>" src="<?php echo $a; ?>" alt="">
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="utente">Seleziona l'autore:</label>
        <select name="utente" id="utente">
            <?php
            $res_user = $db->Query('SELECT id, username FROM utenti');
            $users = $db->FetchAll($res_user);
            foreach ($users as $value) {
                ($utente == $value['id']) ? $selected = 'selected' : $selected = '';
                echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['username'] . '</option>';
            }
            ?>
        </select>
    </div>
    <input type="hidden" value="<?php echo $id; ?>" name="id">
    <input type="hidden" name="img" id="img_selezionata">
    <!--<a href="index.php?app=article&id=<?php echo $id; ?>" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Salva</a>-->
    <input type="submit" name="salva_articolo" class="btn btn-primary" value="Save">
</form>