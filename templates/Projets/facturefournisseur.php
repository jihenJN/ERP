<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Livraison $livraison
 */
error_reporting(E_ERROR | E_PARSE);

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
    <h1>
        Facture
        <small><?php echo __(''); ?></small>
    </h1>
    <?php if (!empty($project_id)) { ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'vieww', $project_id]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
        </ol>
    <?php } else { ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'etatfinanceprojet']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
        </ol>
    <?php } ?>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <?php echo $this->Form->create($facture, ['role' => 'form']);
                debug($facture); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <?php
                            echo $this->Form->control('numero', ['readonly' => 'readonly']);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                            echo $this->Form->control('date', ['readonly' => 'readonly']);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php debug($fournisseurs->ToArray);
                            echo $this->Form->control('fournisseur_id', ['empty' => 'Veuillez choisir !!', 'style' => "pointer-events: none;",  'readonly']);
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                            echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => 'Veuillez choisir !!', 'style' => "pointer-events: none;",  'readonly']);
                            ?>
                        </div>
                    </div>
                </div>
                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Ligne Livraison'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Article</th>
                                                <th scope="col">Quantité</th>
                                                <th scope="col">Prix HT</th>
                                                <th scope="col">Remise</th>
                                                <th scope="col">PrixUNHT</th>
                                                <th scope="col">Fcodec</th>
                                                <th scope="col">TVA</th>
                                                <th scope="col">TTC</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr" style="display: none !important" align="center">
                                                <td style="width: 15%;" align="center">
                                                    <input type="hidden" champ="sup" table="tabligne3" index="" class="form-control">
                                                    <select champ="article_id" class="form-control " table="tabligne3">
                                                        <option value="">Veuillez choisir !!</option>
                                                        <?php foreach ($articles as $article) : ?>
                                                            <option value="<?= h($article->id) ?>"><?= h($article->Dsignation) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td style="width: 10%;" align="center">
                                                    <input table="tabligne3" type='text' champ='qte' class='form-control getcalc ' class='input'>
                                                </td>
                                                <td style="width: 10%;" align="center">
                                                    <input table="tabligne3" type='text' champ='prix' class='form-control getcalc getprixarticle' class='input'>
                                                </td>
                                                <td style="width: 10%;" align="center">
                                                    <input table="tabligne3" type='text' champ='remise' class='form-control getcalc' class='input'>
                                                </td>
                                                <td style="width: 10%;" align="center">
                                                    <input table="tabligne3" type='text' champ='ht' class='form-control getcalc' class='input'>
                                                </td>
                                                <td style="width: 10%;" align="center">
                                                    <input table="tabligne3" type='text' champ='fodec' class='form-control getcalc' class='input'>
                                                </td>
                                                <td style="width: 10%;" align="center">
                                                    <input table="tabligne3" type='text' champ='tva' class='form-control getcalc' class='input'>
                                                </td>
                                                <td style="width: 10%;" align="center">
                                                    <input table="tabligne3" type='text' champ='ttc' class='form-control getcalc' class='input'>
                                                </td>
                                                <td style="width: 5%;" align="center"><i class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                                            </tr>
                                            <?php foreach ($lignes as $indice => $ligne) :
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $article->Dsignation; ?>
                                                    </td>
                                                    <td hidden>
                                                        <input type="hidden" name="data[tabligne3][<?= h($indice) ?>][sup]" id="sup<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control ">
                                                        <select name="data[tabligne3][<?= h($indice) ?>][article_id]" id="article_id<?= h($indice) ?>" class="form-control" onchange="get_article(this.value,1)">
                                                            <option value="">Veuillez choisir !!</option>
                                                            <?php foreach ($articles as $article) : ?>
                                                                <option value="<?= h($article->id) ?>" <?php if ($article->id == $ligne->article_id) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?= h($article->Dsignation) ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <?php echo $ligne->qte; ?>
                                                        <input type="hidden" readonly name="data[tabligne3][<?= h($indice) ?>][qte]" id="qte<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control getcalc" value="<?= h($ligne->qte) ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $ligne->prix; ?>
                                                        <input type="hidden" readonly name="data[tabligne3][<?= h($indice) ?>][prix]" id="prix<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control getcalc" value="<?= h($ligne->prix) ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $ligne->remise; ?>
                                                        <input type="hidden" readonly name="data[tabligne3][<?= h($indice) ?>][remise]" id="remise<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control getcalc" value="<?= h($ligne->remise) ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $ligne->ht; ?>
                                                        <input type="hidden" readonly name="data[tabligne3][<?= h($indice) ?>][ht]" id="ht<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control getcalc" value="<?= h($ligne->ht) ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $ligne->fodec; ?>
                                                        <input type="hidden" readonly name="data[tabligne3][<?= h($indice) ?>][fodec]" id="fodec<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control getcalc" value="<?= h($ligne->fodec) ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $ligne->tva; ?>
                                                        <input type="hidden" readonly name="data[tabligne3][<?= h($indice) ?>][tva]" id="tva<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control getcalc" value="<?= h($ligne->tva) ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $ligne->ttc; ?>
                                                        <input type="hidden" readonly name="data[tabligne3][<?= h($indice) ?>][ttc]" id="ttc<?= h($indice) ?>" index="<?= h($indice) ?>" class="form-control getcalc" readonly value="<?= h($ligne->ttc) ?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <input type="hidden" value="<?php echo $indice ?>" id="index3">
                                    </table><br>
                                </div>
                            </div>

                            <div class="table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                    <thead>
                                        <tr>
                                            <th align="center"><strong>Remise</strong></th>
                                            <th align="center"><strong>Total HT</strong></th>
                                            <th align="center"><strong>Fodec</strong></th>
                                            <th align="center"><strong>TVA</strong></th>
                                            <th align="center"><strong>TTC</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $facture->remise; ?></td>
                                            <td><?php echo $facture->ht; ?></td>
                                            <td><?php echo $facture->fodec; ?></td>
                                            <td><?php echo $facture->tva; ?></td>
                                            <td><?php echo $facture->ttc; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <section class="content-header">
                                <h1 class="box-title"><?php echo __('Mode de Réglement'); ?></h1>
                            </section>

                            <section class="content" style="width: 99%">
                                <div class="row">

                                    <div class="box box-primary">
                                        <div class="box box-">

                                            <div class="panel-body">
                                                <div class="table-responsive ls-table">
                                                    <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                        <?php $read = "";
                                                        $i = -1;
                                                        foreach ($piecereglements as $i => $piece) {
                                                            $i++;
                                                        ?>
                                                            <thead>
                                                                <th>Mode de paiement</th>
                                                                <th>Montant</th>
                                                                <th>Banque</th>
                                                                <th>Date</th>

                                                            </thead>
                                                            <tbody>
                                                                <td><?php echo $piece->paiement->name; ?></td>
                                                                <td><?php echo $piece->montant; ?></td>
                                                                <td><?php echo $piece->banque->name; ?></td>
                                                                <td><?php echo $piece->echance; ?></td>
                                                            </tbody>
                                                        <?php } ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <?php echo $this->Form->end(); ?>
                        </div>

                </section>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<script>
    $(function() {
        $('#fournisseur-id').on('change', function() {
            //alert('hello');
            id = $('#fournisseur-id').val();
            //alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Facture', 'action' => 'getadresselivraison']) ?>",

                dataType: "json",
                data: {
                    idfam: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {

                    $('#adresselivraisonfournisseur').html(data.select);

                }
            })
        });
    });

    $('.ajouterligne_w').on('click', function() {
        table = $(this).attr('table');
        //alert(table);
        index = $(this).attr('index');
        ajouter_lignee(table, index);
    })
