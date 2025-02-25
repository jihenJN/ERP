<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>

<?php echo $this->Html->css('select2'); ?>


<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Modification famille
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
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
                <?php echo $this->Form->create($famille, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
              //  debug ($famille);
                /// die;
                ?>



                <div class="box-body">
                    <div class="row">

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Nom', ['label' => 'Nom', 'required' => 'off', 'id' => 'Nom', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control']); ?>

                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('marque_id', ['empty' => 'Veuillez choisir !!','label' => 'Marque','options'=>$marques, 'required' => 'off', 'id' => 'marque_id', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control']); ?>
                                </div>
                          
                               

                            </div>
                        </div>


                        <br />
                    </div>
                    <div align="center">

                    <?php echo $this->Form->end(); ?>
                </div>
                <!--
                <h3 style="margin-left: 10px ;"> Liste des articles</h3>
                <table align="center" style="width: 100%;" class="table table-bordered table-striped table-bottomless" id="tab">
                    <thead>
                    <th>Code</th>
                    <th>Dsignation</th>
                    <th>Destinée à la vente	</th>

                    </thead>
                    <?php
                    
                    foreach ($articles as $a) :
                    $chaine = '' ;
                    if ($a->vente == 1) {
                        $chaine = 'oui' ; 
                    }
                    if ($a->vente == 0) {
                        $chaine = 'non' ; 
                    }
                    
                    ?>
                        <tr>
                        <td >
                        <?php echo $this->Html->link($a->Code, array('controller' => 'articles', 'action' => 'edit', $a->id)) ?>
                            </td>
                            <td>

                                <?php echo $this->Html->link($a->Dsignation, array('controller' => 'articles', 'action' => 'edit', $a->id)) ?>
                            </td>
                            
                            
                            <td>
                                <?php echo $chaine ; ?>
                            </td>

                            
                           
                           

                        </tr>

                        <?php  ?>
                    <?php endforeach; ?>

                </table>
                -->
                <button type="submit" class="pull-right btn btn-success btn-sm"  style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                <?php echo $this->Form->end(); ?>






    
                <!-- /.box -->

                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->

</section>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
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
//    $('#datemask').inputmask('dd/mm/yyyy', {
//        'placeholder': 'dd/mm/yyyy'
//    })
    //Datemask2 mm/dd/yyyy
//    $('#datemask2').inputmask('mm/dd/yyyy', {
//        'placeholder': 'mm/dd/yyyy'
//    })
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
    $(document).ready(function() {


        $('input[type=radio][name=radio]').click(function() {

            s= 1 ; 
            if (this.value == '0') {
                $('#ventee').val(Number(s));
                return confirm('Voulez-vous mettre tous les articles liés à cette famille non destinée à la vente ?')

            }
        });




    });
</script>

<?php $this->end(); ?>