<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->script('khouloud'); ?>
<?php echo $this->Html->css('select2'); ?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ordrefabrication $ordrefabrication
 * @var \Cake\Collection\CollectionInterface|string[] $depots
 * @var \Cake\Collection\CollectionInterface|string[] $pointdeventes
 * @var \Cake\Collection\CollectionInterface|string[] $articles
 */
?>

<section class="content-header">
    <h1>


        Ajout Etape

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <?php echo $this->Form->create(($etape), ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box ">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->



                    <div class="box-body">
                      <div class="row">
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('numero', ['label' => 'Numéro', 'required' ,'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly', 'value' => $mm]); ?>


                            </div>
                        
                             <div class="col-xs-6">

                            <?php echo $this->Form->control('personnel_id', ['required', 'id' => 'personnel_id', 'label' => 'Personnel', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
                        </div>  

                          
 

                        </div>

                        <br>
                        <div class="row">
                               <div class="col-xs-6">

                            <?php echo $this->Form->control('machine_id', ['required', 'id' => 'machine_id', 'label' => 'Machine', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
                        </div> 
                            <div class="col-xs-6">

                                <?php echo $this->Form->control('rang', ['required', 'id' => 'rang', 'label' => 'Rang', 'div' => 'form-group', 'between' => '<div class="col-sm-10" >', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')"]); ?>
                            </div>
                        </div>


                        <div align="center">
                        <button type="submit" class="pull-right btn btn-success btn-sm verifetapes "  style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    </div>

                        <br>

                       
                        

                        <?php echo $this->Form->end(); ?>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>


<!-- <style>
    .select2-selection__rendered {
        line-height: 25px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        border-color: #D2D6DE !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-selection__choice {
        height: 24px !important;
        color: black !important;
        background-color: white !important;
        font-size: 18px !important;
    }

    .select2-container {
        display: block;
        width: auto !important;
    }
</style> -->
<style>
input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
}
input[type="number"] {
    -moz-appearance: textfield;
}

</style>


<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>


<?php $this->end(); ?>