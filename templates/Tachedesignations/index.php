<!-- Content Header (Page header) -->

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
        /* Ajustez la largeur souhaitée en pixels */
    }

    .btn-large {
        font-size: 15px;
        /* Ajustez la taille de la police selon vos besoins */
        padding: 8px 18px;
        /* Ajustez la taille des marges intérieures (padding) selon vos besoins */
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Votre modèle AdminLTE</title> -->
    <!-- Inclure la bibliothèque Font Awesome via CDN
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
    <!-- Autres balises meta et liens CSS 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/latest/css/all.min.css">-->

</head>
<section class="content-header">
    <?php //
    $add = "";
    $edit = "";
    $delete = "";
    $view = "";
    $session = $this->request->getSession();
    $abrv = $session->read('abrvv');
    $lien = $session->read('lien_parametrage' . $abrv);
    // debug($lien);die;
    foreach ($lien as $k => $liens) {
        if (@$liens['lien'] == 'tachedesignations') {
            $add = $liens['ajout'];
            $edit = $liens['modif'];
            $delete = $liens['supp'];
        }
    }
    ?>
    <td colspan="3">
        <div style="float: left;font-size: 12px;margin-left:10px;"><strong> Taches</strong></div>
        <div style="float: right;font-size: 12px;margin-right:10px;">
            <strong><?php  if ($add == 1) { 
                    ?>
                <?php
                echo $this->Html->link(
                    '<span class="fa fa-plus-circle valignmiddle btnTitle-icon"></span><span class="valignmiddle text-plus-circle btnTitle-label hideonsmartphone">
                 Nouvelle Taches </span>',
                    ['action' => 'add'],
                    [
                        'class' => 'btnTitle',
                        'escape' => false,
                    ]
                );
                ?>
                <?php   } 
                ?>
            </strong>
        </div>
    </td>
</section>
<?php ?>
<br>
<br>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <?php echo $this->Form->create($tachedesignations, ['type' => 'get']); ?>
            <div class="col-xs-3">
                <?php
                echo $this->Form->control('designation', ['required' => 'off', 'style' => 'font-size: 12px;', 'label' => false, 'placeholder' => 'Designation', 'value' => $this->request->getQuery('designation'), 'autocomplete' => 'off', 'class' => 'form-control control-label']);
                ?>
            </div>
            <div class="col-xs-2">
                <button type="submit" class="btn btn-default custom-width-button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <div class="col-xs-1">
                <?php echo $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-default btn-large fa fa-remove']) ?>
            </div>

            <div class="col-xs-1" hidden>
                <div class="dropdown" style="position: relative;">
                    <a href="javascript:void(0);" id="showColumnList" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: relative; z-index: 1;">
                        <i class="fa fa-list" style="font-size: 30px; padding: 6px 30px;"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="showColumnList" style="position: absolute; top: -5%; z-index: 2;">
                        <!-- Vos éléments de liste ici -->

                        <li><input type="checkbox" style="font-size: 14px;" id="col-nom-checkbox"> designation</li>
                        <li><input type="checkbox" style="font-size: 14px;" id="col-valeur-checkbox"> Num</li>

                        <li><input type="checkbox" style="font-size: 14px;" id="col-actions-checkbox"> Actions</li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-7">
            </div>

        </div>
        <?php echo $this->Form->end(); ?>
        <table id="example1" class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th width="10%" class="col-nom" align="center" style="font-size: 12px;">
                        <?= ('Num') ?>
                    </th>
                    <th width="50%" class="col-valeur" align="center" style="font-size: 12px;">
                        <?= h('Designation') ?>
                    </th>
                    <th width="10%" class="col-actions actions text-center">
                        <?= __('Actions') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tachedesignations as $tachedesignation) : ?>
                    <tr>
                        <td hidden><?= h($tachedesignation->id) ?></td>
                        <td class="col-valeur" style="font-size: 12px;">
                            <?= h($tachedesignation->num) ?>
                        </td>
                        <td class="col-nom" style="font-size: 12px;">
                            <?= h($tachedesignation->designation) ?>
                        </td>
                        <td class="col-actions actions text" align="center">
                            <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $tachedesignation->id), array('escape' => false)); ?>
                            <?php  if ($edit == 1) {
                            echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $tachedesignation->id), array('escape' => false));
                              } 
                            ?>
                            <?php // if  ($delete == 1) {
                            // echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm '   ><i class='fa fa-trash'></i></button>", array('action' => 'delete', $tachedesignation->id), array('escape' => false));
                            // } 
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
</section>

<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('alert'); ?>
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
</script>
<script language="JavaScript" type="text/javascript">
    $(function() {
        $('.deleteConfirm').on('click', function() {

            return confirm('Voulez vous supprimer cette enregistrement? ');

        });


    });
</script>
<script>
    $('.select2').select2()
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