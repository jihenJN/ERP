<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
  Consultation  delegation
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>


<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <?php echo $this->Form->create($delegation, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
 <div class="col-xs-6">
            <?php
            echo $this->Form->control('name',["readonly",'label'=>'Nom']);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('codepostale',["readonly",'label'=>'Code postale']);
            ?>
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>






<!--<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Delegation'), ['action' => 'edit', $delegation->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Delegation'), ['action' => 'delete', $delegation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $delegation->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Delegations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Delegation'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="delegations view content">
            <h3><?= h($delegation->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($delegation->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($delegation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Codepostale') ?></th>
                    <td><?= $this->Number->format($delegation->codepostale) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>-->
