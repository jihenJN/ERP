<?php

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;


echo $this->Html->css('select2'); ?>
<section class="content-header">
    <header>
        <h1 style="text-align:center;">Etat article avoir</h1>
    </header>
</section>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">

                <?php echo $this->Form->create($articles, ['type' => 'get']);
                ?>


                <div class="row">
                    <div class="col-xs-6">
                        <?php

                        echo $this->Form->input('date1', array('value' => @$date1, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Date de'));
                        ?>

                    </div>


                    <div class="col-xs-6">

                        <?php
                        echo $this->Form->input('date2', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly', 'type' => 'date', 'label' => "Jusqu'à ", 'value' => @$date2));

                        ?>

                    </div>
                </div>
                <br>


                <br>
                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary alertartavoir" id="">Afficher</button>
                        <?php
                        if ($articles){
                            $tab =$articles->toarray() ;

                        
                    
                  
                        if ( count($tab) != 0) {
                        ?>
                        <a onclick="openWindow(1000, 1000, 'https://codifaerp.isofterp.com/demo/Articles/impavoir?date1=<?php echo @$date1; ?>&date2=<?php echo @$date2; ?>')"><button class="btn btn-primary ">Imprimer</button></a>
                        <?php } 
                        } 
                        ?>

                        <?php echo $this->Html->link(__('Actualiser'), ['action' => '/indexavoir'], ['class' => 'btn btn-primary ']) ?>


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

                            foreach ($articles as $art) :

                                $articleid = $art['id'];


                                date_default_timezone_set('Africa/Tunis');
                                $date11 =    date("Y") . '-01-01' . date(" 00:00:00");
                                $time = new FrozenTime('now', 'Africa/Tunis');
                                $date22 = date("Y-m-d H:i:s");

                                $connection = ConnectionManager::get('default');
                                $month = (int)date('m');
                                $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date22 . "','0'," . $depotid . " ) as v")->fetchAll('assoc');

                                $qtestock = $inv[0]['v'];
                            ?>
                                <tr>


                                    <td align="center">
                                    <a href='https://codifaerp.isofterp.com/demo/Articles/indexspec?date1=<?php echo @$date1; ?>&date2=<?php echo @$date2; ?>&depot_id=<?php echo @$depotid; ?>&article_id=<?php echo $art['id'] ?>' target="_blank">
                                            <?php echo  $art['Code'] ?></a>
                                    </td>
                                    <td align="center">
                                    <a href='https://codifaerp.isofterp.com/demo/Articles/indexspec?date1=<?php echo @$date1; ?>&date2=<?php echo @$date2; ?>&depot_id=<?php echo @$depotid; ?>&article_id=<?php echo $art['id'] ?>' target="_blank">
                                            <?php echo  $art['Dsignation'] ?></a>
                                    </td>

                                    <td align="center"><?php
                                                        echo $qtestock;                                                        ?>
                                    </td>
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



                            $('.alertartavoir').on('click', function() {

                                date1 = $('#date1').val();
                                date2 = $('#date2').val();
                                ///  client = $('#client_id').val();
                                if (date1 == '') {
                                    alert("Veuillez choisir un date du debut SVP  !!")
                                    return false 
                                }
                                 else if (date2 == '') {
                                    alert("Veuillez choisir un date de fin  !!")
                                    return false
                                }


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