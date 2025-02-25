<?php

use Cake\Datasource\ConnectionManager;

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl5+z0I5t9z5lFf0N6lT3kgVxFz1v4UahKLi9nS/jEeb/8inxQdjb8lfWAVI6ubRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Depenses </h1>
    </header>
</section>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<br> <br><br><br><br>
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<?php echo $this->Form->create($depenses, ['type' => 'get']); ?>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <div class="row">
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-4">
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
                        <div class="col-xs-4">
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
                        <div class="col-xs-4">
                            <?php
                            echo $this->Form->control('caisse_id', [
                                'label' => 'Caisses',
                                'value' => $this->request->getQuery('caisse_id'),
                                'required' => 'off',
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'style' => 'text-align:right',
                                'type' => 'select',
                                'options' => $caisses

                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align:center">
                <button type="submit" style="background-color:#515DF9;" class="btn btn-success btn-sm getcaisseName1">Afficher</button>
                <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Actualiser', ['action' => 'index'], ['class' => 'btn btn-primary btn-sm', 'style' => 'background-color:#515DF9;', 'escape' => false]) ?>
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
                    <h3 class="box-title">Depenses <span id="nameofcaisse"></span></h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr style='background-color:#515DF9;'>
                                <th hidden style="text-align: center;">id</th>
                                <th  style="text-align: center;">Numero</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">caisse</th>
                                <!-- <th style="text-align: center;">solde</th> -->
                                <th style="text-align: center;">montant</th>
                                <th style="text-align: center;">mode paiement</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $testadmin = false;
                            if ($countcaisses == $countusercaisses) {
                                $testadmin = true;
                            }
                            // print_r($testadmin);


                            foreach ($depenses as $i => $depense) :
                                $caisse_id = $depense->caisse_id;
                                $paiement_id = $depense->paiement_id;
                                // debug($caisse_id);
                                // debug($paiement_id);
                                $connection = ConnectionManager::get('default');
                                $caisse_name = [];
                                if ($caisse_id != null) {
                                    $caisse_name = $connection->execute('SELECT name FROM caisses WHERE id = ' . $caisse_id . '  ;')->fetchAll('assoc');
                                }
                                $modepaiement = $connection->execute('SELECT name FROM paiements WHERE id = ' . $paiement_id . '  ;')->fetchAll('assoc');


                                $caisseExists = false;
                                foreach ($usercaisses as $usercaisse) {
                                    if ($usercaisse->caisse_id == $caisse_id) {
                                        $caisseExists = true;
                                        break;
                                    }
                                }

                                if  ($testadmin) {
                                    $caisseExists=true;
                                }
                                if ($caisseExists) {
                            ?>
                                    <tr>
                                        <td hidden></td>
                                        <td align="center">
                                            <?= h($depense['numero']) ?>
                                        </td>
                                        <td align="center">
                                            <?= h($this->Time->format($depense['date'], 'dd/MM/y')) ?>
                                        </td>
                                        <td align="center">
                                            <?= h($caisse_name[0]['name']) ?>
                                        </td>
                                        <!-- <td align="center">
                                        <?= h($depense['solde']) ?>
                                    </td> -->
                                        <td align="center">
                                            <?= h($depense['montant']) ?>
                                        </td>
                                        <td align="center">
                                            <?= h($modepaiement[0]['name']) ?>
                                        </td>
                                        <td class="actions text" align="center">
                                        <?php if ($depense->paiement_id == 2) : ?>
                                            <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimstb/' . $depense->id), array('escape' => false)); ?>
                                        <?php elseif ($depense->paiement_id == 3) : ?>
                                            <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimtr/' . $depense->id), array('escape' => false)); ?>
                                        <?php elseif ($depense->paiement_id == 4) : ?>
                                            <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimvir/' . $depense->id), array('escape' => false)); ?>
                                        <?php elseif ($depense->paiement_id == 5) : ?>
                                            <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimret/' . $depense->id), array('escape' => false)); ?>
                                        <?php endif; ?>
                                            <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view/' . $depense->id), array('escape' => false)); ?>
                                            <?php echo $this->Html->Link("<button class='btn btn-xs btn-warning'><i class='fa  fa-edit'></i></button>", array('action' => 'edit/', $depense->id), array('escape' => false)); ?>
                                            <?php echo $this->Form->postLink("<button class='deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete/' . $depense->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $depense->id)); ?>
                                    
                                       
                                     
                                    </td>

                                    </tr>
                            <?php }
                            endforeach;
                            ?>
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
<style>
    /* Style du bouton */
    .excel-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        /* Couleur de fond du bouton (vert ici) */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    /* Style de l'icône */
    .excel-icon {
        margin-right: 8px;
        /* Marge à droite de l'icône pour l'espacement */
    }

    table {
        width: 200%;
        /* Make the table take up the full width */
        table-layout: fixed;
        /* Fix the table layout */
    }

    th,
    td {
        width: 175px;
        /* Set a fixed width for the cells */
        text-align: center;
    }

    .total-row th {
        width: 100%;
        /* Set full width for the total row header cell */
    }

    .total-row td {
        width: 100%;
        /* Set full width for the total row data cell */
    }
</style>
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