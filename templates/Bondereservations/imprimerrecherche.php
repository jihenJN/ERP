<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('isolmax'); ?>
<div style="display:flex">
    <div style="margin-left:1%">
        <?php
        echo $this->Html->image('m.png', ['alt' => 'CakePHP', 'height' => '100px', 'width' => '200px']); ?>
    </div>
    <div style="margin-left:50%">
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
    <section>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div align=" center">
                        <span align="center" style="padding: 10px; border: 2px solid ">
                            Liste des Bon de Reservations </span>

                    </div>
                </div>
            </div>

        </div>
    </section><br>
    <section>

        <div>
            <div class="box-header with-border">
            </div>
            <div class="box-body">
                <table width="90%" style=" border: 2px solid black;
                border-collapse: collapse;padding: 20px;" align="center">



                    <tr>
                        <th style=" border: 2px solid black;  border-collapse: collapse;padding: 20px;">Client</th>
                        <th style=" border: 2px solid black;  border-collapse: collapse;padding: 20px;">Date</th>
                        <th style=" border: 2px solid black;  border-collapse: collapse;padding: 20px;">Depot</th>
                        <th style=" border: 2px solid black;border-collapse: collapse;padding: 20px;">Point de vente</th>


                    </tr>


                    <?php foreach ($bondereservationss as $bondereservation) : ?>
                        <tr>
                            <td style=" border: 2px solid black;  border-collapse: collapse;padding: 20px;">
                                <?= h($bondereservation->client->Contact) ?>
                            </td>


                            <td style=" border: 2px solid black; border-collapse: collapse;padding: 20px;">
                                <?= h($bondereservation->date) ?>
                            </td>


                            <td style=" border: 2px solid black; border-collapse: collapse;padding: 20px;">
                                <?= h($bondereservation->depot->name) ?>
                            </td>
                            <td style=" border: 2px solid black;  border-collapse: collapse;padding: 20px;">
                                <?= h($bondereservation->pointdevente->name) ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>


                    </td>
                    </tr>
                </table>

            </div>

        </div>
    </section>
    <!-- /.box -->
</section>




<!-- /.row -->