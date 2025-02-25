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
        <div class="col-md-12">
            <div class="text-center">
                <h3>Clients</h3>
            </div>
            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>

                                <th>Compte Comptable</th>
                                <th>Type utilisateur</th>
                                <th>Mode Paiement</th>


                                <th>Num Registre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientsss as $client) : ?>
                                <tr>
                                    <td><?= h($client->name) ?></td>


                                    <td><?= h($client->comptecomptable) ?></td>

                                    <td><?php
                                        if (isset($client->typeutilisateur)) {
                                            echo  h($client->typeutilisateur->name);
                                        }
                                        ?></td>

                                    <td>

                                        <?php if (isset($client->paiement)) {

                                            echo  h($client->paiement->name);
                                        } ?></td>




                                    <td><?= h($client->numregistre) ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    </div>
</section>
</div>