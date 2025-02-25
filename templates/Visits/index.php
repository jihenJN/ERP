<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Visit> $visits
 */
?>

<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php
echo $this->Html->script('salma');
?>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_parametrage' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'banques') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
  <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php } ?>
<br><br><br>
<section class="content-header">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
</section>
<h1>
Visites Techniques
</h1>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="5%" align="center"><?= ('Numero') ?></th>
                <th width="10%" align="center"><?= ('Date Demande') ?></th>
                <th width="10%" align="center"><?= ('Type Contact') ?></th>
                <th width="10%" align="center"><?= ('Client') ?></th>
                <th width="10%" align="center"><?= ('Lieu') ?></th>
                <th width="10%" align="center"><?= ('Localisation') ?></th>
                <th width="10%" align="center"><?= ('Date prevu') ?></th>
                <th width="10%" align="center"><?= ('Visiteur') ?></th>
                <th width="10%" align="center"><?= ('Date visite') ?></th>
                <th width="10%" align="center"><?= ('Commentaire') ?></th>
                <th width="5%" scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($visits as $i => $visit): ?>
                <tr>
                <td><?= h($visit->numero) ?>
                    <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id'.$i, 'value' => $visit->id, 'label' => '', 'type'=>'hidden','champ' => 'id', 'class' => 'form-control']); ?>
                </td>
                <td><?= h($visit->date_demande) ?></td>
                <td><?= h($visit->type_contact->libelle) ?></td>
                <td><?= h($visit->client->Raison_Sociale) ?></td>
                <td><?= h($visit->lieu) ?></td>
                <td><?= h($visit->localisation) ?></td>
                <td><?= h($visit->date_prevu) ?></td>
                <td><?= h($visit->visiteur->nom) ?></td>
                <td><?= h($visit->date_visite) ?></td>
                <td><?= h($visit->commentaire) ?></td>
                  <td class="actions text" align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $visit->id), array('escape' => false)); ?>
                    <?php if ($edit == 1) { echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $visit->id), array('escape' => false)); }?>
                    <?php if ($delete == 1) {//echo $this->Form->postLink("<button class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $visit->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $visit->id)); ?>
                    <button index='<?php echo $i?>' class='verifierbanque btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>
                    <?php } ?>
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
</script>
<?php $this->end(); ?>


<script type="text/javascript">

$(function() {
    $('.verifierbanque').on('click', function() {
      let ind = $(this).attr('index');
      let id = $('#id' + ind).val();

      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Banques', 'action' => 'verifbanquesup']) ?>",
        dataType: "json",
        data: {
          id: id
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data, status, settings) {
          if (data.Comptes != 0) {
            alert('existe dans un document');
          } else {
            if (confirm('Voulez-vous supprimer cet enregistrement')) {
              document.location = wr+"Banques/delete/" + id;
            }
          }
        }
      });
    });
  });
</script>






























