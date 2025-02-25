<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Compte $compte
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Compte
        <small><?php echo __('Consultation'); ?></small>
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
                <?php echo $this->Form->create($compte, ['role' => 'form']); ?>
                <div class="box-body">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('numero', ['readonly' => 'readonly', 'label' => 'Numéro']);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('date', ['class' => 'form-control', 'readonly' => 'readonly']);
                            //echo $this->Form->control('numero', ['value' => $mm, 'readonly' => 'readonly']);
                            ?>

                        </div>
                        <div class="col-md-6">
                            <?php

                            echo $this->Form->control('agence_id', array(
                                'empty' => 'Veuillez choisir !!', 'options' => $agences, 'disabled' => 'disabled', 'class' => ' form-control ', 'name' => 'agence_id', 'label' => 'Agences', 'id' => 'agence_id', 'type' => '', 'class' => 'form-control  '
                            ));
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php

                            echo $this->Form->control('banque_id', array(
                                'empty' => 'Veuillez choisir !!', 'options' => $banques, 'class' => ' form-control ','disabled' => 'disabled', 'name' => 'banque_id', 'label' => 'Banque', 'id' => 'banque_id', 'type' => '', 'class' => 'form-control '
                            ));
                            ?>

                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('montant', ['label' => 'Solde', 'readonly']);
                            ?>
                        </div>
                    </div><br><br><br>

                    <table class="table table-bordered table-striped table-bottomless" id="idtable3">
                        <thead>

                            <tr width:20px>

                                <td align="center" style="width: 10%; font: size 20px;"><strong>Type Crédit</strong></td>





                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php if (!empty($lignecompte)) :  ?>
                                    <?php $j = 0;
                                    foreach ($lignecompte as $i => $res) :
                                        //  debug($res);
                                        $j++;
                                        //dd($res)    ;
                                    ?>




                                        <td align="center">
                                            <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>

                                            <?php echo $this->Form->control('compte_id', array('label' => '', 'readonly' => 'readonly', 'value' => $res->compte_id, 'name' => 'data[ligner][' . $i . '][compte_id]', 'type' => 'hidden', 'id' => 'compte_id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>


                                            <?php echo $this->Form->input('id', array('label' => '', 'readonly' => 'readonly', 'value' => $res->id, 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>


                                            <?php   //$connection = ConnectionManager::get('default');



                                            echo $this->Form->control('typecredit_id', array('empty' => 'Veuillez choisir !!', 'type' => '', 'disabled' => 'disabled', 'label' => '', 'options' => $typecredits, 'value' => $res->typecredit_id, 'name' => 'data[ligner][' . $i . '][typecredit_id]',  'id' => 'typecredit_id' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'class' => 'form-control'));
                                            ?>

                                        </td>






                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>



                        </tbody>


                    </table>

                    <br>
                    <?php echo $this->Form->end(); ?>
                </div>
                <!-- /.box-body -->


            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>