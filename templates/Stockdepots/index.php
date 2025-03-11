<?php

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;


echo $this->Html->css('select2');

$wr =  $this->Url->build('/', ['fullBase' => true]);
?>
<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Stock depots</h1>
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

                    <!-- <div class="col-xs-6">
                        <label> Familles </label>
                        <select name="famille_id" id="famille_id" class="form-control select2" value='<?php $this->request->getQuery('famille_id') ?>'>
                            <option value="" selected="selected">Veuillez choisir !! </option>
                            <?php foreach ($familles as $i => $fa) {
                            ?>
                                <option <?php if ($fa->id == $famille_id) { ?> selected="selected" <?php } ?> value="<?php echo $fa->id; ?>"><?php echo $fa->Nom ?></option>
                            <?php } ?>

                        </select>
                    </div> -->
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



                </div>
                <br>
                <div class="row">


                </div>

                <br>
                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary alertdep" id="">Afficher</button>
                        <?php
                        //debug($stockdepots);
                        if ($stockdepots != null) {
                        ?>
                            <a onclick="openWindow(1000, 1000, wr+'Stockdepots/imp?article_id=<?php echo @$articleid; ?>&depot_id=<?php echo @$depotid; ?>&famille_id=<?php echo @$famille_id; ?>')"><button class="btn btn-primary ">Imprimer</button></a>
                        <?php }  ?>

                        <?php echo $this->Html->link(__('Actualiser'), ['action' => '/index'], ['class' => 'btn btn-primary ']) ?>


                    </div>
                </div>
            </div>
            <div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<h3 style="margin-left: 5px ;">
    Articles
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="ls-editable-table table-responsive ls-table">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="20%" class="actions text-center"> <?php echo ('Code '); ?></th>
                                <th width="50%" class="actions text-center "><?php echo ('Designation'); ?></th>
                                <th width="30%" class="actions text-center "><?php echo ('Quantité'); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $total = 0;
                            $dernierprix = 0;

                            foreach ($stockdepots as $stockdepot) :

                                $articleid = $stockdepot['id'];


                                date_default_timezone_set('Africa/Tunis');
                                $date1 =    date("Y") . '-01-01' . date(" 00:00:00");
                                $time = new FrozenTime('now', 'Africa/Tunis');
                                $date2 = date("Y-m-d H:i:s");
                                ///  debug($date2);
                                $connection = ConnectionManager::get('default');
                                $month = (int)date('m');
                                $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date2 . "','0'," . $depotid . " ) as v")->fetchAll('assoc');

                                $qtestock = $inv[0]['v'];
                                ///debug($qtestock);
                            ?>
                                <tr>

                                    <?php if ($qtestock != 0) : ?>

                                        <td align="center">
                                            <a href="<?= $this->Url->build([
                                                            'controller' => 'Articles',
                                                            'action' => 'indexspec',
                                                            '?' => [
                                                                'date1' => @$date1,
                                                                'date2' => @$date2,
                                                                'depot_id' => @$depotid,
                                                                'article_id' => $stockdepot['id']
                                                            ]
                                                        ], ['fullBase' => true]); ?>" target="_blank">
                                                <?= h($stockdepot['Code']) ?>
                                            </a>
                                        </td>
                                        <td align="center">
                                            <a href="<?= $this->Url->build([
                                                            'controller' => 'Articles',
                                                            'action' => 'indexspec',
                                                            '?' => [
                                                                'date1' => @$date1,
                                                                'date2' => @$date2,
                                                                'depot_id' => @$depotid,
                                                                'article_id' => $stockdepot['id']
                                                            ]
                                                        ], ['fullBase' => true]); ?>" target="_blank">
                                                <?= h($stockdepot['Dsignation']) ?>
                                            </a>
                                        </td>


                                        <td align="center"><?php
                                                            echo $qtestock
                                                            ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

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
                                'paging': true,
                                'lengthChange': true,
                                'searching': true,
                                'ordering': false,
                                'info': true,
                                'autoWidth': false
                            })
                        })
                    </script>


                    <script>
                        $(function() {



                            $('.alertdep').on('mouseover', function() {

                                ///   alert('hechem')
                                depot = $('#depot_id').val();
                                article = $('#article_id').val();
                                ///  client = $('#client_id').val();
                                if (depot == '') {
                                    alert("Veuillez choisir un dépot SVP  !!")
                                }
                                //  else if (article == '') {
                                //     alert("Veuillez choisir un article SVP  !!")
                                // }


                            });
                        })
                    </script>
                    <script>
                        function openWindow(h, w, url) {
                            leftOffset = (screen.width / 2) - w / 2;
                            topOffset = (screen.height / 2) - h / 2;
                            window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
                        }
                    </script>
                    <?php $this->end(); ?>