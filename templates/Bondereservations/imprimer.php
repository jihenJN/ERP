<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('isolmax'); ?>
<div style="display:flex">
    <div style="margin-left:1%">
        <?php
        echo $this->Html->image('m.png', ['alt' => 'CakePHP', 'height' => '100px', 'width' => '200px']); ?>
    </div>
    <div style="margin-left:30%">
        Société Laboratoires Grenat <br>
        Route de Teboulbi km 5 <br>
        Phone:20182836 <br>
        Mail :contact@laboratoires-grenat.com <br>
    </div>
</div>
<table width="100%">
    <tr>
        <td width="45%" height="50px">
        </td>
        <td width="55%">
        </td>
    </tr>
    <tr>
        <td colspan="2"><br>
            <hr>
        </td>
    </tr>
    <tr>
        <td width="100%" align="center">
            <span style="font-weight: bold;"> </span>
        </td>
    </tr>
</table>
<br>

<section class="content">
    <div class="row">
        <?php
        foreach ($bondereservationss as $bondereservationss) :
        ?>

            <div style="display:flex">
                <div style="margin-left:1%">
                    <table style=" border: 2px solid black;">
                        <tr>
                            <td style=" width: 500px; height: 100px; ">
                                <b> Bon de reservation N :</b> <?php echo h($bondereservationss->numero); ?></br>
                                <b>Date:</b><?php echo h($bondereservationss->date); ?>
                            </td>
                        </tr>
                    </table>


                </div>
                <div style="margin-left:40%">


                    <table style=" border: 2px solid black; ">
                        <tr>
                            <td style=" width: 400px; height: 100px; ">
                                <div align="center">
                                    <b><?php echo $bondereservationss->client->Contact; ?></b>
                                </div> <br>
                                <b> Adresse : </b>
                                <?php echo $bondereservationss->client->Adresse; ?><br>
                                <b> Matricule fiscale : </b>

                                <?php echo $bondereservationss->client->Matricule_Fiscale; ?><br>
                                <b> Mail : </b>

                                <?php echo $bondereservationss->client->mail; ?><br>
                                <b> Telephone : </b>

                                <?php echo $bondereservationss->client->Tel; ?><br>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>


            <div class="row">


                <?php if (!empty($lignebondereservationss)) : ?>

                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <table class="table table-hover" width="90%" border="3" align="center">
                            <tr>
                                <th scope="col"><?= __('Code') ?></th>
                                <th scope="col"><?= __('Article') ?></th>
                                <th scope="col"><?= __('Qte') ?></th>


                            </tr>

                            <?php foreach ($lignebondereservationss as $lignebondereservation) : ?>
                                <tr>
                                    <td align="center">
                                        <?php echo h($lignebondereservation->article->Code) ?>
                                    </td>
                                    <td align="center">
                                        <?= h($lignebondereservation->article->Dsignation) ?>
                                    </td>
                                    <td align="center">
                                        <?= h($lignebondereservation->quantite) ?>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>
            </div>

            <div class="row">
                <div>
                    <div align=" center" style="margin-left:1%">
                        <table style=" border: 2px solid black;" align="center">
                            <div style=" width: 400px; height: 150px; "></div>

                            <tr>
                                <td style=" width: 250px; height: 30px; ">

                                    <div>
                                        <b>signature:</b>
                                    </div> <br>
                                </td>


                            </tr>
                            <tr style=" width: 400px; height: 100px; "></tr>
                        </table>


                    </div>

                </div>


            </div>


</section>