</script>

<script>
    function ajouter_lignee(table, index) {
        ind = Number($('#' + index).val()) + 1;
        // alert(table);
        $ttr = $('#' + table).find('.tr').clone(true);
        $ttr.attr('class', '');
        i = 0;
        tabb = [];
        $ttr.find('input,select,textarea,tr,td,div').each(function() {
            tab = $(this).attr('table'); //alert(tab)
            champ = $(this).attr('champ');
            $(this).attr('index', ind);
            $(this).attr('id', champ + ind);
            $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
            $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            $type = $(this).attr('type');
            $(this).val('');
            if ($type == 'radio') {
                $(this).attr('name', 'data[' + champ + ']');
                $(this).val(ind);
            }
            if ((champ == 'datedebut') || (champ == 'datefin')) {
                $(this).attr('onblur', 'nbrjour(' + ind + ')')
            }
            $(this).removeClass('anc');
            if ($(this).is('select')) {
                tabb[i] = champ + ind;
                i = Number(i) + 1;
            }
        })
        $ttr.find('i').each(function() {
            // alert('hh');
            $(this).attr('index', ind);
        });
        $('#' + table).append($ttr);
        $('#' + index).val(ind);
        $('#' + table).find('tr:last').show();
        for (j = 0; j <= i; j++) {}
    }
</script>
<script>
    $(function() {
        $('#fournisseur-id').on('change', function() {
            //alert('hello');
            id = $('#fournisseur-id').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getadresselivraison']) ?>",
                dataType: "json",
                data: {
                    idfam: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    // alert(data.ligne.Fodec);
                    $('#adresselivraisonfournisseur-id').html(data.select);
                    // uniform_select('adresse');
                    $('#exofodec').val(data.ligne.Fodec);
                    $('#exotva').val(data.ligne.R_TVA);
                }
            })
        });
    });
    $('.ajouterligne_w').on('click', function() {

        table = $(this).attr('table');
        //alert(table);
        index = $(this).attr('index');
        ajouter_ligne(table, index);
    })
    $('.btnajout').on('mouseover', function() {
        //alert('marwa')
        depot = $('#depot-id').val();
        //alert(namepv)
        if (depot == '') {
            alert('choisir depot SVP !!', function() {});
        }
    });
</script>