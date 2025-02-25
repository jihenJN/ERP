<?php $this->layout = 'AdminLTE.print'; ?>

<?php error_reporting(E_ERROR | E_PARSE);

use Cake\Datasource\ConnectionManager;


?>

<style>
    body {
        font-size: 12px;
    }

    table {
        font-size: 12px;
    }

    table {
        border-collapse: collapse;

    }

    th,
    td {
        border: 1px solid #000;
        padding: 5px;

    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php
?>

<table border="0" cellpadding="0" cellspacing="0" style="border: 0px solid black; width: 50%; margin: auto;">
    <tr>
        <td align="center" style="width: 30%; border: 0;">
            <div style="margin-top: 5%;">
                <strong>
                    <span style="display: block; font-size: 25px; margin-bottom: 8px;">
                        Etat de Caisse <?php echo ''; ?>
                    </span>
                </strong>
            </div>
        </td>
    </tr>
    <tr>
        <td align="left" style="width: 10%; border: 0;">
            <div style="margin-top: 10%;">

                <span style=" font-size: 16px; margin-bottom: 8px;">
                    Caisse : <?php echo $caissem->name; ?>
                </span>
            </div>
        </td>
    </tr>
    <tr>
        <td align="left" style="width: 5%; border: 0;">
            <div>

                <span style=" font-size: 16px; margin-bottom: 8px;">
                    Du : <?php echo $this->Time->format($this->request->getQuery('historiquede'),'dd/MM/y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Au: <?php echo $this->Time->format($this->request->getQuery('au'),'dd/MM/y') ;  ?>
                </span>
            </div>
        </td>
    </tr>
</table>
<br><br>




<div class="box-body">
    <table>
        <thead>
            <tr>
                <th hidden style="text-align: center;">id</th>
                <th style="text-align: center;width:7%">Type</th>
                <th style="text-align: center;width:24%">Client/Caisses</th>
                <th style="text-align: center;width:6%">Reference</th>
                <th style="text-align: center;width:6%">Piece (BL/BC)</th>

                <th style="text-align: center;width:6%">Mode paiement</th>
                <th style="text-align: center;width:8%">Date</th>
                <th style="text-align: center;width:15%">Observation</th>
                <th style="text-align: center;width:10%">Débit</th>
                <th style="text-align: center;width:10%">Crédit</th>
                <th style="text-align: center;width:12%">Solde</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $totalDebits = 0;
            $totalCredits = 0;
            $total = 0;
            $solde = 0;
         
            usort($clientData, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });
            foreach ($clientData as $i => $data) :
                if ($data['index']==1){
                    $totalDebits = 0;
                    $totalCredits = 0;
                    $total = 0;
                    $solde = 0;
                }
                $totalDebits += $data['debit'];
                $totalCredits += $data['credit'];
            ?>
                <tr>
                    <td hidden></td>
                    <td align="center"> <?php echo ($data['type']) ?> </td>
                    <td align="center">
                        <?php
                        if ($data['index'] == 2) {
                            echo ($data['name']);
                        }
                        if ($data['index'] == 4) {
                            echo ($data['caissedep'] . '=>' . $data['caissearr']);
                        }
                        if ($data['index'] == 5) {
                            echo ($data['caissedep'] . '=>' . $data['caissearr']);
                        }
                        if ($data['index'] == 3) {
                            echo ($data['caissedep']);
                        } ?>
                    </td>
                    <td>
                        <?php echo ($data['num']) ?>
                    </td>

                    <td>
                        <?php
                        if ($data['bl'] != null) {
                            echo ($data['bl']);
                        } else if ($data['cmd'] != null) {
                            echo ($data['cmd']);
                        }
                        ?>
                    </td>
                    <td align="center">
                        <?php echo ($data['paiement_name']) ?>
                    </td>
                    <td align="center">
                        <?php echo $this->Time->format($data['date'], 'dd/MM/y'); ?>
                    </td>
                    <td align="center">
                        <?php echo ($data['observation']) ?>
                    </td>
                    <td style="text-align:right;padding-right:5px">
                        <?php



                        echo sprintf("%01.3f", $data['debit']) ?>
                    </td>
                    <td style="text-align:right;padding-right:5px">

                        <?php
                        if ($data['index'] == 1) {
                        ?>
                            <strong><?php echo sprintf("%01.3f", $data['credit']); ?></strong>
                        <?php } else {
                            echo sprintf("%01.3f", $data['credit']);
                        }

                        $solde += $data['credit'];
                        $solde -= $data['debit'];

                        ?>


                    </td>
                    <td style="text-align:right;padding-right:5px">
                        <?php echo sprintf("%01.3f", $solde); ?>
                    </td>

                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td hidden></td>
                <td colspan="7"></td>

                <td colspan="3" style="width: 100%;">
                    <table style="width: 100%;">
                        <tr>
                            <th colspan="3" style="text-align: center;">Total Période :</th>
                        </tr>
                        <tr>
                            <td style="width: 33%;text-align:right;">
                                <?php echo sprintf("%01.3f", $totalDebits) ?>
                            </td>
                            <td style="width: 33%;text-align:right;">
                                <?php echo sprintf("%01.3f", $totalCredits) ?>
                            </td>
                            <td style="width: 33%;text-align:right;">
                                <?php echo sprintf("%01.3f", $totalCredits-$totalDebits) ?>
                            </td>
                        </tr>
                    </table>
                </td>
               

            </tr>
            <tr class="total-row">
                <td hidden></td>
                <td colspan="7"></td>
                <td colspan="3" style="width: 100%;">
                    <table style="width: 100%;">
                        <tr>
                            <th colspan="3" style="text-align: center;">Total :</th>
                        </tr>
                        <tr>
                            <td style="width: 33%;text-align:right;">
                                <?php echo sprintf("%01.3f", $debit_all) ?>
                            </td>
                            <td style="width: 33%;text-align:right;">
                                <?php echo sprintf("%01.3f", $credit_all) ?>
                            </td>
                            <td style="width: 33%;text-align:right;">
                                <?php echo sprintf("%01.3f", $credit_all-$debit_all) ?>
                            </td>

                        </tr>
                    </table>
                </td>
              

            </tr>

        </tbody>
    </table>

</div>
</div>







<div style="margin-left:25px;">
</div>