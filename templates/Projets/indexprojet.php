<?php

use Cake\Datasource\ConnectionManager;
use function PHPSTORM_META\type;
use Cake\ORM\TableRegistry;

error_reporting(E_ERROR | E_PARSE);
?><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('js_vieww_projet'); 

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$domainName = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

$baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

$wr = $protocol . $domainName.$baseSegment;
?>
<br>
<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Projets</h1>
    </header>
</section>
<section class="content-header">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <tr class="liste_titre">
                        <td colspan="3">
                            <div style="float: left;font-size: 14px;"><strong>Statistiques - Montant des opportunités ouvertes par statut</strong></div>
                        </td>
                    </tr>
                </div>
                <div class="box-body">
                    <canvas id="tiersChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <tr class="liste_titre">
                        <td colspan="3">
                            <div style="float: left;font-size: 14px;"><strong>Les projets brouillon</strong></div>
                            <div style="float: right;font-size: 14px;"><a href="<?php echo $wr; ?>/projets/index"><strong>Liste complète</strong></a></div>
                        </td>
                    </tr>
                </div>
                <div class="box-body">
                    <table id="" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th scope="col" style="font-size: 14px;">
                                    <?= ('Réf.') ?>
                                </th>
                                <th scope="col" style="font-size: 14px;">
                                    <?= ('Libellé') ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projetProspections as $i => $projetProspection) : ?>
                                <tr>
                                    <td hidden>
                                        <?= h($projetProspection->id) ?>
                                    </td>
                                    <td class="afficherindexprojet" id="idligne<?php echo $projetProspection['id']; ?>" index="<?php echo $projetProspection['id']; ?>" style="font-size: 14px;">
                                        <?= h($projetProspection->name) ?>
                                    </td>
                                    <td class="afficherindexprojet" id="idligne<?php echo $projetProspection['id']; ?>" index="<?php echo $projetProspection['id']; ?>" style="font-size: 14px;">
                                        <?= h($projetProspection->libelle) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <tr class="liste_titre">
                    <td colspan="3">
                        <div style="float: left;font-size: 14px;"><strong>Liste des projets </strong></div>
                        <div style="float: right;font-size: 14px;"><a href="<?php echo $wr; ?>/projets/index"><strong>Liste complète</strong></a></div>
                    </td>
                </tr>
            </div>
            <div class="box-body">
                <table id="" class="table table-bordered table-striped ">
                    <thead>
                        <tr>
                            <th scope="col" style="font-size: 14px;">
                                <?= ('Projets Brouillon.   ');
                                echo ($projetcount); ?>
                            </th>
                            <th scope="col" style="font-size: 14px;">
                                <?= ('Tiers') ?>
                            </th>
                            <th scope="col" style="font-size: 14px;">
                                <?= ('Montant opportunité') ?>
                            </th>
                            <th scope="col" style="font-size: 14px;">
                                <?= ('Statut opportunité') ?>
                            </th>
                            <th scope="col" style="font-size: 14px;">
                                <?= ('Tâches') ?>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($projets as $i => $projet) :
                            $projet_id = $projet->id;
                            if ($projet_id) {
                                $tacheprojetsTable = TableRegistry::getTableLocator()->get('Tacheprojets');
                                $tacheprojets = $tacheprojetsTable->find('all')
                                    ->where(['projet_id' => $projet_id])
                                    ->toArray();
                                $nombre_taches = count($tacheprojets);
                            }

                        ?>
                            <tr>
                                <td class="afficherprojets" id="idligne<?php echo $projet['id']; ?>" index="<?php echo $projet['id']; ?>" style="font-size: 14px;">
                                    <?= h($projet->libelle) ?>
                                </td>
                                <td class="afficherprojets" id="idligne<?php echo $projet['id']; ?>" index="<?php echo $projet['id']; ?>" style="font-size: 14px;">
                                    <?= h($projet->client->nom) ?>
                                </td>
                                <td class="afficherprojets" id="idligne<?php echo $projet['id']; ?>" index="<?php echo $projet['id']; ?>" style="font-size: 14px;">
                                    <?= h($projet->montant) ?>
                                </td>
                                <td class="afficherprojets" id="idligne<?php echo $projet['id']; ?>" index="<?php echo $projet['id']; ?>" style="font-size: 14px;">
                                    <?= h($projet->opportunite->name) ?>
                                </td>
                                <td class="afficherprojets" id="idligne<?php echo $projet['id']; ?>" index="<?php echo $projet['id']; ?>" style="font-size: 14px;">
                                    <?= h($nombre_taches) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <tr class="liste_titre">
                        <td colspan="3">
                            <div style="float: left;font-size: 14px;"><strong>Projets ouverts par tiers</strong></div>
                            <div style="float: right;font-size: 14px;"><a href="<?php echo $wr; ?>/projets/index"><strong>Liste complète</strong></a></div>
                        </td>
                    </tr>
                </div>
                <div class="box-body">
                    <table id="" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th scope="col" style="font-size: 14px;">
                                    <?= ('Projets.') ?>
                                </th>
                                <th scope="col" style="font-size: 14px;">
                                    <?= ('Tiers.') ?>
                                </th>
                                <!-- <th scope="col" style="font-size: 14px;">
                                <?= ('Nbre Projets') ?>
                            </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listeProjetParClients as $i => $listeProjetParClient) :
                            ?>
                                <tr>
                                    <td style="font-size: 14px;">
                                        <?php $client_id = $listeProjetParClient['client_id'];
                                        $connection = ConnectionManager::get('default');
                                        $query = "SELECT nom FROM clients WHERE id = $client_id;";
                                        $client_name = $connection->execute($query)->fetchAll('assoc');
                                        echo ($client_name['0']['nom']);
                                        ?>

                                    </td>
                                    <td style="font-size: 14px;">
                                        <?= h($listeProjetParClient['nombre_de_projets']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <tr class="liste_titre">
                        <td colspan="3">
                            <div style="float: left;font-size: 14px;"><strong>Les 3 derniers projets modifiés</strong></div>
                            <div style="float: right;font-size: 14px;"><a href="<?php echo $wr; ?>/projets/index"><strong>Liste complète</strong></a></div>
                        </td>
                    </tr>
                </div>
                <div class="box-body">
                    <table id="" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th scope="col" style="font-size: 14px;">
                                    <?= ('Réf.') ?>
                                </th>
                                <th scope="col" style="font-size: 14px;">
                                    <?= ('Libellé') ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($liste3Projets as $i => $liste3Projet) : ?>
                                <tr>
                                    <td hidden>
                                        <?= h($liste3Projet->id) ?>
                                    </td>
                                    <td class="afficherindexprojet" id="idligne<?php echo $liste3Projet['id']; ?>" index="<?php echo $liste3Projet['id']; ?>" style="font-size: 14px;">
                                        <?= h($liste3Projet['name']) ?>
                                    </td>
                                    <td class="afficherindexprojet" id="idligne<?php echo $liste3Projet['id']; ?>" index="<?php echo $liste3Projet['id']; ?>" style="font-size: 14px;">
                                        <?= h($liste3Projet['libelle']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$connection = ConnectionManager::get('default');
$current_datetime = date('Y-m-d');
$listeProjetParClients = $connection->execute('SELECT client_id, COUNT(*) as nombre_de_projets FROM projets GROUP BY client_id;')->fetchAll('assoc');
$dd = date('Y-m-d');
$data = [];
foreach ($listeProjetParClients as $row) {
    $client_id = $row['client_id'];
    $total_projets = $row['nombre_de_projets'];
    $query = "SELECT nom FROM clients WHERE id = $client_id;";
    $result = $connection->execute($query)->fetch('assoc');
    $client_nom = $result['nom'];
    $data[] = [
        'name' => $client_nom,
        'value' => $total_projets,
    ];
}
?>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('tiersChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_column($data, 'name')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($data, 'value')); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'right'
                }
            }
        });
    });
</script>
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-container {
        display: block;
        width: auto !important;
    }
</style>