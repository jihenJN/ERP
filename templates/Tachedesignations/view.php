<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<section class="content-header">

    <td colspan="3">
        <div style="float: left;font-size: 12px;margin-left:10px;"><strong> Visualiser Taches</strong></div>
        <div style="float: right;font-size: 12px;margin-right:10px;">
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                        <?php echo __('Retour'); ?></a></li>
            </ol>

            <?php    ?>
        </div>
    </td>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($tachedesignation, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body" style="font-size: 12px;">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('num', ['style' => 'font-size: 12px;', 'type' => 'text', 'readonly' => 'readonly', 'id' => 'num', 'style' => 'font-size: 12px;', 'label' => 'Numero']); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php echo $this->Form->control('name', ['style' => 'font-size: 12px;', 'id' => 'name', 'readonly' => 'readonly', 'style' => 'font-size: 12px;', 'label' => 'Nom']); ?>
                        </div>
                    </div>
                    <!-- <button type="submit" class="pull-right btn btn-success btn-sm log" id="alertcateg" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button> -->
                    <?php echo $this->Form->end(); ?>
                </div>

            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>

<script type="text/javascript">
    $(function() {
        $('#alertcateg').on('mousemove', function() {
            name = $('#name').val();

            if (name == '') {
                alert('choisir un nom', function() {});
            }
        });



    });
</script>


<?php $this->end(); ?>