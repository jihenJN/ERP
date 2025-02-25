<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->fetch('script'); ?>


  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<br><br><br>
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

            <?php echo $this->Form->create($dossierimportations, ['type' => 'get']); ?>
            <div class="row">


                <div class="col-xs-6">
                    <?php echo $this->Form->control('numero', ['label' => 'Numero', 'value' => $this->request->getQuery('numero'), 'name', 'required' => 'off']); ?>
                </div>

                 <div class="col-xs-6">
                    <div class="form-group input text required">
                        <label class="control-label" for="name">Fournisseurs</label>
                        <select class="form-control select2" name="fournisseur_id" value='<?php $this->request->getQuery('fournisseur_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($fournisseurs as $id => $fr) { ?>
                              <option <?php if($this->request->getQuery('fournisseur_id')==$id){?> selected="selected"<?php } ?> value="<?php echo $id; ?>"><?php echo $fr ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="col-xs-6">
                    <div class="form-group input text required">
                        <label class="control-label" for="name">Banques</label>
                        <select class="form-control select2" name="banque_id" value='<?php $this->request->getQuery('banque_id') ?>'>
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($banques as $id => $banque) { ?>
                              <option <?php if($this->request->getQuery('banque_id')==$id){?> selected="selected"<?php } ?> value="<?php echo $id; ?>"><?php echo $banque ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>



           

                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>

        </section>

<section class="content-header">
  <h1>
  Dossier d'importation
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="12%" class="actions text-center"> Numero </th>
                <th width="18%" class="actions text-center"> Date </th>
                <th width="10%" class="actions text-center"> Etat </th>
                <th width="15%" class="actions text-center">Fournisseur </th>
                <th width="10%" class="actions text-center"> Banque </th>
                <th width="20%" class="actions text-center"> Actions </th>

              </tr>
            </thead>
            <tbody>

              <?php 
              foreach ($dossierimportations as $i => $imp) :
                    ; 
              ?>
                <tr>
                  <td class="actions text-center"><?= h($imp->numero) ?></td>
                  <td class="actions text-center"><?= h($imp->date) ?></td>
                  <td class="actions text-center"><?= h($imp->etat) ?></td>
                  <td class="actions text-center"><?= h($imp->fournisseur->name) ?></td>
                  <td class="actions text-center"><?= h($imp->banque->name) ?></td>


                  <td class="actions text-center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $imp->id), array('escape' => false)); ?>
                    <?php 
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $imp->id), array('escape' => false));
                     ?>
                    <?php 
                    echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'  ><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $imp->id) ,array('escape' => false));?>
                    </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('alert'); ?>
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
</script>


<script>
  $('.select2').select2()
</script>


<?php $this->end(); ?>