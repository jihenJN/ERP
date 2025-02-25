<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unite $unite
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('mahdi'); ?>




<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>


        Ajout Service
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
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
                <?php echo $this->Form->create($service, ['role' => 'form','onkeypress'=>"return event.keyCode!=13"]);
                //debug ($article);
                // die;
                ?>



                <div class="box-body">
                    <div class="row">

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('name', ['label' => 'Nom', 'required' => 'off', 'id' => 'name', 'div' => 'form-group', 'class' => 'form-control']); ?>
                                </div>

                            </div>
                        </div>


                   








                        <br/>



                    </div>



                    <?php echo $this->Form->end(); ?>





                    <!-- /.box -->
                    <!-- table ajout unité -->


                    <div align="center">
                        <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'service']); ?></div>

                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->

</section>
