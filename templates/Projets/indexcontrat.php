<?php error_reporting(E_ERROR | E_PARSE);

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default'); ?>
<section class="content-header">
    <header align="center">
        <h1> Liste des contrats</h1>
    </header>
    <div class="pull-left" style="margin-left:10px;">
        <?php echo $this->Html->link(__('Nouveau Contrats'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']);
        ?>
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
                <?php echo $this->Form->create($contrat, ['type' => 'get']); ?>
                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('client_id', ['empty' => 'veuillez choisir', 'label' => 'Tiers', 'required' => 'off', 'value' => $this->request->getQuery('client_id')]); ?>
                </div>
                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('projet_id', ['empty' => 'veuillez choisir', 'label' => 'Projets', 'required' => 'off', 'value' => $this->request->getQuery('projet_id')]); ?>
                </div>
                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('ref_client', ['label' => 'Ref_client', 'required' => 'off', 'value' => $this->request->getQuery('ref_client')]); ?>
                </div>

                <div class="col-xs-6">
                    <?php
                    echo $this->Form->control('ref_fournisseur', ['label' => 'Ref_fournisseur', 'required' => 'off', 'value' => $this->request->getQuery('ref_fournisseur')]); ?>
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
                            <?= ('Numero') ?>
                        </th>
                        <th scope="col">
                            <?= ('Projet') ?>
                        </th>
                        <th scope="col">
                            <?= ('Ref_client') ?>
                        </th>
                        <th scope="col">
                            <?= ('Ref_fournisseur') ?>
                        </th>
                        <th scope="col">
                            <?= ('Tiers') ?>
                        </th>
                        <th scope="col">
                            <?= ('Commercial de suivi') ?>
                        </th>
                        <th scope="col">
                            <?= ('Commercial signature de contrat') ?>
                        </th>
                        <th scope="col" class="actions text-center">
                            <?= __('Actions') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach ($contrats as $contrat) :
                        $commercial_suivi_id = $contrat->commercial_suivi_id;
                        $query = $connection->prepare('SELECT nom FROM personnels WHERE id = :id');
                        $query->bindValue('id', $commercial_suivi_id, 'integer');
                        $query->execute();
                        $commercial_suivi_id_name = $query->fetchAll('assoc');

                        $commercial_signataire_contrat_id = $contrat->commercial_signataire_contrat_id;

                        $query2 = $connection->prepare('SELECT nom FROM personnels WHERE id = :id');
                        $query2->bindValue('id', $commercial_signataire_contrat_id, 'integer');
                        $query2->execute();
                        $commercial_signataire_contrat_id_name = $query2->fetchAll('assoc');


                    ?>

                        <tr>
                            <td>
                                <?= $contrat->numero ?></td>
                            </td>
                            <td>
                                <?= $contrat->projet->name ?></td>
                            </td>
                            <td>
                                <?= $contrat->ref_client ?></td>
                            </td>
                            <td>
                                <?= $contrat->ref_fournisseur ?></td>
                            </td>
                            <td>
                                <?= $contrat->client->nom ?></td>
                            </td>

                            <td>
                                <?= $commercial_suivi_id_name[0]['nom'] ?></td>
                            </td>
                            <td>
                                <?= $commercial_signataire_contrat_id_name[0]['nom'] ?></td>
                            </td>

                            <td class="actions text" align="center">
                                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $contrat->id), array('escape' => false)); ?>
                                <?php /* if ($edit == 1) { */
                                echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $contrat->id), array('escape' => false));
                                ?>
                                <?php /* if ($delete == 1) { */
                                echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteCon'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $contrat->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $contrat->id));
                                ?>
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