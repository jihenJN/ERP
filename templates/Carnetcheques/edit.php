<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carnetcheque $carnetcheque
 * @var \Cake\Collection\CollectionInterface|string[] $comptes
 */
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('dalanda'); ?>

<section class="content-header">
    <h1>
        Carnet Chéque
        <small><?php //echo __('Ajouter'); ?></small>
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
                <?php echo $this->Form->create($carnetcheque, ['role' => 'form']); ?>
                <div class="box-body">

                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('numero', ['readonly','label' => 'Numero', 'id' => 'numero']);
                        ?>
                    </div>

                    <div class="col-xs-6">
                        <?php

                        echo $this->Form->control('compte_id', array('label' => 'Compte', 'options' => $comptes,'class' => ' form-control ',  'name' => 'compte_id', 'id' => 'compte_id', 'champ' => 'compte_id', 'empty' => 'Veuillez choisir !!', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>', 'empty' => 'Veuillez Choisir !!')); 
                        ?>


                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('debut', ['label' => 'Debut', 'id' => 'debut']);
                        ?>
                    </div>
                    <!-- <div class="col-md-6">
                        <?php

                        echo $this->Form->input('banque_id', array(
                            'empty' => 'Veuillez choisir !!', 'options' => $banques, 'class' => ' form-control ', 'name' => 'banque_id', 'label' => 'Banque', 'id' => 'banque', 'type' => '', 'class' => 'form-control select2 banque'
                        ));
                        ?>
                    </div> -->

                    <div class="col-xs-6" id="divbl"></div>
                 
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('nombre', ['label' => 'Nombre', 'id' => 'nombre']);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('taille', ['label' => 'Taille', 'id' => 'taille']);
                        ?>
                    </div>

                    <button type="submit" class="pull-right btn btn-success" id="controlecheque" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    <?php echo $this->Form->end(); ?>
                </div>

                <!-- /.box-body -->


            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>



<script>
    $(document).ready(function() {

        $('#controlecarnet').on('mouseover', function() {
            alert('ffffffffffffffffff');
            numero = $('#numero').val();

            // index = Number($('#index').val());

            compte = $('#compte_id').val();
            nombre = $('#nombre').val();
            debut = $('#debut').val();
            taille = $('#taille').val();
            // ajouterId = $('#ajouter_lignebanque').val();

            if (numero == "") {
                alert('Ajouter le numero', function() {});
                return false;
            } else if (compte == "") {
                alert('Ajouter un compte', function() {});
            } else if (nombre == "") {
                alert('Ajouter le nombre', function() {});
            } else if (debut == "") {
                alert('Ajouter le debut', function() {});
            } else if (taille == "") {
                alert('Ajouter le taille', function() {});
            }


        });



        $('.banque').on('change', function() {
            // alert('hgggggggggggggg')
            banque_id = $(this).val();
            //alert(client_id);


            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Lignebanques', 'action' => 'getcompte']) ?>",
                dataType: "json",
                data: {
                    banque_id: banque_id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    // alert('success');
                    $('#divbl').html(data.select);
                    $('#compte_id').select2();



                }


            })








        })
    });
</script>
<?php $this->end(); ?>
<?php echo $this->Html->script('alert'); ?>