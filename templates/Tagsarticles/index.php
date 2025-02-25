<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tagsarticle> $tagsarticles
 */
?>
<section class="content-header">
    <header align="center">
        <h1> Liste des Tags/Produits</h1>
    </header>
    <?php
    $add = "";
    $edit = "";
    $delete = "";
    $view = "";
    $session = $this->request->getSession();
    $abrv = $session->read('abrvv');
    $lien = $session->read('lien_articles' . $abrv);
    // debug($lien);die;
    foreach ($lien as $k => $liens) {
        if (@$liens['lien'] == 'article') {
            $add = $liens['ajout'];
            $edit = $liens['modif'];
            $delete = $liens['supp'];
        }
    }
    if ($add == 1) { ?>
        <div class="pull-left" style="margin-left:10px;">
        <?php echo $this->Html->link(__('Nouveau Tags/Produit'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']);
    } ?>
        </div>
</section>
<br>
<br>
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <div class="row">
                <?php echo $this->Form->create($tagsarticles, ['type' => 'get']); ?>
                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('article_id', ['label' => 'Produit', 'required' => 'off', 'value' => $this->request->getQuery('article_id')]); ?>
                </div>
                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('listetag_id', ['label' => 'Liste des Tag', 'required' => 'off', 'value' => $this->request->getQuery('listetag_id')]); ?>
                </div>

                <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                    <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
                    <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</section>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th scope="col">
                            <?= ('Produit') ?>
                        </th>
                        <th scope="col">
                            <?= ('Tags') ?>
                        </th>
                        <th scope="col" class="actions text-center">
                            <?= __('Actions') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tagsarticles as $i => $tagsarticle) :
                    ?>
                        <tr>
                            <td>
                                <?= h($tagsarticle->article->Dsignation) ?>
                            </td>
                            <td>
                                <?= h($tagsarticle->listetag->tag) ?>
                            </td>
                            <td class="actions text" align="center">
                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $tagsarticle->id), array('escape' => false)); ?>
                                <?php if ($edit == 1) {
                                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $tagsarticle->id), array('escape' => false));
                                } ?>
                                <?php if ($delete == 1) {
                                    echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteCon'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $tagsarticle->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $tagsarticle->id));
                                } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $(".deletecon").on("click", function() {
        return confirm(" هل تريد حذف هذا التسجيل !!  ");
    });
</script>