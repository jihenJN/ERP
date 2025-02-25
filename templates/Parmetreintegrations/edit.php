<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>

<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ligneparmetreintegration $ligneparmetreintegration
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Modifier facture 
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>

</ol>
</section>

<section class="content">
<div class="row">
<div class="col-md-12">
    <!-- general form elements -->
    <div class="box ">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
        </div>
        <?php echo $this->Form->create($parmetreintegration, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">

            <div class="box-body">

                <div class="col-xs-6">

                    <label for="">Journal</label>
                    <select name="journal_id" width="200px" id="" class="form-control select2 ">
                        <option value="" selected="selected">Veuillez choisir !!</option>

                        <?php foreach ($journals as $i => $journal) {
                        ?>
                            <option <?php if ($parmetreintegration->journal_id == $journal->id) { ?> selected="selected" <?php } ?> value="<?php echo $journal->id; ?>"><?php echo $journal->name ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <label>Auto</label>
                    <input type="checkbox" name="auto" value="1" class="" style="margin-right: 20px" <?php if ($parmetreintegration->auto == 1) { ?> checked="checked" <?php } ?>>
                </div>

                <div class="col-xs-6">

                </div>

            </div>


            <section class="content-header">
                <h1 class="box-title"> Ligne facture </h1>
            </section>
            <section class="content" style="width: 99%">
                <div class="row">
                    <div class="box">
                        <div class="box-header with-border">
                            <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne66' style="
                            float: right;
                            margin-bottom: 5px;
                            ">
                                <i class="fa fa-plus-circle "></i> Ajouter</a>

                        </div>
                        <div class="panel-body">
                            <div class="table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless" id="tabligne6">
                                    <thead>
                                        <tr width:20px">
                                            <td align="center" style="width: 20%;"><strong>N°compte</strong></td>
                                            <td align="center" style="width: 15%;"> <strong>Libelle</strong> </td>
                                            <td align="center" style="width: 15%;"> <strong>Nature</strong> </td>
                                            <td align="center" style="width: 18%;"> <strong>Equivalence</strong> </td>
                                            <td align="center" style="width: 20%;"> <strong> Champ </strong> </td>
                                            <td align="center" style="width: 7%;"> <strong>Auto</strong></td>
                                            <td align="center" style="width: 5%;"> </td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($lignefactures as $i => $res) :

                                        ?>
                                            <tr>
                                                <td align="center">
                                                    <div style="margin-top:10%">
                                                        <select name="<?php echo "data[lignefac][" . $i . "][ligneplan_id]" ?>" table="lignefac" index="<?php echo $i ?>" class="form-control select2 ">
                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                            <?php foreach ($ligneplans as $k => $lig) {
                                                            ?>
                                                                <option <?php if ($res->ligneplan_id == $lig->id) { ?> selected="selected" <?php } ?> value="<?php echo $lig->id; ?>"><?php echo $lig->code . ' ' . $lig->name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <?php echo $this->Form->input('sup', array('name' => "data[lignefac][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'lignefac', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                    <?php
                                                                    echo $this->Form->input('id', array(
                                                                        'champ' => 'id', 'label' => '', 'name' => 'data[lignefac][' . $i . '][id]',
                                                                        'value' => $res->id,
                                                                        'type' => 'hidden', 'id' => '', 'table' => 'lignefac', 'index' => '', 'div' => 'form-group',
                                                                        'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'
                                                                    ));
                                                                    ?>
                                                </td>

                                                <td align="center">
                                                    <?php echo $this->Form->input('libelle', array('label' => '', 'value' => $res->libelle, 'name' => 'data[lignefac][' . $i . '][libelle]', 'type' => 'text', 'id' => '' . $i, 'table' => 'lignefac', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                </td>
                                                <td align="center">
                                                    <div style="margin-top:10%">
                                                        <select name="<?php echo "data[lignefac][" . $i . "][nature_id]" ?>" table="lignefac" index="<?php echo $i ?>" class="form-control select2 ">
                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                            <?php foreach ($natures as $k => $nat) {
                                                            ?>
                                                                <option <?php if ($res->nature_id == $nat->id) { ?> selected="selected" <?php } ?> value="<?php echo $nat->id; ?>"><?php echo $nat->name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div style="margin-top:10%">
                                                        <select name="<?php echo "data[lignefac][" . $i . "][taxe_id]" ?>" table="lignefac" index="<?php echo $i ?>" class="form-control select2 ">
                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                            <?php foreach ($taxs as $k => $tax) {
                                                            ?>
                                                                <option <?php if ($res->typeexon_id == $tax->id) { ?> selected="selected" <?php } ?> value="<?php echo $tax->id; ?>"><?php echo $tax->name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </td>

                                                <td align="center">
                                                    <div style="margin-top:10%">
                                                        <select name="<?php echo "data[lignefac][" . $i . "][champ_id]" ?>" table="lignefac" index="<?php echo $i ?>" class="form-control select2 ">
                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                            <?php foreach ($champs as $k => $c) {
                                                            ?>
                                                                <option <?php if ($res->champ_id == $c->id) { ?> selected="selected" <?php } ?> value="<?php echo $c->id; ?>"><?php echo $c->name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div style="margin-top:10%">
                                                        <input type="checkbox" name="<?php echo "data[lignefac][" . $i . "][auto]" ?>" table="lignefac"  value="1" class="" style="margin-right: 20px" <?php if ($res->auto == 1) { ?> checked="checked" <?php } ?>>
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <i id="" class="fa fa-times supresponsable66" style="color: #c9302c;font-size: 22px;" index="<?php echo $i ?>"></i>
                                                </td>

                                            </tr>

                                            <tr class='tr' style="display: none ;">
                                                <td align="center">

                                                    <select table="lignefac" index champ="ligneplan_id" class="form-control ">
                                                        <option value="" selected="selected">Veuillez choisir !!</option>
                                                        <?php
                                                        foreach ($ligneplans as $k => $p) {
                                                        ?>
                                                            <option value="<?php echo $p->id; ?>"><?php echo $p->code ?> <?php echo $p->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input table="lignefac" type="hidden" id="" champ="sup" name="" table="Gouvernorat" index="" class="form-control">

                                                </td>

                                                <td> <input table="lignefac" index="" champ="libelle" class="form-control"></td>
                                                <td>

                                                    <select table="lignefac" index champ="nature_id" class="form-control ">
                                                        <option value="" selected="selected">Veuillez choisir !!</option>
                                                        <?php
                                                        foreach ($natures as $k => $n) {
                                                        ?>
                                                            <option value="<?php echo $n->id; ?>"><?php echo $n->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>

                                                    <select table="lignefac" index champ="taxe_id" class="form-control ">
                                                        <option value="" selected="selected">Veuillez choisir !!</option>
                                                        <?php
                                                        foreach ($taxs as $k => $t) {

                                                        ?>
                                                            <option value="<?php echo $t->id; ?>"><?php echo $t->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select table="lignefac" index champ="champ_id" class="form-control ">
                                                        <option value="" selected="selected">Veuillez choisir !!</option>
                                                        <?php
                                                        foreach ($champs as $k => $c) {

                                                        ?>
                                                            <option value="<?php echo $c->id; ?>"><?php echo $c->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td> <input table="lignefac" type="checkbox" champ="auto" value="1"></td>
                                                <td align="center"><i index="" id="" class="fa fa-times supresponsable66" style="color: #C9302C;font-size: 22px;"></td>
                                            <?php endforeach; ?>
                                            </tr>


                                    </tbody>
                                </table>
                                <input type="hidden" value="<?php echo $i ?>" id="indexgv" >

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div align="center">
            <button type="submit" class="pull-right btn btn-success " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
</div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<script>
$(function() {
//Initialize Select2 Elements
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
//Date range as a button
$('#daterange-btn').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    },
    function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
)

//Date picker
$('#datepicker').datepicker({
    autoclose: true
})

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
})
//Red color scheme for iCheck
$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass: 'iradio_minimal-red'
})
//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})

//Colorpicker
$('.my-colorpicker1').colorpicker()
//color picker with addon
$('.my-colorpicker2').colorpicker()

//Timepicker
$('.timepicker').timepicker({
    showInputs: false
})
})
</script>


<?php $this->end(); ?>