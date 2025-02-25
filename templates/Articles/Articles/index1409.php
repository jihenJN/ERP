<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>






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

      <?php echo $this->Form->create($articles, ['type' => 'get']); ?>
      <div class="row">


        <div class="col-xs-6">
          <?php
          echo $this->Form->control('Code', ['label' => 'Code', 'value' => $this->request->getQuery('Code'), 'name', 'required' => 'off']); ?>
        </div>


        <div class="col-xs-6">
          <?php
          echo $this->Form->control('Dsignation', ['label' => 'Designation', 'required' => 'off', 'value' => $this->request->getQuery('Dsignation')]); ?>
        </div>
        <div class="col-xs-6">
          <div class="form-group input text required">
            <label class="control-label" for="name">Familles</label>
            <select class="form-control select2" name="famille_id" value='<?php $this->request->getQuery('Dsignation') ?>'>
              <option value="" selected="selected" disabled>Veuillez choisir !!</option>
              <?php foreach ($familles as $id => $famille) { ?>
                <option value="<?php echo $id; ?>"><?php echo  $famille ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
      </div>

</section>

<section class="content-header">
  <h1>
    Articles
  </h1>
</section>







<section class="content" style="width: 99%">
  <div class="box">
    <div class="box-header">

      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th scope="col"><?= ('Code') ?></th>
              <th scope="col"><?= ('Designiation') ?></th>

              <th scope="col"><?= ('Famille') ?></th>
              <th scope="col"><?= ('TVA') ?></th>
              <th scope="col"><?= ('Prix') ?></th>
              <th scope="col"><?= ('Image') ?></th>

              <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($articles as $article) : 
              //  debug($article);?>
              <tr>
                <td><?= h($article->Code) ?></td>
                <td><?= h($article->Dsignation) ?></td>
                <td><?= ($article->famille->Nom) ?></td>
                <td><?= ($article->tva->Taux) ?></td>
                <td><?= h($article->Prix_LastInput) ?></td>
                <td>
                  <?php echo $this->Html->image('imgart/'.$article->image,['style' => 'max-width:80px;height:80px;']); ?>
                </td>
                <td class="actions text-right" style="text-align: center ;">
                  <?= $this->Html->link((''), ['action' => 'view', $article->id], ['class' => 'btn btn-xs btn-success fa fa-search']) ?>
                  <?= $this->Html->link((''), ['action' => 'edit', $article->id], ['class' => 'btn btn-xs btn-warning fa fa-edit ']) ?>
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
      </div>
    </div>

  </div>

</section>