<?php
echo $this->Html->css('select2');

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
?>
<style>
    /* Define your table border style here */
    #example1 {
        border-collapse: collapse;
        /* Collapse borders to avoid double borders */
        border: 2px solid #000;
        /* Example: 2px solid black border */
    }

    #example1 th,
    #example1 td {
        border: 1px solid #000;
        /* Example: 1px solid black border for table cells */
        padding: 8px;
        /* Adjust cell padding as needed */
    }
</style>
<section class="content-header">
    <header>
        <h1 style="text-align:center;"> ETAT DE DETAIL de STOCK </h1>
    </header>
</section>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <?php echo $this->Form->create($stockdepots, ['type' => 'get']);
                ?>
                <div class="row">
                    <div class="col-xs-6">
                        <label>Articles</label>
                        <select class="form-control select2" name="article_id" id="article_id" value='<?php $this->request->getQuery('article_id') ?>'>
                            <option value="" selected="selected">Veuillez choisir !!</option>
                            <?php foreach ($articles as $j => $art) {
                            ?>
                                <option <?php if ($art->id == $articleid) { ?> selected="selected" <?php } ?> value="<?php echo $art->id; ?>"><?php echo $art->Code . ' ' . $art->Dsignation ?></option>
                            <?php } ?>

                        </select>
                    </div>


                    <div class="col-xs-6">
                        <?php echo $this->Form->control('depot_id', ['label' => 'Depot ', 'options' => $depots, 'id' => 'depot_id', 'name' => 'depot_id', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ', 'value' => 6]); ?>

                        <!-- <label>Dépots</label>
                        <select class="form-control select2" name="depot_id" id="depot_id" value='<?php $this->request->getQuery('depot_id') ?>'>
                            <option value="" selected="selected">Veuillez choisir !!</option>
                            <?php foreach ($depots as $j => $dep) {
                            ?>
                                <option <?php if ($dep->id == $depotid) { ?> selected="selected" <?php } ?> value="<?php echo $dep->id; ?>"><?php echo $dep->name ?></option>
                            <?php } ?>

                        </select> -->
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-xs-6">
                        <label> Familles </label>
                        <select name="famille_id" id="famille_id" class="form-control select2" value='<?php $this->request->getQuery('famille_id') ?>'>
                            <option value="" selected="selected">Veuillez choisir !! </option>
                            <?php foreach ($familles as $i => $fa) {
                            ?>
                                <option <?php if ($fa->id == $famille_id) { ?> selected="selected" <?php } ?> value="<?php echo $fa->id; ?>"><?php echo $fa->Nom ?></option>
                            <?php } ?>

                        </select>
                    </div>

                </div>
                <br><br>

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary" id="">Afficher</button>
                        <?php
                        // debug($depotalls);
                        if ($depotalls != null || $articless != null) {
                        ?>
                            <a onClick="openWindow(1000, 1000, wr+'Stockdepots/impdep?article_id=<?php echo @$articleid; ?>&depot_id=<?php echo @$depotid; ?>&famille_id=<?php echo @$famille_id; ?>')"><button class="btn btn-primary ">Imprimer</button></a>
                        <?php }  ?>
                        <?php echo $this->Html->link(__('Actualiser'), ['action' => '/indexpardepot'], ['class' => 'btn btn-primary ']) ?>




                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<br><input type="hidden" id="page" value="1" />
<h3 style="margin-left: 5px ;">
    Stock depots
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- <div class="ls-editable-table table-responsive ls-table"> -->

                <table class="table table-bordered table-striped table-bottomless" id="example1" border="1">
                    <thead>
                        <tr>
                            <td style="font-size: 14px; "><strong>Depot</strong></td>
                            <?php foreach ($depotalls as $depot) : ?>
                                <td style="font-size: 14px; " colspan="4"><strong><?php echo $depot['name']; ?></strong></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr style=" background-color: #a9a9a9; color: #000000 ; font-style: italic;font-weight: bold;">


                            <td style="font-size: 14px; "colspan="2" align="center">Article</td>

                            <td style="font-size: 14px; " colspan="3" align="center">Quantité</td>
                        </tr>
                        <tr style=" background-color: #add8e6; color: #0000ff; font-style: italic;font-weight: bold;">


                            <td style="font-size: 14px; "align="center">Code</td>

                            <td style="font-size: 14px; " align="center">Désignation</td>
                            <td style="font-size: 14px; "width="14%" align="center">Stock</td>

                            <td style="font-size: 14px; " width="14%" align="center">Réserver</td>
                            <td style="font-size: 14px; " width="12%" align="center">Total</td>

                        </tr>
                    </thead>
                    <tbody>

                        <?php $totalGeneral = 0;
                        $ttfam = 0;
                        foreach ($familles as $famille) :
                            $totalFamille = 0;
                            $familleExist = false;
                            $total = 0;
                            $final = 0;
                            $ss=0;
                            $qtecom=0;
                            
                            ?>

                            <?php foreach ($articless as $stockdepot) : ?>
                                <?php if ($stockdepot['famille_id'] == $famille->id) :
                                    $familleExist = true;
                                    $connection = ConnectionManager::get('default');

                                    $commander = "SELECT SUM(ligne.qte) AS total_qte FROM lignecommandes AS ligne
                                     INNER JOIN commandes AS bc ON bc.id = ligne.commande_id
                                     WHERE ligne.article_id = " . $stockdepot['id'] . "
                                     AND bc.depot_id = " . $depotid . "
                                     AND bc.bonlivraison_id = 0";
                                    $result = $connection->execute($commander)->fetchAll('assoc');
                                    if ($result[0]['total_qte'] != 0) {
                                        $qtecom = $result[0]['total_qte'];
                                        $ss=$ss + $result[0]['total_qte'];
                                    } else {
                                        $qtecom = 0;
                                        $ss = 0 ;
                                    }
                                ?>
                                    <tr style="background-color: <?php echo ($qtecom != 0) ? '#D2FFD2' : 'transparent'; ?>">
                                        <td style="font-size: 16px;"><?php echo $stockdepot['Code']; ?></td>
                                        <td style="font-size: 16px;"><?php echo $stockdepot['Dsignation']; ?></td>
                                        <?php
                                       
                                        date_default_timezone_set('Africa/Tunis');
                                        $datef = date('Y-m-d H:i:s');
                                        $date1 = date("Y") . '-01-01' . date(" 00:00:00");
                                        $connection = ConnectionManager::get('default');
                                        $st = $connection->execute("select stockbassem(" . $stockdepot['id'] . ",'" . $datef . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                        if (!empty($st)) {

                                            $totalFamille += $st[0]['v'];
                                            $totalGeneral += $st[0]['v'];

                                            $ttfam =  $totalFamille - $ss  ;

                                            $qtestock=  $st[0]['v'];
                                            $total =  $st[0]['v'] - $qtecom;
                                            $final =  $final + $total;
                                        } else {
                                            $qtestock = 0;
                                            $total = 0;
                                            $final = 0;
                                            $ttfam = 0;
                                        }
                                        // $commander = "SELECT SUM(ligne.qte) AS total_qte FROM lignecommandes AS ligne
                                        // INNER JOIN commandes AS bc ON bc.id = ligne.commande_id
                                        // WHERE ligne.article_id = " . $stockdepot['id'] . "
                                        // AND bc.depot_id = " . $depotid . "
                                        // AND bc.bonlivraison_id = 0";
                                        // $result = $connection->execute($commander)->fetchAll('assoc');
                                        // if ($commander) {
                                        //     $qtecom = $result[0]['total_qte'];
                                        // } else {
                                        //     $qtecom = 0;
                                        // }


                                        ?>
                                        <td align="center" style="font-size: 16px; font-weight: bold;">
                                            <a href='/ERP/Articles/indexspec?date1=<?php echo @$date1; ?>&date2=<?php echo @$datef; ?>&depot_id=<?php echo @$depotid; ?>&article_id=<?php echo $stockdepot['id']; ?>' target="_blank">
                                                <?php echo $qtestock; ?>
                                            </a>
                                        </td>
                                        <td align="center" style="font-size: 16px; font-weight: bold;">
                                            <?php echo $qtecom; ?>
                                        </td>
                                        <td align="center" style="font-size: 16px; font-weight: bold;">
                                            <?php echo $total; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if ($familleExist) { ?>
                                <tr style=" background-color: #FFBDBD; color: #b22222;">
                                    <td><strong><?php //echo $famille->Nom; 
                                                ?></strong></td>

                                    <td><strong><?php echo $famille->Nom . ' ' . '==============>'; ?></strong></td>
                                    <td align="center" style="font-size: 16px;"><strong><?php echo $totalFamille; ?></strong></td>
                                    <td><strong><?php //echo $famille->Nom; 
                                                ?></strong></td>
                                    <td align="center" style="font-size: 16px;"><strong><?php echo $ttfam ?></strong></td>



                                </tr>
                            <?php } ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>


                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

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
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

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


    $(function() {
        $('#example2').DataTable()
        $('#example1').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
</script>


<script>
    // $(function() {



    //     $('.alertdep').on('mouseover', function() {

    //         depot = $('#depot_id').val();
    //         article = $('#article_id').val();
    //         ///  client = $('#client_id').val();
    //         if (depot == '') {
    //             alert("Veuillez choisir un dépot SVP  !!")
    //         }
    //         //  else if (article == '') {
    //         //     alert("Veuillez choisir un article SVP  !!")
    //         // }


    //     });
    // })
</script>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>