<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Personnel $personnel
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
    <h1>
        Personnel
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
                <?php echo $this->Form->create($personnel, ['role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('pointdevente_id', ['label' => 'Site', 'options' => $pointdeventes, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('fonction_id', ['options' => $fonctions, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('sexe_id', ['options' => $sexes, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('situationfamiliale_id', ['label' => 'Situation Familiale', 'options' => $situationfamiliales, 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php echo $this->Form->control('dateentre', ['label' => 'Date Entree', 'empty' => true, 'class' => "form-control pull-right"]);
                            ?>

                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('nom'); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('prenom'); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('code', ['value' => $code, 'label' => 'Code', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '', 'readonly' => 'readonly']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('nombreenfant', ['label' => 'Nombre Enfant']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('matriculecnss', ['label' => 'Matricle CNSS']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('age'); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('chefdefamille', ['label' => 'Chef De Famille']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('typecontrat_id', ['label' => 'Type Contrat', 'options' => $typecontrats, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
                        </div>

                        <div class="col-xs-6">
                            <label> Image </label>
                            <input type="file" name="image_file" class="form-control" id="ArticleImage">
                        </div>
                        <button type="submit" class="pull-right btn btn-success btn-sm " id="testper" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        <?php echo $this->Form->end(); ?>
                    </div>
                    <!-- /testpersonnel.box-body -->


                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('alert'); ?>
<script>
    $('#testper').on('mouseover', function() {
        pointdevente = $('#pointdevente-id').val();
        fonction = $('#fonction-id').val();
        nom = $('#nom').val();
        prenom = $('#prenom').val();
        if (pointdevente === "") {
            alert("Veuillez saisir la point de vente !");
            return false;
        }else
        if (fonction === "") {
            alert("Veuillez saisir la fonction !");
            return false;
        }else
        if (nom === "") {
            alert("Veuillez saisir le nom !");
            return false;
        }else
        if (prenom === "") {
            alert("Veuillez saisir le prenom !");
            return false;
        }
    });
</script>
<script>
    $('.select2').select2()
</script>
<?php $this->end(); ?>