<?php
error_reporting(E_ERROR | E_PARSE);

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\tag> $tags
 */
?>
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


<section class="content-header">
    <?php
    $add = "";
    $edit = "";
    $delete = "";
    $view = "";
    $session = $this->request->getSession();
    $abrv = $session->read('abrvv');
    $lien = $session->read('lien_parametrage' . $abrv);
    // debug($lien);die;
    foreach ($lien as $k => $liens) {
        if (@$liens['lien'] == 'listetags') {
            $add = $liens['ajout'];
            $edit = $liens['modif'];
            $delete = $liens['supp'];
        }
    }
    ?>
    <td colspan="3">
        <div style="float: left;font-size: 12px;margin-left:10px;"><strong>Liste des Tags</strong></div>
        <div style="float: right;font-size: 12px;margin-right:10px;">
            <strong><?php if ($add == 1) { ?>
                    <?php
                        echo $this->Html->link(
                            '<span class="fa fa-plus-circle valignmiddle btnTitle-icon"></span><span class="valignmiddle text-plus-circle btnTitle-label hideonsmartphone">
                  Nouveau Tag </span>',
                            ['action' => 'add', 'type' => '0'],
                            [
                                'class' => 'btnTitle',
                                'escape' => false,
                            ]
                        );
                    ?>

                    <!-- <div class="pull-right" style="margin-right:10px;">
            <?php  // echo $this->Html->link(__('Nouveau produit'), ['action' => 'add'], ['class' => 'btn btn-plus btn-sm']);
            ?>
        </div> -->
                <?php   } ?></strong>
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

            <?php echo $this->Form->create($tag, ['type' => 'get']); ?>
            <div class="col-xs-3">
                <?php
                echo $this->Form->control('tag', ['style' => 'font-size: 12px;', 'label' => false, 'placeholder' => 'TAG', 'required' => 'off', 'value' => $this->request->getQuery('tag')]); ?>
            </div>


            <div class="col-xs-1">
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

                        <li><input type="checkbox" style="font-size: 14px;" id="col-nom-checkbox"> Nom</li>
                        <li><input type="checkbox" style="font-size: 14px;" id="col-actions-checkbox"> Actions</li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-4">
            </div>

        </div>

        <?php echo $this->Form->end(); ?>



        <table id="example1" class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th width="10%" class="col-nom" align="center" style="font-size: 12px;">
                        <?= ('Tags') ?>
                    </th>


                    <th width="10%" class="col-actions actions text-center">
                        <?= __('Actions') ?>
                    </th>

                </tr>
            </thead>
            <tbody>


            <?php foreach ($listetags as $i => $listetag) :
                    ?>
                    <tr>
                        
                        <td class="col-nom" style="font-size: 12px;"><?= h($listetag->tag) ?></td>
                        <td class="col-actions actions text" align="center">
                            <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $listetag->id), array('escape' => false)); ?>
                                <?php if ($edit == 1) {
                                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $listetag->id), array('escape' => false));
                                } ?>
                                <?php if ($delete == 1) {
                                    echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteCon'><i class='fa fa-trash'></i></button>", array('action' => 'delete', $listetag->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $listetag->id));
                                } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

               
            </tbody>
        </table>
    </div>
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
<script>
    $(".deletecon").on("click", function() {
        return confirm(" Est que vous voulez vraiement supprimer !!  ");
    });
</script>