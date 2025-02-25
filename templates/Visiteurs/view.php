<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visiteur $visiteur
 */
?>
<!--div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><!?= __('Actions') ?></h4>
            <!?= $this->Html->link(__('Edit Visiteur'), ['action' => 'edit', $visiteur->id], ['class' => 'side-nav-item']) ?>
            <!?= $this->Form->postLink(__('Delete Visiteur'), ['action' => 'delete', $visiteur->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visiteur->id), 'class' => 'side-nav-item']) ?>
            <!?= $this->Html->link(__('List Visiteurs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <!?= $this->Html->link(__('New Visiteur'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="visiteurs view content">
            <h3><!?= h($visiteur->id) ?></h3>
            <table>
                <tr>
                    <th><!?= __('Nom') ?></th>
                    <td><!?= h($visiteur->nom) ?></td>
                </tr>
                <tr>
                    <th><!?= __('Telephone') ?></th>
                    <td><!?= h($visiteur->telephone) ?></td>
                </tr>
                <tr>
                    <th><!?= __('Id') ?></th>
                    <td><!?= $this->Number->format($visiteur->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
  <section class="content-header">
    <h1>
   Consultation Visiteur
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
          
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($visiteur, ['role' => 'form']); ?>
            <div class="box-body">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
              <?php
                echo $this->Form->control('nom',['readonly'=>'readonly','label'=>'Nom et Prénom']);
                echo $this->Form->control('telephone',['readonly'=>'readonly','label'=>'Téléphone']);
              ?>
                 </div>
                          </div>
          <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box-body -->

         
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>