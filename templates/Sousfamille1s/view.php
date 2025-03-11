
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


        Consultation sous famille
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
                <?= $this->Form->create($sousfamille1) ?>




                <div class="box-body">
                    <div class="row">

                       


                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('famille_id', ['options' => $familles, 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control commercial']); ?> </div>

                           
                                    <div class="col-xs-6">
                                    <?php echo $this->Form->control('code', ['readonly', 'label' => 'Code','required' => 'off', 'id' => 'code', 'class' => 'form-control']); ?>
                                </div>

                            <div class="col-xs-6">
                                <?php echo $this->Form->control('name', ['label' => 'Nom', 'required' => 'off', 'id' => 'Nom', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control']); ?>
                            </div>
                        

                            <div class="col-xs-6" style="margin-top: 25px ; margin-right : 25px;" hidden>
                                    <label class="control-label" for="unite-id" style="margin-right: 20px"> Obligatoire</label>

                                    Oui <input type="radio" name="obligatoire" value="1" id="active" class="choixcollisage" style="margin-right: 20px" <?php if ($sousfamille1->obligatoire==1) {?>checked <?php } ?> >
                                    Non <input type="radio" name="obligatoire" value="0" id="desactive" class="choixcollisage" <?php if ($sousfamille1->obligatoire==0) {?>checked <?php } ?> >
                                  


                                </div>
                                
                            <div class="col-xs-6" style="margin-top: 25px ; margin-right : 25px;" hidden>
                                    <label class="control-label" for="sanscalcul" style="margin-right: 20px"> Sans calcul (statistique Vente)</label>

                                    Oui <input type="radio" name="sanscalcul" value="1" id="active1" class="choixcollisage1" style="margin-right: 20px" <?php if ($sousfamille1->sanscalcul==1) {?>checked <?php } ?> >
                                    Non <input type="radio" name="sanscalcul" value="0" id="desactive1" class="choixcollisage1" <?php if ($sousfamille1->sanscalcul==0) {?>checked <?php } ?> >
                                  


                                </div>

                                <div class="col-xs-6" style="margin-top: 25px ; margin-right : 25px;" hidden>
                                    <label class="control-label" for="unite-id" style="margin-right: 20px">Remise Obligatoire</label>

                                    Oui <input type="radio" name="remiseobligatoire" value="1" id="active2" class="choixcollisage2" style="margin-right: 20px" <?php if ($sousfamille1->remiseobligatoire==1) {?>checked <?php } ?> >
                                    Non <input type="radio" name="remiseobligatoire" value="0" id="desactive2" class="choixcollisage2" <?php if ($sousfamille1->remiseobligatoire==0) {?>checked <?php } ?> >
                                  


                                </div>
                            </div>










                    <br />






                


<!--
                    <h3 style="margin-left: 10px ;"> Liste des articles</h3> 
                    <div align="center">
                        <table align="center" style="width: 100%;" class="table table-bordered table-striped table-bottomless" id="tab">
                            <thead>
                            <th>Code</th>
                            <th>Dsignation</th>
                            <th>Destinée à la vente	</th>

                            </thead>
                            <?php
                            foreach ($articles as $a) :
                                $chaine = '';
                                if ($a->vente == 1) {
                                    $chaine = 'oui';
                                }
                                if ($a->vente == 0) {
                                    $chaine = 'non';
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
                                        <?php echo $chaine; ?>
                                    </td>





                                </tr>

                                <?php ?>
                            <?php endforeach; ?>

                        </table>
                            -->
                    
                <!-- /.box -->
                <!-- table ajout unité -->


                

                <?php echo $this->Form->end(); ?>

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
    $(document).ready(function() {
      // Disable all input and select elements
      $('input, select , radio').prop('disabled', true);
    });
  </script>
<script>
    $(function () {

        

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
//    $('#datemask').inputmask('dd/mm/yyyy', {
//        'placeholder': 'dd/mm/yyyy'
//    })
//    //Datemask2 mm/dd/yyyy
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
<?php $this->end(); ?>