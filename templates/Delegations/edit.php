<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
  Modification delegation
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
      <div class="box ">
        <?php echo $this->Form->create($delegation, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('name',['label'=>'Nom']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
             echo $this->Form->control('codepostale',['label'=>'Code postale']);
            ?>
          </div>
          <button type="submit" class="pull-right btn btn-success " id="pvr" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
      </div>
    <!-- /.row -->
</section>












<!--

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $delegation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $delegation->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Delegations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="delegations form content">
            <?= $this->Form->create($delegation) ?>
            <fieldset>
                <legend><?= __('Edit Delegation') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('codepostale');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>-->
