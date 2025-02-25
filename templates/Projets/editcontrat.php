<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tagsarticle $tagsarticle
 * @var string[]|\Cake\Collection\CollectionInterface $listetags
 */
?>
<section class="content-header">
    <h1>
        Modification Contrat
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'vieww/', $project_id]); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <?php echo $this->Form->create($contrat, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6" style="color: blue">
                            <?php echo $this->Form->control('numero', ['label' => 'Réf.', 'required' => 'off', 'id' => 'numero', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('ref_client', ['label' => 'Ref.client', 'required' => 'off', 'id' => 'ref_client', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('ref_fournisseur', ['label' => 'Ref_fournisseur', 'required' => 'off', 'id' => 'ref_fournisseur', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '']); ?>
                        </div>
                        <div class="col-xs-6" style="color: blue">
                            <?php echo $this->Form->control('client_id', ['empty' => 'veuillez choisir ??', 'required' => 'off', 'id' => 'client', 'label' => 'Clients']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('remise', ['label' => 'Remise', 'required' => 'off', 'id' => 'remise', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => '']); ?>
                        </div>
                        <div class="col-xs-6" style="color: blue">
                            <?php echo $this->Form->control('commercial_suivi_id', ['empty' => 'veuillez choisir!!!', 'options' => $personnels, 'required' => 'off', 'id' => 'commercial_suivi_id', 'label' => 'Commercial suivi du contrat']); ?>
                        </div>

                        <div class="col-xs-6" style="color: blue">
                            <?php echo $this->Form->control('commercial_signataire_contrat_id', ['empty' => 'veuillez choisir!!!', 'options' => $personnels, 'required' => 'off', 'id' => 'commercial_signataire_contrat_id', 'label' => 'Commercial suivi du contrat']); ?>
                        </div>
                        <div class="col-xs-3" style="color: blue">
                            <?php echo $this->Form->control('date', ['label' => 'Date', 'required' => 'off', 'id' => 'date', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('projet_id', ['empty' => 'veuillez choisir!!!', 'required' => 'off', 'id' => 'projet_id', 'label' => 'Projets']); ?>
                        </div>
                        <div class="col-xs-6">
                            <label> Note Prive </label>
                            <form>
                                <textarea id="note_prive" name="note_prive" rows="10" cols="80"><?= $contrat->note_prive ?></textarea>
                            </form>
                        </div>
                        <div class="col-xs-6">
                            <label> Note publique </label>
                            <form>
                                <textarea id="note_publique" name="note_publique" rows="10" cols="80"><?= $contrat->note_publique ?></textarea>
                            </form>
                        </div>
                    </div>
                    <div align="center">
                        <?php echo $this->Form->submit('Enregistrer', ['id' => 'contrat']); ?></div>

                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
</section>
<!-- bootstrap wysihtml5 - text editor -->
<?php echo $this->Html->css('AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min', ['block' => 'css']); ?>

<!-- CK Editor -->
<?php echo $this->Html->script('AdminLTE./bower_components/ckeditor/ckeditor', ['block' => 'script']); ?>
<!-- Bootstrap WYSIHTML5 -->
<?php echo $this->Html->script('AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {
        CKEDITOR.replace('note_prive')
        $('.textarea').wysihtml5()

    })
    $(function() {

        CKEDITOR.replace('note_publique')
        $('.textarea').wysihtml5()

    })
</script>
<?php $this->end(); ?>