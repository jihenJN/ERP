<?php

use Cake\I18n\FrozenTime;

error_reporting(E_ERROR | E_PARSE);

$now =  new FrozenTime('now', 'Africa/Tunis');
$wr =$this->Url->build('/', ['fullBase' => true]);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <td colspan="3">
        <div style="float: left;font-size: 12px;margin-left:10px;"><strong> Modification Taches </strong></div>
        <div style="float: right;font-size: 12px;margin-right:10px;">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Url->build(['controller' => 'projets', 'action' => 'index/', $projet_id]); ?>"><i class="fa fa-reply"></i>
                        <?php echo __('Retour'); ?></a></li>
            </ol>
        </div>
    </td>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <?php
                echo $this->Form->create($tacheprojet, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body" style="font-size: 12px;">
                    <div class="row">
                        <div class="col-xs-3" style="margin-top:3%;margin-left:2%; width: 80px;">
                            <img src="<?php echo $wr; ?>/webroot/img/projeticon.png" alt="Image du projet" style="max-width: 50px; max-height: 50px;">
                        </div>
                        <div class="col-xs-8" style="margin:1%">
                            <br>
                            <div style="font-size: 15px;"><b><?php echo ($projet->libelle); ?></b></div> <br>
                            <div style="font-size: 15px;"> <?php echo ($projet->name); ?> </div>
                            <div style="font-size: 15px;"> <label> Tiers: </label> <?php echo ($projet->client->nom); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table style="width: 97%; margin: 2%;" class="table table-bordered table-striped">
                                <tr>
                                    <td style="width: 20%; text-align: left; vertical-align: middle;">USAGE</td>
                                    <td>
                                        <div class="form-check">
                                            <?php echo $this->Form->control('suivre_opportunite', ['disabled' => 'disabled', 'type' => 'checkbox', 'label' => 'Suivre Opportunite', 'checked' => $projet->suivre_opportunite == 1, 'class' => 'form-check-input', 'id' => 'suivre_opportunite']); ?>
                                        </div>
                                        <div class="form-check">
                                            <?php echo $this->Form->control('suivre_tache', ['disabled' => 'disabled', 'type' => 'checkbox', 'label' => 'Suivre Tache', 'checked' => $projet->suivre_tache == 1, 'class' => 'form-check-input', 'id' => 'suivre_tache']); ?>
                                        </div>
                                        <div class="form-check">
                                            <?php echo $this->Form->control('facturer_temps_passe', ['disabled' => 'disabled', 'type' => 'checkbox', 'label' => 'Facturer Temps Passe', 'checked' => $projet->facturer_temps_passe == 1, 'class' => 'form-check-input', 'id' => 'facturer_temps_passe']); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: left; vertical-align: middle;">Visibilité</td>
                                    <td>
                                        <?php if ($projet->visibilite == 0) { ?>
                                            <?php echo ('Contacts Projets') ?>
                                        <?php } else if ($projet->visibilite == 1) { ?>
                                            <?php echo ('Tout le monde') ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: left; vertical-align: middle;">Date début - Date fin</td>
                                    <td><?php echo $projet->date . ' - ' . $projet->datefin; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: left; vertical-align: middle;">Budget</td>
                                    <td><?php echo $projet->budget; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: left; vertical-align: middle;">Description</td>
                                    <td><?php echo $projet->description; ?></td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="box-body" style="font-size: 12px;">
                        <div class="row">
                            <div class="col-xs-3" style="margin-top:3%;margin-left:2%; width: 80px;">
                                <img src="<?php echo $wr; ?>/webroot/img/ficheicon.png" alt="Image du projet" style="max-width: 50px; max-height: 50px;">
                            </div>
                            <div class="col-xs-8" style="margin:1%">
                                <br>
                                <div style="font-size: 15px;"><b><?php echo ($tacheprojet->tachedesignation->num); ?></b></div>
                                <div style="font-size: 15px;"> <?php echo ($tacheprojet->tachedesignation->designation); ?> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <table style="width: 97%; margin: 2%;" class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td style="width: 15%; text-align: left; vertical-align: middle;">Enfant de la tâche</td>
                                            <td>++</td>
                                            <td style="width: 15%; text-align: left; vertical-align: middle;">Progression déclarée</td>
                                            <td>++</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%; text-align: left; vertical-align: middle;">contact de la tache</td>
                                            <td>++</td>
                                            <td style="width: 15%; text-align: left; vertical-align: middle;">Progression calculée</td>
                                            <td>++</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 15%; text-align: left; vertical-align: middle;">Description</td>
                                            <td>++</td>
                                            <td style="width: 15%; text-align: left; vertical-align: middle;">Charge de travail prévue</td>
                                            <td>++</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="text-right" style="margin-right: 15px;">
                        <button type="button" id="toggleButton" class="btn btn-primary">
                            Modifier <i class="fa fa-pencil"></i>
                        </button>
                    </div>

                    <table style="display:none" style="width: 97%; margin: 2%;" id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td align="center" style="width: 10%;" hidden> id </td>
                                <td align="center" style="width: 20%;"> Tache </td>
                                <td align="center" style="width: 10%;"> Date Debut </td>
                                <td align="center" style="width: 20%;"> Date Fin </td>
                                <td align="center" style="width: 20%;"> Responsable </td>
                                <td align="center" style="width: 20%;"> Etat </td>
                            </tr>
                        </thead>
                        <tbody>
                            <td hidden align="center">
                                <?php echo $this->Form->input('id', array('value' => $tacheprojet->id, 'label' => '', 'style' => "pointer-events: none;", 'readonly', 'name' => 'id', 'id' => 'id', 'champ' => 'id', 'table' => 'tachedesignation', 'index' => '', 'div' => 'form-group',  'class' => 'form-control')); ?>
                            </td>
                            <td hidden align="center">
                                <?php echo $this->Form->input('projet_id', array('value' => $tacheprojet->projet_id, 'options' => $projets, 'style' => "pointer-events: none;", 'readonly', 'label' => '', 'name' => 'projet_id', 'id' => 'projet_id', 'champ' => 'projet_id', 'table' => 'tacheprojets', 'index' => '', 'div' => 'form-group',  'class' => 'form-control')); ?>
                            </td>
                            <td align="center">
                                <?php echo $this->Form->control('tachedesignation_id', array('value' => $tacheprojet->tachedesignation_id, 'style' => "pointer-events: none;", 'readonly', 'options' => $tachedesignations, 'name' => 'tachedesignation_id', 'champ' => 'tachedesignation_id', 'label' => '', 'table' => 'tacheprojets', 'index' => '', 'class' => 'form-control', 'id' => 'tachedesignation_id')); ?>
                            </td>
                            <td align="center">
                                <?php echo $this->Form->input('datedebut', array('value' => $tacheprojet->datedebut, 'type' => 'datetime', 'label' => '', 'name' => 'datedebut', 'id' => 'datedebut', 'champ' => 'datedebut', 'table' => 'tacheprojets', 'index' => '', 'div' => 'form-group',  'class' => 'form-control')); ?>
                            </td>
                            <td align="center">
                                <?php echo $this->Form->input('datefin', array('value' => $tacheprojet->datefin, 'type' => 'datetime', 'label' => '', 'name' => 'datefin', 'id' => 'datefin', 'champ' => 'datefin', 'table' => 'tacheprojets', 'index' => '', 'div' => 'form-group',  'class' => 'form-control')); ?>
                            </td>
                            <td align="center">
                                <?php echo $this->Form->control('personnel_id', array('value' => $tacheprojet->personnel_id, 'options' => $personnels, 'empty' => 'Veuillez Choisir un Responsable!!!', 'name' => 'personnel_id', 'champ' => 'personnel_id', 'label' => '', 'table' => 'tacheprojets', 'index' => '', 'class' => 'form-control  select2', 'id' => 'personnel_id')); ?>
                            </td>
                            <td align="center">
                                <?php echo $this->Form->control('etat', ['type' => 'checkbox', 'checked' => $tacheprojet->etat == 1, 'name' => 'etat', 'champ' => 'etat', 'label' => '', 'table' => 'tacheprojets', 'index' => '', 'class' => 'form-check-input', 'id' => 'etat']); ?>
                            </td>


                        </tbody>
                    </table>
                    <div id="divbtn" hidden align="center">
                        <button type="submit" class="pull-right btn btn-success btn-sm log" id="alertcateg" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script type="text/javascript">
    $(function() {
        // $('# ').on('mousemove', function() {
        //     name = $('#name').val();
        //     if (name == '') {
        //         alert('choisir un nom', function() {});
        //     } else if (val == '') {
        //         alert('choisir un valeur', function() {});
        //     }
        // });
    });
</script>
<script>
    var toggleButton = document.getElementById('toggleButton');
    var maTable = document.getElementById('example1');
    var divtbn = document.getElementById('divbtn');

    toggleButton.addEventListener('click', function() {
        if (maTable.style.display === 'none') {
            maTable.style.display = 'table';
            divtbn.style.display = 'block';
        } else {
            maTable.style.display = 'none';
            divtbn.style.display = 'none';
        }
    });
</script>

<script>
    $('#alertcateg').on('mouseover click', function(event) {
        var tableRows = document.querySelectorAll('tbody tr');
        for (var i = 0; i < tableRows.length; i++) {
            var datedebut = tableRows[i].querySelector('[name^="data[tacheprojets]"][index="' + i + '"][champ="datedebut"]').value;
            var datefin = tableRows[i].querySelector('[name^="data[tacheprojets]"][index="' + i + '"][champ="datefin"]').value;
            if (datefin != null) {
                if (datefin && datedebut) {
                    if (new Date(datefin) < new Date(datedebut)) {
                        alert('Veuillez vous assurer que la "date fin" est supérieure ou égale à la "date debut" pour la ligne ' + (i + 1) + '.');
                        event.preventDefault();
                        return;
                    }
                }
            }
        }
    });
</script>
<?php $this->end(); ?>