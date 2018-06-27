<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
    include_once ('menu.php');
    include_once('classi/database.php');
    $db = new Database();
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
                <i class="fa fa-file"></i> Gestione pagine</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Indice</th>
                                <th>Titolo</th>
                                <th>Link</th>
                                <th>Visibile</th>
                                <th>Argomento</th>
                                <th>Icona</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $vett = $menu->Children;
                                foreach ($vett as $m){
                                    if ($m->HasChildren()) {
                                        ?>
                                        <tr><td colspan="9"><table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <tr>
                                                        <th><?php echo $m->Indice; ?></th>
                                                        <th><?php echo $m->Titolo; ?></th>
                                                        <th><?php echo $m->Link; ?></th>
                                                        <th><?php echo $m->Visibile; ?></th>
                                                        <th><?php echo $m->Argomento; ?></th>
                                                        <th><?php echo $m->Icona; ?></th>
                                                        <th width="50"><a href="#" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i> Edit</a></th>
                                                        <th width="50"><a href="#" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> Delete</a></th>
                                                    </tr>
                                        <?php
                                        foreach ($m->Children as $item) {
                                        ?>

                                            <tr>
                                                <td><?php echo $item->Indice; ?></td>
                                                <td><?php echo $item->Titolo; ?></td>
                                                <td><?php echo $item->Link; ?></td>
                                                <td><?php echo $item->Visibile; ?></td>
                                                <td><?php echo $item->Argomento; ?></td>
                                                <td><?php echo $item->Icona; ?></td>
                                                <td width="50"><a href="#" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i> Edit</a></td>
                                                <td width="50"><a href="#" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> Delete</a></td>
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                                </table></tr>
                                    <?php
                                    }
                                    else{
                                    ?>
                                        <tr>
                                            <td><?php echo $m->Indice; ?></td>
                                            <td><?php echo $m->Titolo; ?></td>
                                            <td><?php echo $m->Link; ?></td>
                                            <td><?php echo $m->Visibile; ?></td>
                                            <td><?php echo $m->Argomento; ?></td>
                                            <td><?php echo $m->Icona; ?></td>
                                            <td width="50"><a href="#" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i> Edit</a></td>
                                            <td width="50"><a href="#" class="btn btn-danger"><i class="fa fa-fw fa-times"></i> Delete</a></td>
                                        </tr>
                                        <?php
                                }
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