<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Devi $devi
 */
?>
<!--div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Devi'), ['action' => 'edit', $devi->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Devi'), ['action' => 'delete', $devi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devi->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Devis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Devi'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="devis view content">
            <h3><?= h($devi->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Numero') ?></th>
                    <td><?= h($devi->numero) ?></td>
                </tr>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $devi->has('client') ? $this->Html->link($devi->client->name, ['controller' => 'Clients', 'action' => 'view', $devi->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($devi->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Remise') ?></th>
                    <td><?= $this->Number->format($devi->total_remise) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Ht') ?></th>
                    <td><?= $this->Number->format($devi->total_ht) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($devi->date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div-->

<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Devi $devi
 * @var string[]|\Cake\Collection\CollectionInterface $clients
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Ajout Type Contact
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <?php echo $this->Form->create($devi, ['role' => 'form']); ?>
                <div class="box-body">
                    <div class="row" style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['label' => 'Numéro', 'readOnly' => true]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ['label' => 'Date', 'readOnly' => true]); ?>
                        </div>
                        <br>
                        <div class="col-xs-6">
                            <?= $this->Form->control('client_id', [
                                'label' => 'Client',
                                'options' => $clients,
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'type' => 'select',
                                'disabled' => true
                            ]); ?>


                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="box box-primary">
                            <div class="box-header with-border">


                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table border="1px" class="table table-bordered table-striped table-bottomless"
                                        id="addtable">

                                        <thead>
                                            <tr>
                                                <td align="center" style="width: 12%; font-size: 16px;">
                                                    <strong>Article</strong>
                                                </td>
                                                <td align="center" style="width: 14%;font-size: 16px;"><strong>Prix
                                                        Unitaire</strong></td>
                                                <td align="center" style="width: 8%;font-size: 16px;">
                                                    <strong>Qte</strong>
                                                </td>

                                                <td align="center" style="width: 15%;font-size: 16px;">
                                                    <strong>Remise %</strong>
                                                </td>
                                                <td align="center" style="width: 15%;font-size: 16px;"><strong>Prix
                                                        HT</strong></td>

                                                <td align="center" style="width: 15%;font-size: 16px;"><strong>taux
                                                        TVA %</strong></td>

                                                <td align="center" style="width: 15%;font-size: 16px;"><strong>Prix
                                                        TTC</strong></td>





                                            </tr>
                                        </thead>
                                        <?php $index = 0; ?>
                                        <tbody>
                                            <?php foreach ($lignedevis as $i => $res) : ?>

                                                <tr>

                                                    <td align="center">
                                                        <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                        <?php
                                                        echo $this->Form->input('id', array(
                                                            'champ' => 'id',
                                                            'label' => '',
                                                            'name' => 'data[ligner][' . $i . '][id]',
                                                            'value' => $res->id,
                                                            'type' => 'hidden',
                                                            'id' => '',
                                                            'table' => 'ligner',
                                                            'index' => '',
                                                            'div' => 'form-group',
                                                            'between' => '<div class="col-sm-12">',
                                                            'after' => '</div>',
                                                            'class' => 'form-control'
                                                        ));
                                                        ?>
                                                        <div champ="divart" index="<?= $i ?>" id="divart<?= $i ?>" disabled>

                                                            <select name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" id="<?php echo 'article_id' . $i ?>" table="ligner" index="<?php echo $i ?>" champ="article_id" class="form-control articleidbl1 Testdep single" disabled>
                                                                <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                <?php foreach ($articles as $id => $article) {
                                                                ?>
                                                                    <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>



                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('prix', array('label' => '', 'value' => $res->prix, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index', 'readOnly' => true)); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index', 'readOnly' => true)); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index', 'readOnly' => true)); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('ht', array('label' => '', 'value' => $res->ht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index', 'readOnly' => true)); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index', 'readOnly' => true)); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('ttc', array('label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index', 'readOnly' => true)); ?>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>

                                            <input type="text" value="<?php echo $i; ?>" id="index" style="display: none;">
                                        </tbody>

                                    </table>
                                    <br />

                                </div>


                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Totals Section (Still Inside Box-Body to Ensure It Works) -->
                    <div class="row" style="text-align: right" ;>
                        <div class="col-xs-12">
                            <div class="form-inline">

                                <label style="text-align: end;">Total Brute</label>
                                <?php echo $this->Form->control('total_brute', ['label' => false, 'readonly' => true, 'class' => 'form-control']); ?>
                            </div>
                        </div>
                        <br>
                        <div class="col-xs-12">
                            <div class="form-inline">
                                <label style="text-align: end;">Total Remise</label>
                                <?php echo $this->Form->control('total_remise', ['label' => false, 'readonly' => true, 'class' => 'form-control']); ?>
                            </div>
                        </div>
                        <br>
                        <div class="col-xs-12">
                            <div class="form-inline">

                                <label style="text-align: end;">Total HT</label>
                                <?php echo $this->Form->control('total_ht', ['label' => false, 'readonly' => true, 'class' => 'form-control']); ?>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-inline">

                                <label style="text-align: end;">Total TVA</label>
                                <?php echo $this->Form->control('total_tva', ['label' => false, 'readonly' => true, 'class' => 'form-control']); ?>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-inline">

                                <label style="text-align: end;">Total TTC</label>
                                <?php echo $this->Form->control('total_ttc', ['label' => false, 'readonly' => true, 'class' => 'form-control']); ?>
                            </div>
                        </div>



                    </div>

                </div>

            </div>
        </div>
    </div>
</section>




<?php echo $this->Form->end(); ?>
</div>

<!-- /.box-body -->


</div>
<!-- /.box -->
</div>
</div>
<!-- /.row -->
</section>