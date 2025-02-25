<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
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
  if (@$liens['lien'] == 'typeexons') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
<div class="pull-left" style="margin-left:25px;margin-top: 20px">
  <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php } ?>
<br> <br><br>




<section class="content-header">
  <h1>
  Type exonerations
  </h1>
</section>






<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>



                <th  class="actions text-center"><?php echo ('Nom'); ?></th>
                 <th  class="actions text-center"><?= __('Actions') ?></th>
</tr>
            </thead>
            <tbody>
<?php foreach ($typeexons as $typeexon): ?>
 <tr>
 <td  align="center" ><?= h($typeexon->name) ?></td>

    
     <td align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $typeexon->id), array('escape' => false)); ?>
                    <?php if ($edit == 1) { echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $typeexon->id), array('escape' => false)); } ?>
                    <?php if ($delete == 1) { echo $this->Form->postLink("<button class=' deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $typeexon->id),array('escape' => false,null), __('Veuillez vraiment supprimer cette enregistrement # %s?', $typeexon->id)); 
                    }?>
                  </td>
    
    
    
    
    
    
                        

</tr>
<?php endforeach; ?>
            </tbody>
        </table>
        </div>
      </div>
         </div>
 </div>

</section>











<!--
<div class="typeexons index content">
    <?= $this->Html->link(__('New Typeexon'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Typeexons') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($typeexons as $typeexon): ?>
                <tr>
                    <td><?= $this->Number->format($typeexon->id) ?></td>
                    <td><?= h($typeexon->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $typeexon->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $typeexon->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $typeexon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $typeexon->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>-->
