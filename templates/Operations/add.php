<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operation $operation
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Opération
        <small><?php echo __('Ajouter'); ?></small>
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
                <?php echo $this->Form->create($operation, ['role' => 'form']); ?>
                <div class="box-body">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('name', ['label' => 'Nom','id'=>'name']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('datedebut', ['empty' => true,'label' => 'Date Debut','id'=>'datedebut']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('datevaleur', ['empty' => true,'label' => 'Date Valeur','id'=>'datevaleur']);
                            ?>
                        </div>
                    
                        <div class="col-md-6">
                            <?php

                            echo $this->Form->control('typeoperation_id', array(
                                'empty' => 'Veuillez choisir !!', 'options' => $typeoperations, 'class' => ' form-control ', 'name' => 'typeoperation_id', 'label' => 'Type Opération', 'id' => 'typeoperation_id', 'type' => '', 'class' => 'form-control select2'
                            ));
                            ?>
                        </div> 
                    </div>
                    <button type="submit" class="pull-right btn btn-success testchamp" id="ctoperation" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                    <?php echo $this->Form->end(); ?>
                </div>

                <!-- /.box-body -->


            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<?php //echo $this->Html->script('alert'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.testchamp').on('click', function() {

            num = $('#name').val();
            datedebut = $('#datedebut').val();
            datevaleur = $('#datevaleur').val();
            typeoperation_id = $('#typeoperation_id').val();

            if (num == '') {
                alert("Ajouter le nom  SVP");
                return false;
            }
            if (datedebut == '') {
                alert("Ajouter la date debut  SVP");
                return false;
            }
            if (datevaleur == '') {
                alert("Ajouter la date valeur  SVP");
                return false;
            }
            if (typeoperation_id == '') {
                alert("Choisir le type d'opération  SVP");
                return false;
            }
         

        });
    });
</script>
<script>
  $(document).ready(function() {

$('#ctoperation').on('mouseover', function () {
    //alert('gggggg');
      nom = $('#name').val();
      //alert(nom);
     // date = $('#date').val();
      date== $('#datevaleur').val();
      dd== $('#datedebut').val();
      type== $('typeoperation_id').val();
      if (nom == "") {
        alert('Ajouter le nom', function () { });
        return false;
    }
      if (date == "") {
          alert('Ajouter la date debut', function () { });
          return false;
      }
      if (dd == "") {
        alert('Ajouter la date valeur', function () { });
        return false;
    }  
    if (type == "") {
        alert('Ajouter la type opération', function () { });
        return false;
    }
   
});
  });
</script>