<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>



<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Sous famille 1
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($sousfamille1, ['role' => 'form']); ?>

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('famille_id', ['options' => $familles, 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control commercial']); ?> </div>
                        <div class="col-xs-6" hidden>
                            <?php echo $this->Form->control('code', ['label' => 'Code']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('name', ['label' => 'Nom']); ?>
                        </div>


                        <div class="col-xs-6" style="margin-top: 25px ; margin-right : 25px;" hidden>
                            <label class="control-label" for="unite-id" style="margin-right: 20px"> Obligatoire</label>

                            Oui <input type="radio" name="obligatoire" value="1" id="active" class="choixcollisage" style="margin-right: 20px">
                            Non <input type="radio" name="obligatoire" value="0" id="desactive" class="choixcollisage" checked="checked">



                        </div>


                        <div class="col-xs-6" style="margin-top: 25px ; margin-right : 25px;" hidden>
                            <label class="control-label" for="sanscalcul" style="margin-right: 20px"> Sans calcul (statistique Vente)</label>

                            Oui <input type="radio" name="sanscalcul" value="1" id="active1" class="choixcollisage1" style="margin-right: 20px">
                            Non <input type="radio" name="sanscalcul" value="0" id="desactive1" class="choixcollisage1" checked="checked">



                        </div>

                        <div class="col-xs-6" style="margin-top: 25px ; margin-right : 25px;" hidden>
                            <label class="control-label" for="unite-id" style="margin-right: 20px">Remise Obligatoire</label>

                            Oui <input type="radio" name="remiseobligatoire" value="1" id="active2" class="choixcollisage2" style="margin-right: 20px" checked="checked">
                            Non <input type="radio" name="remiseobligatoire" value="0" id="desactive2" class="choixcollisage2">



                        </div>

                    </div>



                    <button type="submit" class="pull-right btn btn-success btn-sm" id="enr0" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- /.box-body -->


            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>




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

        $("form").submit(function() {
            $('#enr0').attr('disabled', 'disabled');
        })
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
<?php
$this->end();
