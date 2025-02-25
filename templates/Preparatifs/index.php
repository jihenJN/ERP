<section class="content-header">
  <header>
    <h1 style="text-align:center;">Préparatifs</h1>
  </header>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>


<?php echo $this->Html->script('hechem'); ?>

<div class="pull-left" style="margin-left:25px;margin-top: 20px">
  <?php //echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<br> <br><br>
<section class="content-header">
  <h1>
    Recherche
  </h1>
</section>
<section class="content" style="width: 99%">
  <div class="box">
    <div class="box-header">
    </div>

    <div class="box-body">

      <?php echo $this->Form->create($preparatif, ['type' => 'get']); ?>
      <div class="row">


        <div class="col-xs-6">
          <?php echo $this->Form->control('numero', ['label' => 'Numero', 'value' => $this->request->getQuery('numero'), 'name', 'required' => 'off']); ?>
        </div>




        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>

</section>


<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="actions text-center" align="center"> Numero </th>
                <th class="actions text-center" align="center"> Date </th>
                <th class="actions text-center" align="center"> Actions</th>
              </tr>
            </thead>
            <tbody>



              <?php foreach ($preparatif as $pre) : ?>
                <tr>

                  <td class="actions text-center"> <?php echo $pre['numero']  ?> </td>
                  <td class="actions text-center"> <?php echo $pre['date']  ?> </td>
                  <td class="actions text-center" align="center">
                        <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $pre->id), array('escape' => false)); ?>
                        <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview2', $pre->id), array('escape' => false)); ?>
                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $pre->id), array('escape' => false)); ?>
                        <?php echo $this->Html->link("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash'></i></button>", array('action' => 'delete', $pre->id), array('escape' => false)); ?>

                    </div>

                  </td>


                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>



          <table>

            <tr>


            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>

<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
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






































<!-- <section class="content-header">
  <h1>
  Preparatifs
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table  class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="10%" align="center">  Numero </th>
                <th width="10%" align="center">  Date </th>
                <th width="10%" align="center">  Camion  </th>
                <th width="10%" align="center"> Chauffeur  </th>
                <th width="10%" align="center"> Convoyeur </th>
                <th width="10%" align="center"> Poids </th>
                <th width="10%" align="center"> Nb de cartons </th>
                <th width="10%" align="center"> Actions </th>


              
              </tr>
            </thead>
            <tbody>
            <?php

            foreach ($preparatif as $i  => $pre)

            //    debug($pre) ; die ; 

            {
            ?>
                <tr>

                 <td>  <?php echo $pre['numero']  ?>   </td>
                 <td> <?php echo $pre['date']  ?>  </td>
                 <td>  <?php echo $pre['materieltransport']['matricule']  ?>  </td>
                 <td>  <?php echo $chauff ?> </td>
                 <td> <?php echo $conv ?>  </td>
                 <td> <?php echo $pre['poidstotal']  ?>  </td>
                 <td> <?php echo $pre['nbcartons']  ?>  </td>


                 <td class="actions text" align="center">
                    <div style="display: flex;" align="center">
                  
                      <div style="display: flex; margin-right:2px ; margin-left:2px" align="center">

                        <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $pre->id), array('escape' => false)); ?>
                      </div>

                      <div style="display: flex; margin-right:2px ; margin-left:2px" align="center">

                        <?php echo $this->Html->link("<button class='btn btn-xs btn-danger'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview2', $pre->id), array('escape' => false)); ?>
                      </div>


                    </div>

                  </td>
   
                 
                </tr>




                <?php } ?>

            </tbody>

            
          </table>
         

      

        </div>
        <!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</div>
</section> -->