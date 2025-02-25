<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-container {
        display: block;
        width: auto !important;
    }

    .custom-width-button {
        width: 50px;
    }

    .btn-large {
        font-size: 15px;
        padding: 8px 18px;
    }
</style>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_parametrage' . $abrv);
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'signatures') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
    }
    //debug($liens);die;
}

?>
<section class="content-header">

    <td colspan="3">
        <div style="float: left;font-size: 12px;margin-left:10px;"><strong>Paramétrage nombre de jours</strong></div>
        <!-- <div style="float: right;font-size: 12px;margin-right:10px;">
            <strong><?php ?>
                <?php
                echo $this->Html->link(
                    '<span class="fa fa-plus-circle valignmiddle btnTitle-icon"></span><span class="valignmiddle text-plus-circle btnTitle-label hideonsmartphone">
                        Ajouter</span>',
                    ['action' => 'add', 'type' => '0'],
                    [
                        'class' => 'btnTitle',
                        'escape' => false,
                    ]
                );
                ?>
                <?php ?>
            </strong>
        </div> -->
    </td>
</section><br>
<br>

<section class="content" style="width: 99%">
    <div class="box">
        <table id="example 1" class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th style="font-size: 12px;" class="col-Nom" align="center"><?= __('Nombre de jours') ?></th>
                    <th style="font-size: 12px;" class="col-Action" align="center"><?= __('Action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($parametragejours as $paramj) : ?>
                    <tr>
                        <td hidden><?= h($paramj->id) ?></td>
                        <td style="font-size: 12px;" class="col-Nom"><?= h($paramj->nbrejours) ?></td>
                       
                        <td style="font-size: 12px;" class="col-Actions actions text" align="center">
                            <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $paramj->id), array('escape' => false)); ?>
                            <?php
                            echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $paramj->id), array('escape' => false));
                            ?>
                            <!-- <?php
                            echo $this->Form->postLink("<button class='btn btn-xs btn-danger deletecon'><i class='fa fa-trash'></i></button>", array('action' => 'delete', $paramj->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $paramj->id));
                            ?> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
    </div>
</section>
<style>
    .hidden {
        display: none;
    }

    /* Styles pour le bouton */
    .dropbtn {
        background-color: #3498db;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
    }

    /* Styles pour la liste déroulante */
    .dropdown-menu {
        position: absolute;
        left: 70px;
        /* Ajustez la position horizontale selon vos besoins */
        cursor: pointer;
        max-height: 400px;
        width: 200px;
        overflow-y: auto;
    }

    /* Styles pour les étiquettes des cases à cocher */
    .dropdown-menu input[type="checkbox"]+label {
        font-weight: normal;
        /* Évite que le texte soit en gras */
    }

    /* Changement de couleur au survol */
    .dropdown-menu label:hover {
        background-color: #ddd;
    }

    /* Afficher la liste déroulante lorsque le bouton est survolé */
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    /* .dropdown-menu label {
        display: block;
        white-space: nowrap;
        top: -100%;
    } */
</style>
<!-- /.content -->

<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
        'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
        'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'MM/DD/YYYY h:mm A'
    })
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var checkboxes = document.querySelectorAll('ul.dropdown-menu input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            var targetColumn = checkbox.id.replace("-checkbox", "");
            var columns = document.querySelectorAll('.' + targetColumn);

            checkbox.checked = Array.from(columns).every(function(column) {
                return column.style.display !== "none";
            });

            checkbox.addEventListener("change", function() {
                columns.forEach(function(column) {
                    if (checkbox.checked) {
                        column.style.display = "table-cell";
                    } else {
                        column.style.display = "none";
                    }
                });
            });
        });
    });
</script>
<?php $this->end(); ?>