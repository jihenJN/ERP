<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Societe $societe
 */

use PhpParser\Node\Stmt\Label;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">

    <td colspan="3">
        <div style="float: left;font-size: 12px;margin-left:10px;"><strong>Paramétrage nombre de jours</strong></div>
        <div style="float: right;font-size: 12px;margin-right:10px;">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                        <?php echo __('Retour'); ?>
                    </a></li>
            </ol>

            <?php ?>
        </div>
    </td>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <?php echo $this->Form->create($parametragejour, [
                    'role' => 'form',
                    'type' => 'file',
                    'onkeypress' => "return event.keyCode!=13",
                ]); ?>
                <div class="box-body" style="font-size: 12px;">
                    <div class="row">
                        <div class="col-xs-6" style="font-size: 12px;">
                            <?php
                            echo $this->Form->control('nbrejours', ['label' => 'nombre']); ?>
                        </div>
                    </div>
                    <button type="submit" class="pull-right btn btn-success btn-sm" id="en1"
                        style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
</section>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>