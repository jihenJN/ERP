<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Carnetcheque $carnetcheque
 * @var \Cake\Collection\CollectionInterface|string[] $comptes
 */
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('dalanda'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
    <h1>
        Carnet Chéque
        <small><?php //echo __('Ajouter'); 
                ?></small>
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
                        echo $this->Form->control('numero', ['readonly', 'label' => 'Numero', 'id' => 'numero', 'value' => $mm]);
                        ?>
                    </div>

                    <div class="col-xs-6">
                        <?php

                        echo $this->Form->control('compte_id', array('label' => 'Compte', 'class' => 'form-control select2', 'options' => $comptes,  'name' => 'compte_id', 'id' => 'compte_id', 'champ' => 'compte_id', 'empty' => 'Veuillez choisir !!', 'div' => 'form-group', 'between' => '<div class="col-sm-12" >', 'after' => '</div>'));
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
                            'empty' => 'Veuillez choisir !!',
                            'options' => $banques,
                            'class' => ' form-control select2',
                            'name' => 'banque_id',
                            'label' => 'Banque',
                            'id' => 'banque',
                            'type' => '',
                            'class' => 'form-control select2 banque'
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

                    <button type="submit" class="pull-right btn btn-success testchamp" id="controlecheque" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    <?php echo $this->Form->end(); ?>
                </div>

                <!-- /.box-body -->


            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>

<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.testchamp').on('click', function() {

            
            numero = $('#numero').val();

            // index = Number($('#index').val());

            compte = $('#compte_id').val();
            nombre = $('#nombre').val();
            debut = $('#debut').val();
            taille = $('#taille').val();
            // ajouterId = $('#ajouter_lignebanque').val();

            if (numero == "") {
                alert('Ajouter le numero');
                return false;
            } else if (compte == "") {
                alert('Ajouter un compte');
                return false;
            } else if (nombre == "") {
                alert('Ajouter le nombre');
                return false;
            } else if (debut == "") {
                alert('Ajouter le debut');
                return false;
            } else if (taille == "") {
                alert('Ajouter le taille');
                return false;
            }



        });
    });
</script>
<script>
    $(document).ready(function() {

        $('#controlecarnet').on('click', function() {
            // alert('ffffffffffffffffff');
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
<script language="JavaScript" type="text/javascript">
    $(function() {
        $('.deleteConfirm').on('click', function() {

            return confirm('Voulez vous supprimer cette enregistrement? ');

        });


    });
</script>
<?php $this->end(); ?>