<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('mariem'); ?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->css('select2'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Consultation bon de chargement
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($bondechargement, ['role' => 'form']); ?>


        <div class="box-body">
          <div class="row">
            <div class="row">
              <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                <div class="col-xs-6">
                  <?php echo $this->Form->control('numero', ['readonly' => 'readonly',  'label' => 'Numero', 'name', 'required' => 'off']); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->control('pointdevente_id', ['disabled' => 'true','options' => $pointdeventes, 'value' => $this->request->getQuery('name'), 'empty' => 'Veuillez choisir !!',  'required' => 'off', 'label' => 'Site', 'class' => 'form-control select2 control-label']); ?></div>
              </div>
            </div>


            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


              <div class="row">

                <div class="col-xs-6">

                  <?php echo $this->Form->control('depot_id', ['disabled' => 'true','options' => $depots, 'empty' => 'Veuillez choisir !!', 'label' => 'Depots', 'class' => 'form-control select2 control-label']); ?>
                </div>
                <div class="col-xs-6">
                  <?php echo $this->Form->control('date',['readonly' => 'readonly']); ?> </div>
              </div>
            </div>

          </div>





          <section class="content-header">
            <h1 class="box-title"><?php echo __('Ligne bon de chargement'); ?></h1>
          </section>

          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box box-primary">
                <div class="box-header with-border">
                 

                </div>
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless"  id="tabligne3">



                      <thead>
                        <tr style='width:20px'>
                          <td align="center" style="width: 20%;"><strong>Article</strong></td>
                          <td align="center" style="width: 20%;"><strong>Quantite en stock</strong></td>
                          <td align="center" style="width: 20%;"><strong>Quantite</strong></td>

                        </tr>
                      </thead>
                      <tbody>


                        <?php if (!empty($bondechargement)) :  ?>
                          <?php

                          foreach ($lignebonchargementss as $i => $lignebonchargements) : // debug($lignebonchargements);
                            //  foreach ($lignebonchargements as $i => $ligne) :  debug($ligne->article->Dsignation);
                          ?>
                            <tr>
                              <td>

                                <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'type' => 'hidden')); ?>

                                <!-- <?php echo $this->Form->control('article_id', array('label' => '','options' => $articles,'value' => $lignebonchargements->article_id,'name' => 'data[ligner][' . $i . '][article_id]',
                                  'id' => 'article_id' . $i, 'table' => 'ligner', 'index' => $i,'class' => 'form-control articleidbl1'
                                )); ?> -->
                                <label></label>
                                <select name="<?php echo "data[ligner][" . $i . "][article_id]" ?>"  id="<?php echo 'article_id' . $i ?>"  table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleidbl1" disabled="true">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                        <?php foreach ($articles as $id => $article) { ?>
                                          <option <?php if ($lignebonchargements->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                        <?php } ?>
                                </select>

                                <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => 'data[ligner][' . $i . '][id]','value' => $lignebonchargements->id,'type' => 'hidden', 'id' => '', 'table' => 'ligner', 'index' => '',
                                )); ?>

                              </td>

                             


                              <td align="center" table="ligner">
                                <?php echo $this->Form->input('qteStock', ['readonly' => 'readonly', 'label' => '', 'value' => $lignebonchargements->article->Quantit_Disponible, 'type' => 'number',  'name' => 'data[ligner][' . $i . '][qteStock]', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control']); ?>
                              </td>
                              <td align="center" table="ligner">
                                <?php echo $this->Form->input('qte', ['readonly' => 'readonly','label' => '', 'value' => $lignebonchargements->qte, 'type' => 'number',  'name' => 'data[ligner][' . $i . '][qte]', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control gettotal']); ?>
                              </td>

                             
                            </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                        </tr>


                     
                        <input type="text" value="<?php echo $i ?>" id="in" style="display: none ">

                      </tbody>
                    </table><br>
                  </div>
                </div>
              </div>
            </div>


          </section>

        </div>

        <?php echo $this->Form->end(); ?>

      </div>



    </div>
  </div>
</section>





<!-- Ajout ajax recupération article -->
<script type="text/javascript">
  $(function() {
    $('.articleidbl1').on('change', function() {
      // alert('hello');
      index = $(this).attr('index');
      article_id = $('#article_id' + index).val() || 0;

      //alert(article_id);

      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bondechargements', 'action' => 'receive']) ?>",
        dataType: "json",
        data: {
          idfam: article_id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data, status, settings) {
          //   alert(data["Quantit_Disponible"]); ca marche
          // qteStock0
          $('#qteStock' + index).val(data["Quantit_Disponible"]);

          $('#prix' + index).val(data["Prix_LastInput"]);

        }

      })
    });

    $('.depot').on('change', function() {
      //  alert('hello');
      id = $('#site-id').val();
      //alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bondechargements', 'action' => 'getDepot']) ?>",
        dataType: "json",
        data: {
          id: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#depot_id').html(data.select);

        }

      })

    });


    $(".gettot").on("keyup", function () {
    //alert('hh');
    index = $("#in").val(); //alert(index);

    total = 0;
    for (i = 0; i <= index; i++) {
      qteStock = $("#qteStock" + i).val() * 1; //alert(qteStock);
      qte = $("#qte" + i).val() * 1; //alert(qte);
      prix = $("#prix" + i).val() || 0; //alert(prix);
      if (qte > qteStock) {
        alert("veuillez enter quantitÃ© infÃ©rieur a la qunatitÃ© de stock !!");
        $("#qte" + i).val(0);
      } else {
        total = Number(qte) * Number(prix); //alert(total);
      }

      $("#total" + i).val(Number(total));
    }
  });








  });





</script>

<!-- <style>
.select2-selection__rendered {
    line-height: 25px !important;
}

.select2-container
.select2-selection--single{
  height: 35px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #d2d6de !important;

}

.select2-selection__arrow {
    height: 34px !important;
   
}
.select2-selection__choice{
  height: 24px !important;
  color: black !important;
  background-color: white !important;
  font-size: 18px !important;
}
.select2-container
{
  display: block;
  width:auto !important;
}
</style> -->



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