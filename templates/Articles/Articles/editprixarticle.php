<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('ajouterlignematrice'); ?>
<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <br>
        Changement prix par famille / Sous famille
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?>
            </a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php
                echo $this->Form->create($article, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]);
                /// debug ($article);
                // die;
                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('famille_id', ['label' => 'Famille', 'empty' => 'Veuillez choisir SVP !!', 'options' => $familles, 'id' => 'famille_id', 'class' => 'form-control select2 control-label getPrixht famille', 'required' => false]); ?>
                                </div>
                                <div class="col-xs-6" id="listSF">
                                    <?php echo $this->Form->control('sousfamille1_id', ['label' => 'Sous Famille', 'empty' => 'Veuillez choisir SVP !!', 'class' => 'form-control control-label select2 sousfamille', 'id' => 'sousfamille1_id', 'required' => false]); ?>
                                </div>
                                <div class="col-xs-12">
                                </div>
                                <div class="col-xs-6">
                                    <label> Prix hors taxe</label>
                                    <input placeholder="0.000" step="0.001" type="number"
                                        class="form-control calculprixarticle" name='Prix_LastInput'
                                        id="Prix_LastInput">
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('tva_id', ['label' => 'Tva', 'empty' => 'Veuillez choisir SVP !!', 'options' => $tvas, 'id' => 'tva_id', 'class' => 'form-control select2 control-label', 'required' => false]); ?>
                                </div>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
                <div align="center">
                    <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'ajouarticle']); ?>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $(function () {

            $('.famille').on('change', function () {
                // alert('hello');
                id = $('#famille_id').val();
                // alert(id)
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getInfoFamille']) ?>",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function (data) {
                        // alert(data.select);
                        $('#Prix_LastInput').val(data.prixht);
                        $('#listSF').html(data.select);
                        $('#sousfamille1_id').select2();
                    }
                })
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(function () {

            $('.famille').on('change', function () {
                // alert('hello');
                id = $('#famille_id').val();
                var Nouvelleprix = $('#Prix_LastInput').val();
                tva = $('#tva_id').val();
                // alert(id)
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'editprixarticle']) ?>",
                    dataType: "json",
                    data: {
                        id: id,
                        Nouvelleprix: Nouvelleprix
                        tva: tva
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function (data) {

                    }
                })
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('change', '.sousfamille', function () {
            alert('hello');
            id = $('#sousfamille1_id').val();
            Nouvelleprix = $('#Prix_LastInput').val();
            tva = $('#tva_id').val();
            // alert(Nouvelleprix)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'editprixarticle1']) ?>",
                dataType: "json",
                data: {
                    id: id,
                    Nouvelleprix: Nouvelleprix
                    tva: tva
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {

                }
            })
        });

    });
</script>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function () {
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
<?php $this->end(); ?>