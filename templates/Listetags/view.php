<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tagsarticle $tagsarticle
 * @var string[]|\Cake\Collection\CollectionInterface $listetags
 */
?>
<section class="content-header">

<td colspan="3">
  <div style="float: left;font-size: 12px;margin-left:10px;"><strong> Consultation Tags</strong></div>
  <div style="float: right;font-size: 12px;margin-right:10px;">
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
          <?php echo __('Retour'); ?></a></li>
    </ol>

    <?php    ?>
  </div>
</td>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($listetag, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>


                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6" style="font-size: 12px;">
                            <?php echo $this->Form->control('tag', ['style'=>'font-size: 12px;','readonly' => 'readonly', 'label' => 'TAG', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '']); ?>
                        </div>

                    </div>

                    <div align="center">

                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
</section>