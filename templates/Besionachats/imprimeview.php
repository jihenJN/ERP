<?php $this->layout = 'AdminLTE.print';

use Cake\Datasource\ConnectionManager;
?>
<br>
<style>
    #demandetable {
        width: 100%;
        border-collapse: collapse;
    }

    #demandetable th,
    #demandetable td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
    }

    @media print {

        #demandetable,
        #demandetable th,
        #demandetable td {
            border: 1px solid black;
        }

        .signature-table {
        width: 100%;
        padding: 10px;
        margin-top: auto; /* Push the table to the bottom */
        bottom: 70px; /* Distance from the bottom of the page */
    }
    
    }

    body {
        font-size: 12px;
    }

    table {
        font-size: 12px;
    }



    @media print {
        @page {
            size: A4 landscape;
            margin: 5mm;
        }

        body {
            margin: 0;
            padding: 0;
        }
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>



<div style="display:flex;">
    <table border="1" cellpadding="0" cellspacing="0" style="border: 2px solid #002E50; border-top:none;border-left:none;border-right:none;border-collapse: collapse; width: 100%; ">


        <td align="center" style="width: 25%;border: none;">
            <div>
                <?php
                echo $this->Html->image('logoSMBM.png', ['alt' => 'CakePHP', 'height' => '100px', 'width' => '100%']); ?>
            </div>
        </td>

        <td align="center" style="width: 50%; border: none; font-weight: bold;">
            <h1> <?php echo "Demande d'Achat N°: " . $besionachat->numero ?></h1>
        </td>
        <td align="center" style="width: 25%;border: none;">
            <div>
                <?php
                // echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); 
                ?>

            </div>
        </td>


    </table>
</div>
<br><br>

<div class="page">
    &nbsp;&nbsp; &nbsp; Date Demande: <?php
                                        echo $this->Time->format($besionachat->date, 'dd/MM/y HH:mm:ss');
                                        ?>
    <br>
    <hr align="left" width="25%">
    <br>
    <table id="demandetable" width="100">


        <tr>
            <th rowspan="2">Réf Article</th>
            <th rowspan="2">Désignation</th>
            <th rowspan="2">Qte</th>
            <th rowspan="2">Demandeur</th>
            <th rowspan="2">Signature</th>
            <th colspan="<?php echo $count; ?>">Achat destiné pour</th>
            <th rowspan="2">Date liv. Souhaité</th>
            <th rowspan="2">Qte Stock réel</th>
            <th rowspan="2">Signature MG</th>
        </tr>
        <tr>
            <?php foreach ($services as $s => $service) {
            ?>
                <th>
                    <?php echo $service->name; ?>
                </th>


            <?php
            } ?>
        </tr>

        <?php foreach ($lignebesionachats as $lb => $ligne) { ?>
            <tr>
                <td>
                    <?php echo $ligne->article->Code; ?>
                </td>
                <td>
                    <?php echo $ligne->article->Dsignation; ?>
                </td>
                <td>
                    <?php echo $ligne->qte; ?>
                </td>
                <td>
                    <?php echo $besionachat->personnel->nom; ?>
                </td>
                <td>
                </td>

                <?php foreach ($services as $s => $service) {
                ?>
                    <td>
                        <?php if ($service->id == $besionachat->service_id) {
                            echo 'X';
                        } ?>

                    </td>


                <?php
                } ?>

                <td>
                    <?php echo $this->Time->format($besionachat->echeance, 'dd/MM/y'); ?>
                </td>

                <td>
                    <?php echo $ligne->qteStock; ?>
                </td>
                <td>

                </td>
            </tr>
        <?php } ?>
    </table>

    <br><br>
    <table class="signature-table" width="100%" style=" padding: 10px;">
    <tr>
        <td colspan="2" >
            Signature
        </td>
    </tr>
    <tr>
        <td style="padding-left: 10px;">
            Service Achat
        </td>
        <td style="text-align: right; padding-right: 10px;">
            Direction Générale
        </td>
    </tr>
</table>


</div>


</div>