<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php
//echo $this->Html->script('salma');
?>

<?php
//phpinfo();
?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
    <header>
        <h1 style="text-align:center;">Clients</h1>
    </header>
</section>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_clients' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
    if (@$liens['lien'] == 'clients') {
        $add = $liens['ajout'];
        $edit = $liens['modif'];
        $delete = $liens['supp'];
    }
    //debug($liens);die;
}


if ($add == 1) { ?>
    <div class="pull-left" style="margin-left:25px;margin-top: 20px">
        <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
    </div>
<?php } ?>
<br> <br><br>





<section class="content-header">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
    <h1>
        Recherche
    </h1>
</section>
<section class="content" style="width: 99%" style="background-color: white ;">
    <div class="box">
        <div class="box-body">
            <?php echo $this->Form->create($clients, ['id' => 'searchForm', 'type' => 'get']); ?>

            <div class="row">

                <div class="col-xs-3">
                    <label class="control-label" for="name">Code Client</label>
                    <select class="form-control select2" id="idclient" name="client_id">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clientOptionsCode as $id => $Code) { ?>
                            <option value="<?php echo h($id); ?>" <?php echo $this->request->getQuery('client_id') == $id ? 'selected="selected"' : ''; ?>>
                                <?php echo h($Code); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-xs-3">
                    <label class="control-label" for="name">Nom Client</label>
                    <select class="form-control select2" id="idclient1" name="client_id1">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($clientOptionsRaison as $id => $Raison_Sociale) { ?>
                            <option value="<?php echo h($id); ?>" <?php echo $this->request->getQuery('client_id1') == $id ? 'selected="selected"' : ''; ?>>
                                <?php echo h($Raison_Sociale); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>




                <div class="col-xs-1">
                    <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
                        <i class="fa fa-search"></i>
                    </button>

                </div>
                <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
                    <?php echo $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
                </div>

                <?php echo $this->Form->end(); ?>



            </div>
        </div>
    </div>
</section>
<section class="content-header">
    <h1>
        Clients
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo ('Code'); ?></th>


                                <th><?php echo ('Raison Sociale'); ?></th>






                                <th><?php echo ('Tel'); ?></th>



                                <!-- <th><?php echo ('Fax'); ?></th> -->

                                <th><?php echo ('Email'); ?></th>



                                <th><?php echo ('Matricule Fiscale'); ?></th>




                                <th class="actions" align="center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientslist as $i => $client) :
                                /// debug($client);
                            ?>
                                <tr>
                                    <td>


                                        <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $client->id, 'label' => '', 'type' => 'hidden', 'champ' => 'id', 'class' => 'form-control']); ?>




                                        <?php echo h($client->Code); ?>
                                    </td>
                                    <td><?php echo h($client->Raison_Sociale); ?></td>
                                    <td><?php echo h($client->Tel); ?></td>

                                    <td><?php echo h($client->Email); ?></td>



                                    <td><?php echo h($client->Matricule_Fiscale); ?></td>


                                    <td align="center">
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $client->id), array('escape' => false)); ?>
                                        <?php if ($edit == 1) {
                                            echo $this->Html->link("<button class='btn btn-xs btn-warning '><i class='fa fa-edit'></i></button>", array('action' => 'edit', $client->id), array('escape' => false));
                                        } ?>
                                        <?php //echo $this->Form->postLink("<button class='btn btn-xs btn-danger verifiercmd ' index=$i><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $client->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # %s?', $client->id));
                                        if ($delete == 1 && $client->Code != '41199999') { ?>

                                            <button index='<?php echo $i ?>' class='verifiercmd btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>

                                        <?php } ?>
                                        <?php echo $this->Html->Link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprime', $client->id), array('escape' => false)); ?>


                                    </td>
                                </tr>
                            <?php endforeach; ?>






                        </tbody>
                    </table>
                    <input type="hidden" value="<?php echo $i ?>" id="index">

                    <table>

                        <tr>
                            <td align="center">

                                <div class="col-md-12  testcheck" style="display:none;">
                                    <input type="hidden" name="tes" value="0" class="tespv" />
                                    <input type="hidden" name="tes" value="0" class="tes" />
                                    <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                    <a class="btn btn btn-danger btnbl" id="bonliv"> <i class="fa fa-plus-circle"></i> Créer un bon de transferts </a>
                                </div>

                            </td>

                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
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
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }











    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': true
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








<script type="text/javascript">
    $(document).ready(function() {

        $('#idclient1').change(function() {
            var selectedcodename = $(this).val();
            $("#idclient").select2('destroy');
            $("#idclient").val(selectedcodename);
            $("#idclient").select2();

        });
        $('#idclient').change(function() {
            var selectedcodename = $(this).val();
            $("#idclient1").select2('destroy');
            $("#idclient1").val(selectedcodename);
            $("#idclient1").select2();

        });
    });
    $(function() {
        $('.verifiercmd').on('click', function() {
            // alert('hello');
            ind = $(this).attr('index');
            //  alert(ind);
            clientId = $('#id' + ind).val();
            //  alert(id);
            //  alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getclientcmd']) ?>",
                dataType: "json",
                data: {
                    clientid: clientId
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    //   $('#pays').html(data.pays);
                    //  alert(data.pays);


                    if (data.clients != 0) {
                        alert("Existe dans un autre document");

                    } else {
                        if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
                            document.location = wr + "clients/delete/" + clientId;
                        }
                    }
                }
            })
        });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner les éléments du formulaire et initialiser Select2

        const clientcIdSelect = $('#idclient');
        const clientnIdSelect = $('#idclient1');

        const searchForm = document.getElementById('searchForm');

        console.log('DOM entièrement chargé');

        // Initialiser Select2 sur les dropdowns
        clientcIdSelect.select2();
        clientnIdSelect.select2();

        // Fonction pour soumettre le formulaire
        function submitForm() {
            searchForm.submit();
        }

        // Écouteur d'événements pour les changements sur les dropdowns clients
        clientcIdSelect.on('change', function() {
            clientnIdSelect.val(clientcIdSelect.val()).trigger('change.select2');
        });

        clientnIdSelect.on('change', function() {
            clientcIdSelect.val(clientnIdSelect.val()).trigger('change.select2');
        });

        // Écouteur d'événements pour soumettre le formulaire lors de la pression sur Entrée
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const activeElement = document.activeElement;

                // Vérifier si l'élément actif est l'un des éléments spécifiés ou un champ Select2
                if (

                    $(activeElement).hasClass('select2-search__field') || // Champ de recherche Select2
                    $(activeElement).closest('.select2-container').length // Conteneur Select2
                ) {
                    return; // Permettre le comportement par défaut si le focus est sur ces éléments
                }

                // Empêcher le comportement par défaut de la touche Entrée et soumettre le formulaire
                e.preventDefault();
                submitForm();
            }
        });
    });
</script>