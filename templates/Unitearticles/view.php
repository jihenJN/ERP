<section class="content-header">
  <h1>
    Article Unite
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
      <div class="box ">
        <!-- /.box-header -->
        <?php echo $this->Form->create($unitearticle, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>

        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <?php echo $this->Form->control('name', ["readonly"]); ?>
            </div>
            <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
    </div>
</section>