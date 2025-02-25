<?php echo $this->Html->css('select2'); ?>

<?php
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

$connection = ConnectionManager::get('default');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<style>
    #example1 {
        border-collapse: collapse;
        border: 2px solid #000;
    }
    #example1 th, #example1 td {
        border: 1px solid #000;
        padding: 8px;
    }
</style>

<section class="content-header">
    <header>
        <h1 style="text-align:center;">Chiffre d'affaire mensuelle par démarcheur</h1>
    </header>
</section>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $this->Form->create(null, ['type' => 'get']); ?>
                <div class="row">
                    <div class="col-xs-6">
                        <?php
                        date_default_timezone_set('Africa/Tunis');
                        $datedebut = date('Y-01-01 00:00:00');
                        echo $this->Form->control('datedebut', [
                            'label' => 'Date début',
                            'value' => $datedebut,
                            'max' => $datedebut,
                            'type' => 'datetime',
                            'readonly' => 'readonly',
                            'empty' => 'Veuillez choisir !!',
                            'class' => 'form-control',
                            'required' => 'off'
                        ]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        $datefin = date('Y-12-t 23:59:59');
                        echo $this->Form->control('datefin', [
                            'label' => 'Date fin',
                            'value' => $datefin,
                            'max' => $datefin,
                            'type' => 'datetime',
                            'readonly' => 'readonly',
                            'empty' => 'Veuillez choisir !!',
                            'class' => 'form-control',
                            'required' => 'off'
                        ]);
                        ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <a onClick="openWindow(1000, 1000, wr+'clients/impetatchiffre?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>')">
                            <button class="btn btn-primary">Imprimer</button>
                        </a>
                        <?php echo $this->Html->link(__('Actualiser'), ['action' => '/etatchiffreaffaire'], ['class' => 'btn btn-primary ']) ?>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<br>
<input type="hidden" id="page" value="1" />
<h3 style="margin-left: 5px;">Etat Chiffre d'affaire</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
            <table class="table table-bordered table-striped table-bottomless" id="example1" border="1"> 
                <thead style='position: sticky; top: 0;'>
                    <tr style="font-style: italic; font-weight: bold;">
                        <td>Démarcheur</td>
                        <?php foreach ($mois as $mm) : ?>
                            <td style="font-size: 16px; background-color: #5f9ea0; color: #000000; font-style: italic; font-weight: bold;" align="center"><?php echo $mm; ?></td>
                        <?php endforeach; ?>
                        <td style="font-style: italic; font-weight: bold;">Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $generaltotaltt = 0;
                    foreach ($clients as $client) : ?>
                        <tr>
                            <td style="background-color: #bc987e; color: #000000;"><?php echo $client->Raison_Sociale; ?></td>
                            <?php
                            $totalClient = 0;
                            foreach ($moiss as $mois_id => $mm) :
                                $mois = $mm->num;
                                $annee_en_cours = date('Y');
                                $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                $listefact = $connection->execute('
                                    SELECT SUM(totalttc) AS sumtotalttc 
                                    FROM factureclients 
                                    WHERE client_id = :client_id
                                    AND date BETWEEN :date_debut AND :date_fin
                                   ', ['client_id' => $client->id, 'date_debut' => $date_debut, 'date_fin' => $date_fin])
                                    ->fetchAll('assoc');

                                $totalm = 0;
                                foreach ($listefact as $row) {
                                    $totalm += $row['sumtotalttc'];
                                }

                                $bonLivraison = $connection->execute('
                                    SELECT SUM(totalttc) AS sumtotalttc 
                                    FROM bonlivraisons 
                                    WHERE client_id = :client_id
                                    AND typebl = 1
                                    AND factureclient_id = 0
                                    AND date BETWEEN :date_debut AND :date_fin', 
                                    ['client_id' => $client->id, 'date_debut' => $date_debut, 'date_fin' => $date_fin])
                                    ->fetchAll('assoc');

                                foreach ($bonLivraison as $row) {
                                    $totalm += $row['sumtotalttc'];
                                }
                                echo "<td>" . ($totalm == 0 ? '' : number_format($totalm, 2)) . "</td>";

                                // echo "<td>" . number_format($totalm, 2) . "</td>";
                                $totalClient += $totalm;
                            endforeach;
                            echo "<td><strong>" . ($totalClient == 0 ? '' : number_format($totalClient, 2)) . "</strong></td>";

                           // echo "<td><strong>" . number_format($totalClient, 2) . "</strong></td>";
                            $generaltotaltt += $totalClient;
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <?php
                        foreach ($moiss as $mois_id => $mm) :
                            $mois = $mm->num;
                            $annee_en_cours = date('Y');
                            $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                            $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                            $listefact22 = $connection->execute('
                                SELECT SUM(totalttc) AS sumtotalttc 
                                FROM factureclients 
                                WHERE date BETWEEN :date_debut AND :date_fin
                                ', ['date_debut' => $date_debut, 'date_fin' => $date_fin])
                                ->fetchAll('assoc');

                            $totalm22 = 0;
                            foreach ($listefact22 as $row) {
                                $totalm22 += $row['sumtotalttc'];
                            }

                            $bonLivraison22 = $connection->execute('
                                SELECT SUM(totalttc) AS sumtotalttc 
                                FROM bonlivraisons 
                                WHERE typebl = 1
                                AND factureclient_id = 0
                                AND date BETWEEN :date_debut AND :date_fin', 
                                ['date_debut' => $date_debut, 'date_fin' => $date_fin])
                                ->fetchAll('assoc');

                            foreach ($bonLivraison22 as $row) {
                                $totalm22 += $row['sumtotalttc'];
                            }

                            echo "<td><strong>" . ($totalm22 == 0 ? '' : number_format($totalm22, 2)) . "</strong></td>";
                        endforeach;
                        ?>
                        <td><strong><?php echo number_format($generaltotaltt, 2); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
</div>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }

    $(function() {
        $('#example2').DataTable()
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
</script>
<?php $this->end(); ?>
