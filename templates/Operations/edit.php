<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Operation $operation
 */
?>
<section class="content-header">
    <h1>
     Opération 
      <small><?php echo __('Modifier'); ?></small>
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
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __(''); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
         
          <?php echo $this->Form->create($operation, ['role' => 'form']); ?>
                <div class="box-body">
                    <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('name', ['label' => 'Nom']);
                            ?>
                        </div>
                    
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('datevaleur', ['empty' => true,'label' => 'Date Valeur']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('datedebut', ['empty' => true,'label' => 'Date Debut']);
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
              
                        <button type="submit" class="pull-right btn btn-success" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        <?php echo $this->Form->end(); ?>
                    </div>

                    <!-- /.box-body -->


                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
</section>
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