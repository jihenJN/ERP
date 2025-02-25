<?php

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default');

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl5+z0I5t9z5lFf0N6lT3kgVxFz1v4UahKLi9nS/jEeb/8inxQdjb8lfWAVI6ubRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Liste des factures clients</h1>
    </header>
</section>
<br> <br><br><br><br>
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<?php echo $this->Form->create(null, ['type' => 'get']); ?>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <div class="row">
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->input('historiquede', [
                                'required' => 'off',
                                'label' => 'Date début',
                                'value' => $this->request->getQuery('historiquede'),
                                'id' => 'historiquede',
                                'div' => 'form-group',
                                'class' => 'form-control',
                                'type' => 'date',
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->input('au', [
                                'required' => 'off',
                                'label' => 'Date fin',
                                'value' => $this->request->getQuery('au'),
                                'id' => 'au',
                                'div' => 'form-group',
                                'class' => 'form-control',
                                'type' => 'date',
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('client_id', [
                                'label' => 'Client',
                                'value' => $this->request->getQuery('client_id'),
                                'required' => 'off',
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 getcaisseName',
                                'style' => 'text-align:right',
                                'type' => 'select',
                                'options' => $clients

                            ]);
                            ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('article_id', [
                                'label' => 'Articles',
                                'value' => $this->request->getQuery('article_id'),
                                'required' => 'off',
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 getcaisseName',
                                'style' => 'text-align:right',
                                'type' => 'select',
                                'options' => $articles

                            ]);
                            ?>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group input text required">
                                <?php echo $this->Form->control('depot_id', ['value' => $this->request->getQuery('depot_id'), 'options' => $depots, 'name' => 'depot_id', 'label' => 'Depot', 'class' => 'form-control select2', 'empty' => 'Veuillez choisir !!']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align:center">
                <button type="submit" style="background-color:#4DAAA5;" class="btn btn-success btn-sm getcaisseName1">Afficher</button>
                <a onclick="openWindow(1000, 1000, 'https://sirepprefaprod.isofterp.com/ERP/factureclients/imprimelistefactureclient?historiquede=<?php echo @$historiquede; ?>&au=<?php echo @$au; ?>&client_id=<?php echo @$this->request->getQuery('client_id'); ?>&depot_id=<?php echo @$this->request->getQuery('depot_id'); ?>&article_id=<?php echo @$this->request->getQuery('article_id'); ?>')" class="btn btn-sm btn-success" style="background-color:#8D6991;">
                    <i class='fa fa-print'></i>
                </a>
                <!-- <a onclick="openWindow(1000, 1000, 'https://sirepprefaprod.isofterp.com/ERP/factureclients/imprimelistefactureclient?historiquede=<?php echo @$historiquede; ?>&au=<?php echo @$au; ?>&client_id=<?php echo @$this->request->getQuery('client_id'); ?>&commercial_id=<?php echo @$this->request->getQuery('commercial_id'); ?>&depot_id=<?php echo @$this->request->getQuery('depot_id'); ?>')"
                    class="btn btn-sm btn-success">
                    <i class='fa fa-file-excel-o'></i> 
                </a> -->
                <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Actualiser', ['action' => 'listefactureclient'], ['class' => 'btn btn-primary btn-sm', 'style' => 'background-color:#4DAAA5;', 'escape' => false]) ?>
            </div>
        </div>
    </div>
</section>
<?php echo $this->Form->end(); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Les factures <span id="nameofcaisse"></span></h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr style='background-color:#4DAAA5;'>
                                <th hidden style="text-align: center;">id</th>
                                <th width="10%" style="text-align: center;">N°</th>
                                <th width="10%" style="text-align: center;">Date</th>
                                <th width="16%" style="text-align: center;">client</th>

                                <th width="9%" style="text-align: center;">TotalHt</th>
                                <th width="9%" style="text-align: center;">Totalttc</th>
                                <!-- <th width="10%" style="text-align: center;">Commercial</th> -->
                                <th width="10%" style="text-align: center;">Dépot</th>

                                <!-- <th style="text-align: center;">Date</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalht = 0;
                            $totalttc = 0;
                            foreach ($factureclients as $i => $facture) :
                                $query = 'SELECT SUM( lignefactureclients.qte*lignefactureclients.ml*lignefactureclients.punht - lignefactureclients.qte*lignefactureclients.ml*lignefactureclients.punht* COALESCE(lignefactureclients.remise, 0)/100 ) AS total_prixht, SUM(lignefactureclients.ttc) AS total_ttc
                              
                                FROM lignefactureclients
                                JOIN articles ON lignefactureclients.article_id = articles.id
                                JOIN sousfamille1s ON articles.sousfamille1_id = sousfamille1s.id
                                WHERE lignefactureclients.factureclient_id = ' . $facture['id'] . '
                                  AND sousfamille1s.sanscalcul = 0;';

                                $lignesde = $connection->execute($query)->fetchAll('assoc');
                                // debug($lignesde);
                                $totalttc += $lignesde[0]['total_ttc'];
                                $totalht += $lignesde[0]['total_prixht'];
                            ?>
                                <tr>
                                    <td hidden></td>
                                    <td align="center">
                                        <?= h($facture['numero']) ?>
                                    </td>
                                    <td align="center">
                                        <?= h($this->Time->format($facture['date'], 'dd/MM/y')) ?>
                                    </td>
                                    <td align="center">
                                        <?= h($facture['client']['Raison_Sociale']) ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        echo sprintf("%01.3f", ($lignesde[0]['total_prixht']))  ?>
                                    </td>
                                    <td align="center">
                                        <?php echo sprintf("%01.3f", ($lignesde[0]['total_ttc'])) ?>

                                    </td>
                                    <td align="center">
                                        <?= h($facture['depot']['name']) ?>
                                    </td>
                                    <!-- <td class="actions text" align="center">
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-file-excel-o'></i></button>", array('action' => 'view', $facture->id), array('escape' => false)); ?>
                                        <?php echo $this->Html->Link("<button class='btn btn-xs btn-warning'><i class='fa  fa-print'></i></button>", array('action' => 'imprime', $facture->id), array('escape' => false)); ?>
                                    </td> -->
                                </tr>
                            <?php endforeach; ?>
                            <tr class="total-row">
                                <td hidden></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="2" style="width: 100%;">
                                    <table style="width: 100%;">
                                        <tr style='background-color:#4DAAA5;'>
                                            <th colspan="2" style="text-align: center;">Total Période :</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background" style="width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $totalht) ?>" disabled>
                                            </td>
                                            <td style="width: 50%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background" style="width: 100%;"
                                                    value="<?php echo sprintf("%01.3f",$totalttc)  ?>" disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td></td>
                                <!-- <td></td> -->
                            </tr>
                        </tbody>
                    </table>

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
<style>
    .btn-purple {
        background-color: purple;
        color: white;
    }

    .center-text {
        text-align: center;
    }

    .gray-background {
        background-color: #ECE5DF;
    }
</style>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
    $(function() {
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
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

<script>
    $(".getcaisseName1").on("click", function() {
        getcaisseName();
    });
    $(".getcaisseName").on("change", function() {
        // alert();
        getcaisseName();
    });

    function getcaisseName(id) {
        // alert();
        caisse_id = $("#caisse_id").val();
        if (caisse_id != "") {
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getcaisseName']) ?>",
                dataType: "json",
                data: {
                    caisse_id: caisse_id,
                },
                headers: {
                    "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                },
                success: function(data) {
                    $('#nameofcaisse').text(data.name);
                    // alert(data.name);
                },
            });
        } else {
            $('#nameofcaisse').text("");
        }
    }
</script>
<?php $this->end(); ?>