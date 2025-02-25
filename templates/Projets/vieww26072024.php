<?php
error_reporting(E_ERROR | E_PARSE);

use Cake\Datasource\ConnectionManager;


/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */

use App\Utils\FrozenTime;
?>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('js_vieww_projet'); ?>
<?php echo $this->Html->script('dhouha'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('select2');

echo $this->Html->css('vieww');
$session = $this->request->getSession();

if ($com != null) {
    
    echo "<style>
    #offreggb{display: block !important;}
    #projets{display:none !important;}
</style>";
    $act = 'active';
    $act2 = '';
    $type="hidden";
    $type2="";
   

} else {
   
    $act = '';
    $act2 = '';
    $type="";
    $type2="hidden";
}
?>
<?= $style ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <div class="choisir" align="center" style="margin-left:50px; margin-top:20px;">
                    <button type="button" id='projetsbtn' style="width: 10%;" class="btn btn-primary btn-sm  <?= $act2 ?>">Vue d'ensemble</button>
                    <!-- <button type="button" id='tacheprojet' style="width: 10%;" class="btn btn-primary btn-sm">Taches</button> -->
                    <button type="button" id='tempsconsommebtn' style="width: 10%;" class="btn btn-primary btn-sm">Temps Consommé</button>
                    <button type="button" id='notebtn' style="width: 10%;" class="btn btn-primary btn-sm">Notes</button>
                    <button type="button" id='demandeoffredeprixbtn' style="width: 10%;" class="deduction btn btn-primary btn-sm">Demande offre</button>
                    <button type="button" id='commandefournisseurbtn' style="width: 15%;" class="deduction btn btn-primary btn-sm">Commande Fournisseur</button>
                    <button type="button" id='offreggbbtn' style="width: 10%;" class="btn btn-primary btn-sm <?= $act ?>">Offre GGB</button>

                    <!-- <button type="button" id='contactprojet' style="width: 10%;" class="btn btn-primary btn-sm">Contacts du Projet</button> -->
                    <!--       <button type="button" id='vueensemble' style="width: 10%;" class="btn btn-primary btn-sm">Vue d'ensemble</button>
          <button type="button" id='fichierjoint' style="width: 10%;" class="btn btn-primary btn-sm">Fichiers Joints</button> -->
                    <!-- <button type="button" id='factureclientbtn' style="width: 14%;" class="btn btn-primary btn-sm">Facture Client</button> -->
                </div>
                <div class="column-responsive column-120">
                    <div class="box" style="margin-left: 10px;width: 98%;margin-top: 50px;background-color:#f3f4f7;">
                        <div class="box-body">
                            <?php include('detailprojet.php'); ?>
                            <?php include('offreggb.php'); ?>
                            <?php include('commandefournisseur.php'); ?>
                            <!-- < ?php include('tache.php'); ?> -->
                            <?php include('tempsconsomme.php'); ?>
                            <?php include('note.php'); ?>
                            <?php include('demandeoffre.php'); ?>
                        </div>
                    </div>
                </div>
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