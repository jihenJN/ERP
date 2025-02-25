<section class="content-header">
    <h1>
        Fournisseur
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<section class="content">
    <div class="box">

        <div class="box-body">
            <div class="row">

                <?php echo $this->Form->create($fournisseur, ['role' => 'form']); ?>
                <div class="box-body">
                    <div class="row">


                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('code', ['readonly' => 'readonly']); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('name', ['readonly' => 'readonly']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('pay_id', ['label' => 'Pays', 'id' => 'pay_id', 'value' => $fournisseur->pay_id, 'empty' => 'Veuillez choisir !!', 'readonly' => 'readonly', 'class' => 'form-control select2 pays']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('activite', ['readonly' => 'readonly']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('typeutilisateur_id', ['options' => $typeutilisateurs, ['readonly' => 'readonly'], 'class' => 'form-control select2']); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('secteur', ['readonly' => 'readonly', 'class' => 'form-control ']); ?></div>


                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('devise_id', ['readonly' => 'readonly', 'class' => 'form-control ', 'options' => $devises]); ?>
                        </div>
                        <div class="col-xs-3"><?php echo $this->Form->control('tel', ['readonly' => 'readonly', 'label' => 'Télèphone 1']); ?></div>
                        <div class="col-xs-3"><?php echo $this->Form->control('tel', ['readonly' => 'readonly', 'label' => 'Télèphone 2']); ?></div>


                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('typelocalisation_id', ['readonly' => 'readonly', 'class' => 'form-control select2']); ?></div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('fax', ['readonly' => 'readonly']); ?></div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('compte_comptable', ['readonly' => 'readonly']); ?></div>

                        <div class="col-xs-6">
                            <?php

                            echo $this->Form->control('mail', ['readonly' => 'readonly']); ?></div>

                        <!--                     <div class="col-xs-6">
              <?php
                // echo $this->Form->control('pay_id',['readonly'=>'readonly']);
                ?></div>-->
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('site', ['readonly' => 'readonly']); ?></div>

                        <!--                     <div class="col-xs-6">
              <?php
                // echo $this->Form->control('ville_id',['readonly'=>'readonly']);
                ?></div>
                -->

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('paiement_id', ['readonly' => 'readonly', 'class' => 'form-control select2']); ?></div>

                        <!--                     <div class="col-xs-6">
              <?php

                //echo $this->Form->control('region_id',['readonly'=>'readonly']);
                ?></div>-->

                        <div class="col-xs-6">

                            <?php echo $this->Form->control('exo', ['lable' => 'Exoneration', 'readonly' => 'readonly', 'name' => 'exonerations', 'empty' => 'Veuillez choisir !!', 'options' => $exonerations, 'class' => 'form-control select2 control-label typeexoneration', 'id' => 'exonerations', 'required' => 'off']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('codepostal', ['readonly' => 'readonly']); ?></div>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $this->Form->control('soldedebut', ['label' => 'Solde Debut', 'readonly' => 'readonly']); ?>
                    </div>

                    <?php echo $this->Form->end(); ?>

                    <br><br>


                    <section class="content-header" hidden>
                        <h1 class="box-title"><?php echo __('Adresse de livraison'); ?></h1>
                    </section>

                    <section class="content" style="width: 95%" hidden>
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <?php if (!empty($fournisseur->adresselivraisonfournisseurs)) : ?>
                                        <table class="table table-bordered table-striped table-bottomless ">
                                            <tbody>
                                                <?php foreach ($fournisseur->adresselivraisonfournisseurs as $adresselivraisonfournisseurs) : ?>
                                                    <tr class="tr">
                                                        <td style="width: 8%;background-color: white" align="center" index="0"> <strong>adresse</strong> </td>
                                                        <td align="center" index="0" style='background-color: white'>
                                                            <?= h($adresselivraisonfournisseurs->adresse) ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </section>

                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Les responsables'); ?></h1>
                    </section>
                    <section class="content" style="width: 95%">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">



                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <?php if (!empty($fournisseur->fournisseurresponsables)) : ?>
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                                                <thead>
                                                    <tr width:20px">
                                                        <td align="center" style="width: 25%;"><strong>Nom du responsable</strong></td>
                                                        <td align="center" style="width: 25%;"><strong>Email</strong></td>
                                                        <td align="center" style="width: 25%;"><strong>télèphone</strong></td>
                                                        <td align="center" style="width: 25%;"><strong>Poste</strong></td>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($fournisseur->fournisseurresponsables  as $fournisseurresponsables) : ?>
                                                        <tr class="tr">
                                                            <td align="center" style='background-color: white'>

                                                                <input type="hidden" id="" champ="sup1" name="" table="ligner" index="" class="form-control">
                                                                <?= h($fournisseurresponsables->name) ?>
                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($fournisseurresponsables->mail) ?>
                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($fournisseurresponsables->tel) ?>
                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($fournisseurresponsables->poste) ?>
                                                            </td>


                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <input type="hidden" value="-1" id="index1">
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>

                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Les comptes bancaires'); ?></h1>
                    </section>

                    <section class="content" style="width: 95%">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">

                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <?php if (!empty($fournisseur->fournisseurbanques)) : ?>
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne1">
                                                <thead>
                                                    <tr width:20px">
                                                        <td align="center" style="width: 10%;"><strong>Banque</strong></td>
                                                        <td align="center" style="width: 20%;"><strong>Code agence</strong></td>
                                                        <td align="center" style="width: 10%;"><strong>Code banque</strong></td>
                                                        <td align="center" style="width: 10%;"><strong>Code SWIFT</strong></td>
                                                        <td align="center" style="width:10%;"><strong>Compte</strong></td>
                                                        <td align="center" style="width: 10%;"><strong>RIB</strong></td>
                                                        <td align="center" style="width: 15%;"><strong>Document</strong></td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($fournisseur->fournisseurbanques as $fournisseurbanques) :
                                                        //debug($fournisseurbanques);die;
                                                    ?>
                                                        <tr class="tr">
                                                            <td align="center" style='background-color: white'>
                                                                <?php
                                                                echo $this->Form->control('banque_id', ['options' => $banques, 'readonly', 'value' => $fournisseurbanques->banque_id, 'empty' => true, 'label' => false, 'table' => 'lignecommandes', 'champ' => 'article_id', 'class' => 'form-control select getprixarticle Testdep single']); ?>







                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($fournisseurbanques->agence) ?>

                                                            </td>





                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($fournisseurbanques->code_banque) ?>
                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($fournisseurbanques->swift) ?>
                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($fournisseurbanques->compte) ?>
                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($fournisseurbanques->rib) ?>
                                                            </td>


                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <!-- <?= h($fournisseurbanques->document) ?> -->
                                                                <?php echo $this->Html->link(
                                                                    $fournisseurbanques->document, // Le texte ou le nom du lien
                                                                    '/webroot/img/' . $fournisseurbanques->document, // L'URL du lien
                                                                    ['target' => '_blank', 'style' => 'max-width:200px;height:200px;'] // Options supplémentaires
                                                                ); ?>

                                                            </td>


                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <input type="hidden" value="-1" id="index1">
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>
                    <section class="content-header" hidden>
                        <h1 class="box-title"><?php echo __('Suspension des droits et taxe '); ?></h1>
                    </section>


                    <section class="content" style="width: 99%" hidden>
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">


                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <?php if (!empty($fournisseur->exonerations)) : ?>
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne2">
                                                <thead>
                                                    <tr width:20px">

                                                        <td align="center" style="width: 20%;"><strong>Type</strong></td>
                                                        <td align="center" style="width: 20%;"><strong>N attestatin </strong></td>
                                                        <td align="center" style="width: 20%;"><strong>Date debut</strong></td>
                                                        <td align="center" style="width: 20%;"><strong>Date fin </strong></td>
                                                        <td align="center" style="width: 20%;"><strong>Document</strong></td>



                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($fournisseur->exonerations as $exonerations) :
                                                        //debug($fournisseur->exonerations);die;
                                                    ?>
                                                        <tr class="tr">
                                                            <td align="center" style='background-color: white'>

                                                                <input type="hidden" id="" champ="sup1" name="" table="ligner" index="" class="form-control">
                                                                <?php
                                                                echo $this->Form->control('typeexoneration_id', ['options' => $typeexonerations, 'readonly', 'value' => $exonerations->typeexon_id, 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'article_id', 'class' => 'form-control select getprixarticle Testdep single']); ?>







                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($exonerations->num_att_taxes) ?>
                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($exonerations->date_debut) ?>
                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <?= h($exonerations->date_fin) ?>
                                                            </td>
                                                            <td align="center" table="ligner" style='background-color: white'>
                                                                <!-- <?= h($exonerations->document) ?> -->
                                                                <?php echo $this->Html->link('' .  $exonerations->document, ['style' => 'max-width:200px;height:200px;']); ?>
                                                            </td>

                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <input type="hidden" value="-1" id="index1">
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>

    </div>

</section>