<?php
error_reporting(E_ERROR | E_PARSE);

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\tag> $tags
 */
?>
<section class="content-header">
    <header align="center">
        <h1> Liste des Tags/Clients</h1>
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
        <?php echo $this->Html->link(__('Nouveau Tags/Clients'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']);
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
                <?php echo $this->Form->create($tag, ['type' => 'get']); ?>
                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('client_id', ['empty' => 'veuillez choisir!!!', 'label' => 'Clients', 'required' => 'off', 'value' => $this->request->getQuery('client_id')]); ?>
                </div>
                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('listetag_id', ['empty' => 'veuillez choisir!!!', 'label' => 'Liste des Tag', 'required' => 'off', 'value' => $this->request->getQuery('listetag_id')]); ?>
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
                            <?= ('Clients') ?>
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
                    <?php foreach ($tags as $i => $tag) :
                    ?>
                        <tr>
                            <td>
                                <?= h($tag->client->nom) ?>
                            </td>
                            <td>
                                <?= h($tag->listetag->tag) ?>
                            </td>
                            <td class="actions text" align="center">
                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $tag->id), array('escape' => false)); ?>
                                <?php if ($edit == 1) {
                                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $tag->id), array('escape' => false));
                                } ?>
                                <?php if ($delete == 1) {
                                    echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteCon'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $tag->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $tag->id));
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
        return confirm(" Est que vous voulez vraiement supprimer !!  ");
    });
</script>