<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operation[]|\Cake\Collection\CollectionInterface $operations
 */
?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operationcredit[]|\Cake\Collection\CollectionInterface $operationcredits
 */
?>

<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>


<?php echo $this->fetch('script'); ?>
<section class="content-header">
  <h1>
    Opérations

    <!--<div class="pull-right"><?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
  </h1>-->
  </h1><br>
  <?php
  $add = "";
  $edit = "";
  $delete = "";
  $view = "";
  $session = $this->request->getSession();
  $abrv = $session->read('abrvv');
  $lien = $session->read('lien_finance' . $abrv);
  //debug($lien);die;
  foreach ($lien as $k => $liens)
  //debug($liens['lien']);die;
  {
    if (@$liens['lien'] == 'operations') {
      $add = $liens['ajout'];
      $edit = $liens['modif'];
      $delete = $liens['supp'];
    }
    //debug($liens);die;
  }



  //if ($add == 1) { 
  ?>

  <div class="pull-left"><?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
</section>
<?php  //} 
?>
<br>
<!-- Main content -->



<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <!-- <div class="box">
        <div class="box-header">
        <?php //echo $this->Form->create($operationcredits, ['type' => 'get']); 
        ?>
      
        
        <div class="col-xs-6">
          <?php
          echo $this->Form->control('name', ['label' => 'Name ', 'value' => $this->request->getQuery('name'), 'autocomplete' => 'off']); ?>
        </div>
        
      
          <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
        </div>   
      </div> -->
      <!-- /.box-header -->
      <div class="box-body" style="background-color: white ;">
        <table id="example1" class="table table-bordered table-striped">


          <thead>
            <tr>
              <!-- <th scope="col"><?= $this->Paginator->sort('id') ?></th> -->
              <th width="10%" align="center"><?= __('Nom') ?></th>
              <th width="10%" align="center"><?= __('Date Debut') ?></th>
              <th width="10%" align="center"><?= __('Date Valeur') ?></th>

              <th width="10%" align="center"><?= __('Type Opération') ?></th>
              <th width="10%" align="center"><?= __('Actions') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($operations as $i => $operation) : ?>
              <tr>
                <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $operation->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td>
                <!-- <td><?= $this->Number->format($operation->id) ?></td> -->
                <td><?= h($operation->name) ?></td>
                <td>


                  <?=
                  $this->Time->format(
                    $operation->datedebut,
                    'dd/MM/y'
                  );
                  ?></td>
                <td>
                  <?=
                  $this->Time->format(
                    $operation->datevaleur,
                    'dd/MM/y'
                  );
                  ?></td>
                <!-- <td><?= h($operation->datedebut) ?></td>
                  <td><?= h($operation->datevaleur) ?></td> -->
                <td><?= h($operation->typeoperation->name) ?></td>
                <td class="actions text-left">

                  <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $operation->id), array('escape' => false));
                  ?>

                  <?php //if ($edit == 1) { 
                  ?>
                  <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $operation->id), array('escape' => false)); ?>
                  <?php //} 
                  ?>
                  <?php // if ($delete == 1) { 
                  ?>
                  <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger '><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $operation->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $operation->id)); ?>
                  <?php //} 
                  ?>
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
<script>
  $(function() {
    $('.verifiercmd').on('click', function() {
      // alert('hello');
      ind = $(this).attr('index');
      //alert(ind);
      id = $('#id' + ind).val();
      // alert(idc);
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Modepaiements', 'action' => 'verifm']) ?>",
        dataType: "json",
        data: {
          id: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          // alert(data.Modepaiements);
          if (data.Modepaiements != 0) {
            alert('existe dans un document');
          } else {
            if (confirm('Voulez-vous supprimer cet enregistrement')) {
              alert('ok supp');
              document.location = "https://facturation.isofterp.com/mtd/Modepaiements/delete/" + id;
            }
          }
        }
      })
    });
  });
</script>
<?php $this->end(); ?>