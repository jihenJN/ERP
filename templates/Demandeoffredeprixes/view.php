<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Demandeoffredeprix $demandeoffredeprix
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Consultation Demandeoffredeprix
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $typeof]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">

        <div class="box-body">
            <div class="row">

                <?php echo $this->Form->create($demandeoffredeprix, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
                <div class="box-body">
                    <div class="col-xs-6">
                        <?php echo $this->Form->control('date', ["readonly" => true, 'label' => 'Date', 'empty' => true, 'id' => 'date', 'class' => "form-control pull-right"]); ?>

                        <?php echo $this->Form->control('id', ["readonly" => true, 'label' => 'id', 'empty' => true, 'id' => 'id', 'type' => 'hidden', 'class' => "form-control pull-right"]); ?>




                    </div>
                    <div class="col-xs-6">
                        <?php echo $this->Form->control('numero', ['readonly' => 'readonly']); ?>

                    </div>

                    <div class="col-xs-6">
                        <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
                    </div>


                </div>

                <!-- /.box-body -->




             





                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Les fournisseurs'); ?></h1>
                </section>

                <section class="content" style="width: 99%">

<div class="tab-content" id="fichart">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= __('Fournisseurs') ?></h3>
            <a class="btn btn-primary ajouterlignematriceee" table="addtablea" index="index" tr="tra"
               style="float: right; position: relative; top: -25px; pointer-events: none; opacity: 0.5;">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-bottomless" id="addtablea"
                   style="width:100%" align="center">
                <thead>
                    <tr bgcolor="#EDEDED">
                        <td align="center">Fournisseur</td>
                        <td align="center"></td>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through existing 'lignedemandeoffredeprixes' -->
                    <?php foreach ($demandeoffredeprix->lignedemandeoffredeprixes as $index => $ligne) : ?>
                        <tr champ="tra" class="tra">
                            <td align="left">
                                <?= $this->Form->hidden("lignedemandeoffredeprixes.$index.id", ['value' => $ligne->id]) ?>
                                <div style="margin-top:10px">
                                    <?= $this->Form->control("lignedemandeoffredeprixes.$index.fournisseur_id", [
                                        'options' => $fournisseurs,
                                        'label' => false,
                                        'empty' => 'Veuillez choisir',
                                        'class' => 'form-control',
                                        'value' => $ligne->fournisseur_id
                                    ]) ?>
                                </div>
                            </td>
                          
                        </tr>

                        <tr class="traa" champ='traa'>
                            <td width='30%'></td>
                            <td champ="afef" class="afef" colspan="3">
                                <div class="panel panel-default">
                                    <div class="panel-heading" >
                                        <h3 class="panel-title"><?= __('Article') ?></h3>
                                        <a class="btn btn-primary ajouterligne1" tabletype='addtableaa'
                                           indexlignetype='indexa' trtype="traaa"
                                           style="float: right; position: relative; top: -25px; pointer-events: none; opacity: 0.5;">
                                            <i class="fa fa-plus-circle"></i>
                                        </a>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered table-striped table-bottomless"
                                               index="" indexligne='indexa' champ="addtableaa"
                                               style="width:100%" align="center">
                                            <thead>
                                                <tr bgcolor="#EDEDED">
                                                    <td align="center">Article</td>
                                                    <td align="center">Quantité</td>
                                                    <td align="center"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="traaa" champ='traaa'>
                                                    <td>
                                                        <?= $this->Form->control("lignedemandeoffredeprixes.$index.article_id", [
                                                            'options' => $articles,
                                                            'label' => false,
                                                            'empty' => 'Veuillez Choisir',
                                                            'class' => 'form-control',
                                                            'value' => $ligne->article_id
                                                        ]) ?>
                                                    </td>
                                                    <td>
                                                        <?= $this->Form->control("lignedemandeoffredeprixes.$index.qte", [
                                                            'label' => false,
                                                            'class' => 'form-control',
                                                            'value' => $ligne->qte
                                                        ]) ?>
                                                    </td>
                                                   
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" value="-1" class="" champ="indexa" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <!-- Template row for adding new fournisseurs (Hidden for JS cloning) -->
                    <tr class="tra" champ="tra" style="display:none;">
                        <td align="left">
                            <?= $this->Form->hidden('lignedemandeoffredeprixes.__INDEX__.id', ['value' => '']) ?>
                            <div style="margin-top:10px">
                                <?= $this->Form->control('lignedemandeoffredeprixes.__INDEX__.fournisseur_id', [
                                    'options' => $fournisseurs,
                                    'label' => false,
                                    'empty' => 'Veuillez choisir',
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                        </td>
                       
                    </tr>

                </tbody>
            </table>
            <input type="hidden" value="-1" id="index" />
        </div>
    </div>
</div>

</section>














































                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>

<script>
    $(document).ready(function() {
        // Disable all input and select elements
        $('input, select , textarea').prop('disabled', true);
    });
</script>