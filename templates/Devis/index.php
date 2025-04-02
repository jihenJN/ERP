<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Devi> $devis
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_parametrage' . $abrv);
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'societes') {

        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
    }
}
?>

<!-- Add Button if Permission Exists -->
<?php if ($add == 1) { ?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php } ?>

<br><br>
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<div class="box">
    <div class="box-header">
    </div>

    <div class="box-body">

        <?php echo $this->Form->create($devis, ['id' => 'searchForm', 'type' => 'get']); ?>
        <div class="row">


            <div class="col-xs-6">
                <label class="control-label" for="name">Date début Devis
                </label>
                <?php
                echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                ?>
            </div>


            <div class="col-xs-6">
                <label class="control-label" for="name">Date Fin Devis
                </label>
                <?php
                echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                ?>

            </div>





            <div class="col-xs-4">


                <label class="control-label" for="name">Nom Client
                </label>
                <select class="form-control select2" id="client_id" name="client_id">
                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                    <?php foreach ($clients as $id => $client) {
                    ?>

                        <option <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?> value="<?php echo $client->id; ?>"><?php echo $client->Raison_Sociale ?></option>
                    <?php } ?>
                </select>
            </div>

            

            <div class="col-xs-4">
    <label class="control-label" for="article_id">Nom Article</label>
    <select class="form-control select2" id="article_id" name="article_id[]" multiple="multiple">
        <option value="" disabled>Veuillez choisir !!</option>
        <?php 
        $selectedArticles = (array) $this->request->getQuery('article_id'); // Ensure it's always an array
        foreach ($articles as $article): 
        ?>
            <option 
                value="<?= $article->id ?>" 
                <?= in_array($article->id, $selectedArticles) ? 'selected="selected"' : '' ?>
            >
                <?= $article->Dsignation ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>





            <div class="col-xs-1">
                <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                    <i class="fa fa-search"></i>
                </button>

            </div>
            <?php if ($count != 0) { ?>
                <div class="col-xs-1">

                    <!-- <button onclick="openWindow(1000, 1000, wr+'factureclients/imprimelistefactureclient?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$client_id; ?>&numdeb=<?php echo @$numdeb; ?>&numfin=<?php echo @$numfin; ?>&reglee=<?php echo @$reglee; ?>')" class="btn btn-primary" style="margin-top: 25px;">
                            <i class="fa fa-print"></i>
                        </button> -->
                </div>
            <?php } ?>

            <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                <?php echo $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
            </div>

            <?php echo $this->Form->end(); ?>
        </div>

    </div>


</div>


<br>
<h1>Devis</h1>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="10%" align="center"><?= __('Numéro') ?></th>
                                <th width="20%" align="center"><?= __('Date') ?></th>
                                <th width="20%" align="center"><?= __('Client') ?></th>
                                <th width="20%" align="center"><?= __('Articles') ?></th>
                                <th width="10%" align="center"><?= __('Total Remise') ?></th>
                                <th width="10%" align="center"><?= __('Total Ht') ?></th>
                                <th width="10%" align="center"><?= __('Total Brute') ?></th>
                                <th width="10%" align="center"><?= __('Total TVA') ?></th>
                                <th width="10%" align="center"><?= __('Total TTC') ?></th>
                                <th width="30%" scope="col" class="actions text-center"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($devis as $i => $devi): ?>
                                <tr>
                                    <td><?= h($devi->numero) ?>
                                        <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $devi->id, 'label' => '', 'type' => 'hidden', 'champ' => 'id', 'class' => 'form-control']); ?>
                                    </td>
                                    <td><?= h($devi->date) ?>
                                        <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $devi->id, 'label' => '', 'type' => 'hidden', 'champ' => 'id', 'class' => 'form-control']); ?>
                                    </td>
                                    <td><?= h($devi->client->Raison_Sociale) ?></td>
                                    <td>
                                        <!-- Loop through Lignedevis (line items) associated with the Devis -->
                                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                            <?php foreach ($devi->lignedevis as $ligne): ?>
                                                <span style="background-color: #3c8dbc; color: white; padding: 5px 10px; border-radius: 10px; font-size: 16px;">
                                                    <?= h($ligne->article->Dsignation) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                        <br>
                                    </td>
                                    <td><?= $this->Number->format($devi->total_remise) ?></td>
                                    <td><?= $this->Number->format($devi->total_ht) ?></td>
                                    <td><?= $this->Number->format($devi->total_brute) ?></td>
                                    <td><?= $this->Number->format($devi->total_tva) ?></td>
                                    <td><?= $this->Number->format($devi->total_ttc) ?></td>

                                    <td class="actions text-center">
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $devi->id), array('escape' => false)); ?>
                                        <?php if ($edit == 1) {
                                            echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $devi->id), array('escape' => false));
                                        } ?>
                                        <?php if ($delete == 1) { ?>
                                            <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $devi->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $devi->id)); ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<!-- Include CSS for DataTables -->
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<!-- Include DataTables Scripts -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>

<!-- Initialize DataTables -->
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        $('#example1').DataTable();
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
<?php $this->end(); ?>

<!-- JavaScript for Delete Action -->
<script type="text/javascript">
    $(function() {
        $('.verifiertypecontact').on('click', function() {
            let ind = $(this).attr('index');
            let id = $('#id' + ind).val();

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Typecontacts', 'action' => 'veriftypecontactsup']) ?>",
                dataType: "json",
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data, status, settings) {
                    if (data.Comptes != 0) {
                        alert('existe dans un document');
                    } else {
                        if (confirm('Voulez-vous supprimer cet enregistrement')) {
                            document.location = wr + "Typecontacts/delete/" + id;
                        }
                    }
                }
            });
        });
    });
</script>

