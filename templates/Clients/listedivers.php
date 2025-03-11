<section class="content-header">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</section>

<?php

use Cake\Datasource\ConnectionManager;

echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<style>
    .btn-purple {
        background-color: purple;
        color: white;
    }
</style>
<section class="content-header">
    <header>

        <h1 style="text-align:center;">Listes Client Divérs</h1>

    </header>
</section>






<br><br>

<section class="content" style="width: 99%">
    <div class="box" hidden>
        <div class="box-header">
        </div>
        <div class="box-body">
            <?php echo $this->Form->create($bonlivraisons, ['type' => 'get', 'id' => 'searchForm']); ?>
            <div class="row">

                <div class="col-xs-2">


                    <label class="control-label" for="name">Date début
                    </label>
                    <?php
                    echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>
                </div>
                <div class="col-xs-2">
                    <label class="control-label" for="name">Date fin
                    </label>
                    <?php
                    echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                    ?>
                </div>
                <div class="col-xs-2">
                    <label class="control-label" for="name">Numéro
                    </label>
                    <?php
                    echo $this->Form->input('numero', array('required' => 'off', 'label' => 'Numero', 'value' => $this->request->getQuery('numero'), 'id' => 'num', 'class' => 'form-control '));
                    ?>

                </div>
                <div class="col-xs-2">


                    <label class="control-label" for="name">Code Client
                    </label>
                    <select class="form-control select2" id="idclient" name="client_id">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clients as $id => $client) {
                        ?>

                            <option <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                        echo $client->Code ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="col-xs-2">


                    <label class="control-label" for="name">Nom Client
                    </label>
                    <select class="form-control select2" id="idclient1" name="client_id1">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clients as $id => $client) {
                        ?>

                            <option <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                        echo $client->Raison_Sociale ?></option>
                        <?php } ?>
                    </select>
                </div>




                <?php if ($type == 1) { ?>
                    <div class="col-xs-2">
                        <?php
                        echo $this->Form->control('facturee', ['label' => 'Facturée ', 'options' => $facturations, 'value' => $this->request->getQuery('facturee'), 'class' => ' form-control select2', 'empty' => 'choisir !!']); ?>
                    </div>

                <?php  } ?>
                <div class="col-xs-1">
                    <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                        <i class="fa fa-search"></i>
                    </button>

                </div>
                <?php if ($type == 1) { ?>
                    <?php //if ($count != 0 ){ 
                    ?>
                    <div class="col-xs-1">

                        <button onclick="openWindow(1000, 1000, wr+'bonlivraisons/imprimelistbl?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$client_id; ?>&numero=<?php echo @$numero; ?>&facturee=<?php echo @$facturee; ?>')" class="btn btn-primary" style="margin-top: 25px;">
                            <i class="fa fa-print"></i>
                        </button>
                    </div>
                <?php } ?>

                <?php  //} 
                ?>
                <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                    <?php echo $this->Html->link(__(''), ['action' => 'index', $type], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>

        </div>


    </div>



    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">



                </div>
                <div class="box-body">
                    <div class="box-header pull-right with-border" style="margin-right: 10px;">
                        <?php if ($this->request->getQuery('datedebut') != 0 && $this->request->getQuery('datefin') != 0 && $type == 1) {  ?>
                            <div class="select-all-container" style="margin-right: 10px;">
                                <button type="button" id="select-all" class="btn btn-primary select-all-button" style="background-color: #861C67;border: 1px solid #861C67;">
                                    Sélectionner Tout
                                </button>
                            </div>

                        <?php } ?>
                    </div>
                    <!-- <table width="100%" id="example1" class="table-fixed table table-bordered table-striped" style=' display: block;overflow-x: auto;white-space: nowrap;height:500px'> -->
                    <table width="100%" id="example2" class="table table-bordered table-striped">

                        <thead style='position: sticky;top: 0; background-color: #3c8dbc;'>

                            <tr style="font-size: 16px;">
                                <th width="8%">Nom</th>

                                <th width="12%">Numéro Identité</th>

                                <th width="7%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($bonlivraisons as $i => $bonlivraison) :


                            ?>
                                <tr style="font-size: 16px;background-color: <?php echo $backgroundColor; ?>">

                                    <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $bonlivraison->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>


                                    <td>&nbsp;&nbsp;<?php echo $bonlivraison->numeroidentite ?>
                                        <?php echo $this->Form->control('numeroidentite', ['index' => $i, 'id' => 'numeroidentite' . $i, 'value' => $bonlivraison->numeroidentite, 'label' => '', 'champ' => 'numeroidentite', 'type' => 'hidden', 'class' => 'form-control']); ?>

                                    <td>&nbsp;&nbsp;<?php echo $bonlivraison->nomprenom ?>
                                        <?php echo $this->Form->control('nomprenom', ['index' => $i, 'id' => 'nomprenom' . $i, 'value' => $bonlivraison->nomprenom, 'label' => '', 'champ' => 'nomprenom', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                    </td>




                                    <td>
                                        <div style="display: flex;">
                                            <div style="margin-right: 2px;">
                                                <button
                                                    class="btn btn-xs btn-warning creationclient"
                                                    data-numeroidentite="<?php echo $bonlivraison->numeroidentite; ?>"
                                                    data-nomprenom="<?php echo $bonlivraison->nomprenom; ?>">
                                                    <i class="fa fa-edit"></i> Créer Client
                                                </button>
                                            </div>
                                        </div>
                                    </td>



                                </tr>

                            <?php endforeach; ?>
                        </tbody>

                    </table>
                    <input type="hidden" value="<?php echo $i; ?>" id="index" />

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>





<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
$('.creationclient').on('click', function() {
    var numeroidentite = $(this).data('numeroidentite');
    var nomprenom = $(this).data('nomprenom');

    $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getids']) ?>",
        dataType: "json",
        data: {
            numeroidentite: numeroidentite,
            nomprenom: nomprenom
        },
        success: function(data) {
            alert('Client ajouté avec succès !');
            window.location.href = wr + 'Clients/index';
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

</script>



<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
    $(function() {




        $('#example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
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
<?php $this->end(); ?>