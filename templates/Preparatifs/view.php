<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
    <h1>
        Consultation préperatif

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<section class="content" style="width: 99%">
    <div class="row">
        <div class="box">

      
            <div class="col-xs-6">
                <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $preparatif->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
            </div>

            <div class="col-xs-6">
                <?php echo $this->Form->control('date', ['readonly' => 'readonly', 'value' => $preparatif->date, 'label' => 'Date', 'required' => 'off']); ?>
            </div>

          
            <br>
            <section class="content-header">
                <h1 class="box-title"> Consultation bon livraison </h1>
            </section>
            <br>

            <?php foreach ($data as $i  => $d) {
            ?>
                <table class="table table-bordered table-striped table-bottomless" style="width:100%" >
                    <thead>
                        <th class="actions text-center" width="10%">Numero BL</th>
                        <th class="actions text-center" width="30%">Date</th>
                        <th class="actions text-center" width="30%">Client</th>
                        <th class="actions text-center" width="30%">Commercial</th>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <input readonly value="<?php echo $d['numero']  ?>"  type="text"  class="form-control">
                            </td>
                            <td>
                                <input readonly value="<?php echo $d['date']  ?>"  type="text"  class="form-control">
                            </td>
                            <td>
                                <input readonly value="<?php echo $d['client']  ?>" type="text"  class="form-control">
                            </td>
                            <td >
                                <input readonly value="<?php echo $d['commercial']  ?>"  type="text"  class="form-control">
                            </td>
                        </tr>
                    </tbody>
                
                    <table class="table table-bordered table-striped table-bottomless" >
                        <tbody>
                            <th class="actions text-center">Article</th>
                            <th class="actions text-center">Quantite</th>
                            <th class="actions text-center">Prix</th>
                            <?php foreach ($data[$i]['Ligne'] as $k => $ligne) {
                                debug($ligne);
                            ?>
                                <tr>
                                    <td>
                                        <input readonly value="<?php echo $ligne['Article'] ?>" type="text" class="form-control">
                                    </td>


                                    <td>
                                        <input readonly value="<?php echo $ligne['quantiteliv'] ?>" type="text" class="form-control">
                                    </td>

                                    <td>
                                        <input readonly value="<?php echo $ligne['prixht'] ?>" type="text" class="form-control">
                                    </td>

                                <?php  } ?>
                                </tr>

                            <?php  } ?>

                        </tbody>




                    </table>



        </div>
    </div>

</section>