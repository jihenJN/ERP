<div id="tempsconsomme" style="display:none;margin-top: 18px;">
    <?php
    echo $this->Form->create($thisprojetproduction, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
    echo $this->Form->hidden('form_name', ['value' => 'projetproduction']);
    ?>

    <section class="content-header">
        <h1>
            Production
            <small>
                <?php echo __(''); ?>
            </small>
        </h1>
    </section>
    <section class="content" style="width: 99%">
        <div class="row">
            <div class="box">


                <div class="panel-body">
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="tabletache">
                            <thead>
                                <tr>
                                    <td align="center" style="width: 30%;"><strong></strong></td>
                                    <td align="center" style="width: 10%;"><strong>Planifié</strong></td>
                                    <td align="center" style="width: 30%;"><strong>N° OF</strong></td>
                                    <td align="center" style="width: 10%;">Réel</td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                if (empty($projetproductions->toarray())) {

                                    foreach ($parametrageproductions as $p => $param) { ?>
                                        <tr>
                                            <td>
                                                <input table="ligneprod" id="idparam<?php echo $p ?>"
                                                    name="data[ligneprod][<?php echo $p ?>][idparam]" champ="idparam"
                                                    index="<?php echo $p ?>" class="form-control"
                                                    value="<?php echo $param->id ?>"
                                                    type="hidden">
                                                <?php echo $param->name ?>
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="data[ligneprod][<?php echo $p ?>][planifier]" id="planifier<?php echo $p ?>">
                                            </td>
                                            <td>
                                                <input type="text" name="data[ligneprod][<?php echo $p ?>][numero_of]" id="numero_of<?php echo $p ?>">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="data[ligneprod][<?php echo $p ?>][reel]" id="reel<?php echo $p ?>">
                                            </td>
                                        </tr>
                                    <?php }
                                } else { 
                                    foreach ($projetproductions as $p => $ppp) {
                                        // debug($ppp);
                                    ?>

                                    <tr>
                                        <td>
                                        <input table="ligneprod" id="idparam<?php echo $p ?>"
                                                    name="data[ligneprod][<?php echo $p ?>][idparam]" champ="idparam"
                                                    index="<?php echo $p ?>" class="form-control"
                                                    value="<?php echo $ppp->parametrageproduction_id ?>"
                                                    type="hidden">
                                            <input table="ligneprod" id="idppp<?php echo $p ?>"
                                                name="data[ligneprod][<?php echo $p ?>][idppp]" champ="idppp"
                                                index="<?php echo $p ?>" class="form-control"
                                                value="<?php echo $ppp->id ?>"
                                                type="hidden">
                                            <?php echo $ppp->parametrageproduction->name ?>
                                        </td>
                                        <td align="center">
                                            <input <?php if ($ppp->planifier==1) { ?> checked <?php } ?> type="checkbox" name="data[ligneprod][<?php echo $p ?>][planifier]" id="planifier<?php echo $p ?>">
                                        </td>
                                        <td>
                                            <input value="<?php echo $ppp->numero_of ?>" type="text" name="data[ligneprod][<?php echo $p ?>][numero_of]" id="numero_of<?php echo $p ?>">
                                        </td>
                                        <td align="center">
                                            <input <?php if ($ppp->reel==1) { ?> checked <?php } ?>  type="checkbox" name="data[ligneprod][<?php echo $p ?>][reel]" id="reel<?php echo $p ?>">
                                        </td>
                                    </tr>

                                <?php  } }
                                ?>
                            </tbody>


                        </table><br>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <button type="submit" class="pull-right btn btn-success btn-sm" id="poi1ntv" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
    <?php echo $this->Form->end(); ?>

</div>