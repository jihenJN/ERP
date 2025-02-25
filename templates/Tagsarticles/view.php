<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tagsarticle $tagsarticle
 * @var string[]|\Cake\Collection\CollectionInterface $listetags
 */
?>
<section class="content-header">
    <h1>
        Visualiser Tags/Produits
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
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
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($tagsarticle, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>


                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('article_id', ['empty' => 'veuillez choisir !!!', 'label' => 'Produit', 'required' => 'off', 'id' => 'code', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'style' => "pointer-events: none;", 'readonly', 'type' => '']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('listetag_id', ['empty' => 'veuillez choisir !!!', 'required' => 'off', 'id' => 'listetag', 'style' => "pointer-events: none;", 'readonly', 'label' => 'Tag']); ?>
                        </div>
                    </div>

                    <div align="center">

                        <?php echo $this->Form->end(); ?>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
</section>