<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte[]|\Cake\Collection\CollectionInterface $comptes
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php
echo $this->Html->script('salma');
?>
<section class="content-header">
    <h1>
    Comptes

    </h1><br>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_finance' . $abrv);

foreach ($lien as $k => $liens) 
//debug($liens['lien']);
{
  if (@$liens['lien'] == 'comptes') {
   
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

//if ($add == 1) { ?>

    <div class="pull-left"><?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
  </section>
<?php  //} ?>
<br>




<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                 <th width="10%" align="center"><?= ('Date') ?></th>
                <th width="10%" align="center"><?= ('Numéro') ?></th>
                <th width="10%"  class="center"><?= ('Agence') ?></th>
                <th width="10%"  class="center"><?= ('Banque') ?></th>

                <th width="10%"  class="center"><?= ('Solde') ?></th>
                <th width="10%"  class="center"><?= ('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($comptes as $i => $compte): ?>
                <tr>
                <td>
                <?=
                  $this->Time->format(
                    $compte->date,
                    'dd/MM/y'
                  );
                  ?></td>
                <td><?= h($compte->numero) ?>
                    <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id'.$i, 'value' => $compte->id, 'label' => '', 'type'=>'hidden','champ' => 'id', 'class' => 'form-control']); ?>

                </td>
                <td><?= h($compte->agence->name) ?></td>
                <td><?= h($compte->banque->name) ?></td>

                <td><?= h($compte->montant) ?></td>  
                  <td class="actions text" align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $compte->id), array('escape' => false)); ?>
                    <?php //if ($edit == 1) {
                       echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $compte->id), array('escape' => false)); 
                       //}?>
                    <?php //if ($delete == 1) {
                        echo $this->Form->postLink("<button class=' btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $compte->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $compte->id)); ?>
                    <!-- <button index='<?php echo $i?>' class=' verifiercmd btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button> -->
                    <?php //} ?>
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




<script type="text/javascript">


$(function() {
$('.verifiercmd').on('click', function() {
 // alert('hello');
   ind = $(this).attr('index');

   id = $('#id' +ind).val();
    // alert(id);
  $.ajax({  
    method: "GET",
    url: "<?= $this->Url->build(['controller' => 'Lignebanques', 'action' => 'verif']) ?>",
    dataType: "json",
    data: {
      id: id,
    },
    headers: {
      'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
    },
    success: function(data, status, settings) {
   //  alert(data.Ticketventes);
      if (data.Comptes != 0) {
        alert('existe dans un document');
      } else {
        if (confirm('Voulez-vous supprimer cet enregistrement')) {
            alert('ok supp');
          document.location = wr+"Comptes/delete/" + id;
        }
      }
    }
  })
});
});

</script>































