<section class="content-header">
  <h1>
    Fourchette
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('Information'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('Client') ?></dt>
            <dd><?= $fourchette->has('client') ? $this->Html->link($fourchette->client->name, ['controller' => 'Clients', 'action' => 'view', $fourchette->client->id]) : '' ?></dd>
            <dt scope="row"><?= __('Fourch') ?></dt>
            <dd><?= $fourchette->has('fourch') ? $this->Html->link($fourchette->fourch->name, ['controller' => 'Fourches', 'action' => 'view', $fourchette->fourch->id]) : '' ?></dd>
            <dt scope="row"><?= __('Article') ?></dt>
            <dd><?= $fourchette->has('article') ? $this->Html->link($fourchette->article->id, ['controller' => 'Articles', 'action' => 'view', $fourchette->article->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($fourchette->id) ?></dd>
            <dt scope="row"><?= __('Valeur') ?></dt>
            <dd><?= $this->Number->format($fourchette->valeur) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
