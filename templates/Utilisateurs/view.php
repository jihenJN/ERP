<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Utilisateur $utilisateur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
    <h1>
        Profile
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <?php echo $this->Form->create($utilisateur, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->control('name');
                    ?>



                    <!-- <label style="margin-right:2px" class="control-label"> Commercials: </label>
                    <input type="checkbox" name="commercial" <?php if ($utilisateur->commercial == 1) { ?> checked="" <?php } ?> value="1"> -->
                </div>
                <?php
                //$matrice = array();
                // debug($liens[0]['Lien']);die;                                   
                // foreach ($tab as $lien) {
                //   //foreach ($lien['Lien'] as $l) {
                //     // debug($l);die;
                //     $matrice[$lien['Menu']['name']][$l['lien']]['add'] = $l['add'];
                //     $matrice[$lien['Menu']['name']][$l['lien']]['edit'] = $l['edit'];
                //     $matrice[$lien['Menu']['name']][$l['lien']]['delete'] = $l['delete'];
                //     $matrice[$lien['Menu']['name']][$l['lien']]['imprimer'] = $l['imprimer'];
                //     $matrice[$lien['Menu']['name']][$l['lien']]['valide'] = $l['valide'];
                //   //}
                // }
                // debug($matrice);die;                         
                ?>
                <div>
                    <h4 class="box" style="background-color: 	#f8f8ff ; border: 20px solid #f8f8ff;">
                        Droit D'acces
                    </h4>

                    <nav class="navbar navbar-default" style="background-color:white;">
                        <div class="container-fluid">
                            <ul class="nav navbar-nav">
                                <li><a href="#parametrage" data-toggle="tab"><i class="fa fa-fw fa-cog text-aqua"></i>Parametrage</a></li>
                                <li><a href="#achat" data-toggle="tab"><i class="fa fa-fw fa-cart-plus text-yellow"></i>Achat</a></li>
                                <li><a href="#vente" data-toggle="tab"><i class="fa fa-fw fa-laptop text-green"></i>Vente</a></li>
                                <li><a href="#stock" data-toggle="tab"><i class="fa fa-fw fa-cube text-red"></i>Stock</a></li>
                                <li><a href="#articles" data-toggle="tab"><i class="fa fa-fw  fa-cube text-aqua"></i>Articles</a></li>
                                <li><a href="#clients" data-toggle="tab"><i class="fa fa-fw fa-user-circle-o"></i>Clients</a></li>
                                <!-- <li><a href="#prévisionnement" data-toggle="tab"> <i class="fa fa-fw fa-search text-yellow"></i> Prévisionnement</a></li> -->
                                <!-- <li><a href="#zones" data-toggle="tab"><i class=" fa fa-map-o"></i> Zones</a></li> -->
                                <!-- <li><a href="#commercials" data-toggle="tab"> <i class="fa fa-fw fa-users text-purple"></i> Commercials</a></li> -->
                                <li><a href="#caisses" data-toggle="tab"> <i class="fa fa-fw fa-dollar" style="color: #515DF9;"></i> Caisses</a></li>
                                <li><a href="#finance" data-toggle="tab"> <i class="fa fa-fw fa-money text-red"></i> Finances</a></li>
                                <li><a href="#statistiques" data-toggle="tab"> <i class="fa fa-fw fa-bar-chart" style="color: #4DAAA5;"></i> Statistiques</a></li>


                            </ul>
                            <div class="tab-content tab-border">
                                <div class="tab-pane fade in param active" id="parametrage">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['Parametrage'])) { ?> checked="checked" <?php } ?> name="acces[]" id="ventetab" id="p1" value="2"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>

                                            </tr>
                                            <tr class="societes">
                                                <td align="left"> Societés </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['societes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][0][add]" id="p2" value="1">
                                                    <input type="hidden" name="data[2][Lien][0][lien]" value="societes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['societes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][0][edit]" id="p3" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['societes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][0][delete]" id="p4" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['societes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][0][imprimer]" id="p5" value="1"></td>

                                            </tr>

                                            <tr class="pointdeventes">
                                                <td align="left"> Sites</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['pointdeventes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][31][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][31][lien]" value="pointdeventes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['pointdeventes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][31][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['pointdeventes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][31][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['pointdeventes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][31][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="banques">
                                                <td align="left"> Banques</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['banques']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][1][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][1][lien]" value="banques">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['banques']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][1][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['banques']['delete'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][1][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['banques']['imprimer'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][1][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>
                                            <tr class="devises">
                                                <td align="left"> Devise</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['devises']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][20][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][20][lien]" value="devises">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['devises']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][20][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['devises']['delete'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][20][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['devises']['imprimer'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][20][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>
                                            <tr class="transporteurs">
                                                <td align="left"> Transporteurs</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['transporteurs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][30][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][30][lien]" value="transporteurs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['transporteurs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][30][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['transporteurs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][30][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['transporteurs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][30][imprimer]" value="1"></td>

                                            </tr>




                                            <tr class="profil">
                                                <td align="left"> Profile</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['profile']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][4][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][4][lien]" value="profile">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['profile']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][4][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['profile']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][4][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['profile']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][4][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="utilisateurs">
                                                <td align="left"> Utilisateurs</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['utilisateurs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][5][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][5][lien]" value="utilisateurs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['utilisateurs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][5][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['utilisateurs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][5][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['utilisateurs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][5][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="fonctions">
                                                <td align="left"> Fonctions</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['fonctions']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][3][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][3][lien]" value="fonctions">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fonctions']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][3][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fonctions']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][3][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fonctions']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][3][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="personnels">
                                                <td align="left"> Personnels</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['personnels']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][7][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][7][lien]" value="personnels">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['personnels']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][7][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['personnels']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][7][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['personnels']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][7][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="pays" hidden>
                                                <td align="left"> Pays</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['pays']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][21][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][21][lien]" value="pays">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['pays']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][21][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['pays']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][21][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['pays']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][21][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="gouvernorats" hidden>
                                                <td align="left"> Gouvernorats</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['gouvernorats']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][8][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][8][lien]" value="gouvernorats">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['gouvernorats']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][8][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['gouvernorats']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][8][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['gouvernorats']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][8][imprimer]" value="1"></td>

                                            </tr><!-- comment -->




                                            <tr class="delegations" hidden>
                                                <td align="left"> Délégations</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['delegations']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][9][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][9][lien]" value="delegations">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['delegations']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][9][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['delegations']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][9][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['delegations']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][9][imprimer]" value="1"></td>

                                            </tr>



                                            <tr class="gouvernorats" hidden>
                                                <td align="left"> Localités</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['localites']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][10][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][10][lien]" value="localites">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['localites']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][10][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['localites']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][10][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['localites']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][10][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="basepostes" hidden>
                                                <td align="left"> Base postes</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['basepostes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][35][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][35][lien]" value="basepostes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['basepostes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][35][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['basepostes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][35][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['basepostes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][35][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="cartecarburants" hidden>
                                                <td align="left"> Cartecarburant</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['cartecarburants']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][11][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][11][lien]" value="cartecarburants">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['cartecarburants']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][11][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['cartecarburants']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][11][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['cartecarburants']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][11][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="typecartecarburants" hidden>
                                                <td align="left"> Type Carte Carburants</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['typecartecarburants']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][12][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][12][lien]" value="typecartecarburants">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typecartecarburants']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][12][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typecartecarburants']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][12][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typecartecarburants']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][12][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="materieltransports" hidden>
                                                <td align="left"> Materieltransports</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['materieltransports']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][13][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][13][lien]" value="materieltransports">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['materieltransports']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][13][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['materieltransports']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][13][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['materieltransports']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][13][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="typeexons">
                                                <td align="left"> Type exonerations</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['typeexons']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][18][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][18][lien]" value="typeexons">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typeexons']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][18][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typeexons']['delete'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][18][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typeexons']['imprimer'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][18][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>



                                            <tr class="tvas">
                                                <td align="left"> TVA</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['tvas']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][15][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][15][lien]" value="tvas">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tvas']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][15][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tvas']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][15][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tvas']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][15][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="fodecs">
                                                <td align="left"> Fodec</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['fodecs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][17][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][17][lien]" value="fodecs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fodecs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][17][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fodecs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][17][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fodecs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][17][imprimer]" value="1"></td>
                                            </tr>

                                            <tr class="timbres">
                                                <td align="left"> Timbres</td>
                                                <td align="center">
                                                    <input type="hidden" name="data[2][Lien][14][lien]" value="timbres">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['timbres']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][14][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['timbres']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][14][delete]" value="1"></td>
                                            </tr>





                                            <tr class="caisses" hidden>
                                                <td align="left"> Caisses</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['caisses']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][2][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][2][lien]" value="caisses">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['caisses']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][2][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['caisses']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][2][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['caisses']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][2][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="tracemisajour">
                                                <td align="left"> Trace mise a jour</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['tracemisajour']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][19][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][19][lien]" value="tracemisajour">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tracemisajour']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][19][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tracemisajour']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][19][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tracemisajour']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][19][imprimer]" value="1"></td>

                                            </tr>






                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade in " id="stock">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['Stock'])) { ?> checked="checked" <?php } ?> name="acces[]" id="ventetab" value="1"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>
                                            <tr class="depots">
                                                <td align="left">Dépots</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Stock']['depots']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][8][add]" value="1">
                                                    <input type="hidden" name="data[1][Lien][8][lien]" value="depots">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['depots']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][8][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['depots']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][8][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['depots']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][8][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                            <tr class="stockdepots">
                                                <td align="left">Stock depots</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Stock']['stockdepots']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][9][add]" value="1">
                                                    <input type="hidden" name="data[1][Lien][9][lien]" value="stockdepots">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['stockdepots']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][9][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['stockdepots']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][9][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['stockdepots']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][9][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="historiquearticles">
                                                <td align="left">Historique article</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[1][Lien][12][lien]" value="historiquearticles">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Stock']['historiquearticles']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][12][imprimer]" value="1">
                                                </td>

                                                <td align="center"></td>

                                            </tr>

                                            <tr class="suivistocks">
                                                <td align="left">Suivi stock</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Stock']['suivistocks']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][10][add]" value="1">
                                                    <input type="hidden" name="data[1][Lien][10][lien]" value="suivistocks">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['suivistocks']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][10][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['suivistocks']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][10][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['suivistocks']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][10][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>


                                            <tr class="detailstocks">
                                                <td align="left">Etat detail stock</td>
                                                <td align="center">
                                                    <input type="hidden" name="data[1][Lien][13][lien]" value="detailstocks">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['detailstocks']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][13][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="inventairestock">
                                                <td align="left">Inventaires</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Stock']['inventairestock']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][11][add]" value="1">
                                                    <input type="hidden" name="data[1][Lien][11][lien]" value="inventairestock">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['inventairestock']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][11][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['inventairestock']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][11][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['inventairestock']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][11][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="bonsortiestocks">
                                                <td align="left">Bon Sortie Stocks</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Stock']['bonsortiestocks']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][3][add]" value="1">
                                                    <input type="hidden" name="data[1][Lien][3][lien]" value="bonsortiestocks">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bonsortiestocks']['edit'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][3][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bonsortiestocks']['delete'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][3][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bonsortiestocks']['imprimer'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][3][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade in param" id="achat">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['Achat'])) { ?> checked="checked" <?php } ?> name="acces[]" id="ventetab" value="3"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>


                                            <tr class="fournisseurs">
                                                <td align="left"> Fournisseurs</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['fournisseurs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][0][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][0][lien]" value="fournisseurs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['fournisseurs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][0][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['fournisseurs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][0][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['fournisseurs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][0][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>


                                            <tr class="relevefournisseurs">
                                                <td align="left"> Relevé Fournisseur</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['relevefournisseurs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][16][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][16][lien]" value="relevefournisseurs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['relevefournisseurs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][16][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['relevefournisseurs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][16][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['relevefournisseurs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][16][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>




                                            <tr class="demandeoffredeprixes">
                                                <td align="left"> Demande offre de prix</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['demandeoffredeprixes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][1][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][1][lien]" value="demandeoffredeprixes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['demandeoffredeprixes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][1][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['demandeoffredeprixes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][1][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['demandeoffredeprixes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][1][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['demandeoffredeprixes']['valide'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][1][valide]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                            <tr class="commandes">
                                                <td align="left"> Bon de commandes</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['commandes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][2][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][2][lien]" value="commandes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['commandes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][2][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['commandes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][2][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['commandes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][2][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['commandes']['valide'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][2][valide]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                            <tr class="livraisons">
                                                <td align="left"> Bon de livraisons</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['livraisons']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][3][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][3][lien]" value="livraisons">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['livraisons']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][3][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['livraisons']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][3][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['livraisons']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][3][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                            <tr class="factures">
                                                <td align="left"> Factures</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['factures']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][4][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][4][lien]" value="factures">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['factures']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][4][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['factures']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][4][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['factures']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][4][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="factureavoirfrs">
                                                <td align="left"> Facture Avoir</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['factureavoirfrs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][15][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][15][lien]" value="factureavoirfrs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['factureavoirfrs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][15][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['factureavoirfrs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][15][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['factureavoirfrs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][15][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                            <tr class="reglements">
                                                <td align="left"> Reglements</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['reglements']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][5][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][5][lien]" value="reglements">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['reglements']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][5][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['reglements']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][5][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['reglements']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][5][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade in param" id="vente">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['Vente'])) { ?> checked="checked" <?php } ?> id='v1' name="acces[]" id="ventetab" value="4"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <!-- <td align="center">Impression</td>
                                                <td align="center">Validation</td> -->
                                            </tr>






                                            <tr class="bonlivraisons">
                                                <td align="left"> Bon livraison</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['bonlivraisons']['add'] == 1) { ?> checked="checked" <?php } ?> id='v2' name="data[4][Lien][16][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][16][lien]" value="bonlivraisons">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['bonlivraisons']['edit'] == 1) { ?> checked="checked" <?php } ?> id='v3' name="data[4][Lien][16][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['bonlivraisons']['delete'] == 1) { ?> checked="checked" <?php } ?> id='v4' name="data[4][Lien][16][delete]" value="1"></td>
                                                <td></td>
                                                <td></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['bonlivraisons']['imprimer'] == 1) { ?> checked="checked" <?php } ?> id='v5' name="data[4][Lien][16][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['bonlivraisons']['valide'] == 1) { ?> checked="checked" <?php } ?> id='v6' name="data[4][Lien][16][valide]" value="1"></td> -->
                                            </tr>

                                            <tr class="factureproformats">
                                                <td align="left"> Facture proforma</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['factureproformats']['add'] == 1) { ?> checked="checked" <?php } ?> id='v7' name="data[4][Lien][17][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][17][lien]" value="factureproformats">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureproformats']['edit'] == 1) { ?> checked="checked" <?php } ?> id='v8' name="data[4][Lien][17][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureproformats']['delete'] == 1) { ?> checked="checked" <?php } ?> id='v9' name="data[4][Lien][17][delete]" value="1"></td>
                                                <td></td>
                                                <td></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureproformats']['imprimer'] == 1) { ?> checked="checked" <?php } ?> id='v10' name="data[4][Lien][17][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureproformats']['valide'] == 1) { ?> checked="checked" <?php } ?> id='v11' name="data[4][Lien][17][valide]" value="1"></td> -->
                                            </tr>


                                            <tr class="commandes">
                                                <td align="left"> Bon de Commande</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['commandes']['add'] == 1) { ?> checked="checked" <?php } ?> id='v12' name="data[4][Lien][18][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][18][lien]" value="commandes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['commandes']['edit'] == 1) { ?> checked="checked" <?php } ?> id='v13' name="data[4][Lien][18][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['commandes']['delete'] == 1) { ?> checked="checked" <?php } ?> id='v14' name="data[4][Lien][18][delete]" value="1"></td>
                                                <td></td>
                                                <td></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['commandes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> id='v15' name="data[4][Lien][18][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['commandes']['valide'] == 1) { ?> checked="checked" <?php } ?> id='v16' name="data[4][Lien][18][valide]" value="1"></td> -->
                                            </tr>


                                            <tr class="factureatermes">
                                                <td align="left"> Facture A terme</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['factureatermes']['add'] == 1) { ?> checked="checked" <?php } ?> id='v17' name="data[4][Lien][19][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][19][lien]" value="factureatermes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureatermes']['edit'] == 1) { ?> checked="checked" <?php } ?> id='v18' name="data[4][Lien][19][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureatermes']['delete'] == 1) { ?> checked="checked" <?php } ?> id='v19' name="data[4][Lien][19][delete]" value="1"></td>
                                                <td></td>
                                                <td></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureatermes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> id='v20' name="data[4][Lien][19][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureatermes']['valide'] == 1) { ?> checked="checked" <?php } ?> id='v21' name="data[4][Lien][19][valide]" value="1"></td> -->
                                            </tr>


                                            <tr class="facturecomptants">
                                                <td align="left"> Facture Comptant</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['facturecomptants']['add'] == 1) { ?> checked="checked" <?php } ?> id='v22' name="data[4][Lien][20][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][20][lien]" value="facturecomptants">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['facturecomptants']['edit'] == 1) { ?> checked="checked" <?php } ?> id='v23' name="data[4][Lien][20][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['facturecomptants']['delete'] == 1) { ?> checked="checked" <?php } ?> id='v24' name="data[4][Lien][20][delete]" value="1"></td>
                                                <td></td>
                                                <td></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['facturecomptants']['imprimer'] == 1) { ?> checked="checked" <?php } ?> id='v25' name="data[4][Lien][20][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['facturecomptants']['valide'] == 1) { ?> checked="checked" <?php } ?> id='v26' name="data[4][Lien][20][valide]" value="1"></td> -->
                                            </tr>


                                            <tr class="factureavoirs">
                                                <td align="left"> Facture Avoir</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['factureavoirs']['add'] == 1) { ?> checked="checked" <?php } ?> id='v27' name="data[4][Lien][21][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][21][lien]" value="factureavoirs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureavoirs']['edit'] == 1) { ?> checked="checked" <?php } ?> id='v28' name="data[4][Lien][21][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureavoirs']['delete'] == 1) { ?> checked="checked" <?php } ?> id='v29' name="data[4][Lien][21][delete]" value="1"></td>
                                                <td></td>
                                                <td></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureavoirs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> id='v30' name="data[4][Lien][21][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureavoirs']['valide'] == 1) { ?> checked="checked" <?php } ?> id='v31' name="data[4][Lien][21][valide]" value="1"></td> -->
                                            </tr>


                                            <tr class="reglementclientsbl">
                                                <td align="left"> Règlement BL </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsbl']['add'] == 1) { ?> checked="checked" <?php } ?> id='v32' name="data[4][Lien][22][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][22][lien]" value="reglementclientsbl">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsbl']['edit'] == 1) { ?> checked="checked" <?php } ?> id='v33' name="data[4][Lien][22][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsbl']['delete'] == 1) { ?> checked="checked" <?php } ?> id='v34' name="data[4][Lien][22][delete]" value="1"></td>

                                                <td></td>
                                                <td></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsbl']['imprimer'] == 1) { ?> checked="checked" <?php } ?> id='v35' name="data[4][Lien][22][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsbl  ']['valide'] == 1) { ?> checked="checked" <?php } ?> id='v36' name="data[4][Lien][22][valide]" value="1"></td> -->
                                            </tr>


                                            <tr class="reglementclientsfac">
                                                <td align="left"> Règlement Facture</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsfac']['add'] == 1) { ?> checked="checked" <?php } ?> id='v37' name="data[4][Lien][23][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][23][lien]" value="reglementclientsfac">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsfac']['edit'] == 1) { ?> checked="checked" <?php } ?> id='v38' name="data[4][Lien][23][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsfac']['delete'] == 1) { ?> checked="checked" <?php } ?> id='v39' name="data[4][Lien][23][delete]" value="1"></td>

                                                <td></td>
                                                <td></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsfac']['imprimer'] == 1) { ?> checked="checked" <?php } ?> id='v40' name="data[4][Lien][23][imprimer]" value="1"></td> -->
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclientsfac']['valide'] == 1) { ?> checked="checked" <?php } ?> id='v41' name="data[4][Lien][23][valide]" value="1"></td> -->
                                            </tr>


                                            <tr class="retenus">
                                                <td align="left"> Retenu</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['retenus']['add'] == 1) { ?> checked="checked" <?php } ?> id='v42' name="data[4][Lien][24][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][24][lien]" value="retenus">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['retenus']['edit'] == 1) { ?> checked="checked" <?php } ?> id='v43' name="data[4][Lien][24][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['retenus']['delete'] == 1) { ?> checked="checked" <?php } ?> id='v44' name="data[4][Lien][24][delete]" value="1"></td>
                                                <td></td>
                                                <td></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['retenus']['imprimer'] == 1) { ?> checked="checked" <?php } ?> id='v45' name="data[4][Lien][24][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['retenus']['valide'] == 1) { ?> checked="checked" <?php } ?> id='v46' name="data[4][Lien][24][valide]" value="1"></td> -->
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>













                                <div class="tab-pane fade in param" id="clients">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['clients'])) { ?> checked="checked" <?php } ?> name="acces[]" id="ventetab" value="9"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>




                                            <tr class="clients">
                                                <td align="left">Clients</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['clients']['clients']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][0][add]" value="1">
                                                    <input type="hidden" name="data[9][Lien][0][lien]" value="clients">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['clients']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][0][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['clients']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][0][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['clients']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][0][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="listedivers">
                                                <td align="left">Liste Divers</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['clients']['listedivers']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][2][add]" value="1">
                                                    <input type="hidden" name="data[9][Lien][2][lien]" value="listedivers">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['listedivers']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][2][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['listedivers']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][2][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['listedivers']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][2][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="releveclients">
                                                <td align="left">Relevé clients </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['clients']['releveclients']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][1][add]" value="1">-->
                                                    <input type="hidden" name="data[9][Lien][1][lien]" value="releveclients">
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['clients']['releveclients']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][1][edit]" value="1"> -->
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['clients']['releveclients']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][1][delete]" value="1"> -->
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['clients']['releveclients']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][1][imprimer]" value="1">
                                                </td>
                                                <td align="center"></td>
                                            </tr>



                                            <tr class="etatnonsolde">
                                                <td align="left">Etat de Client Non Soldé</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['clients']['etatnonsolde']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][3][add]" value="1">
                                                    <input type="hidden" name="data[9][Lien][3][lien]" value="etatnonsolde">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['etatnonsolde']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][3][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['etatnonsolde']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][3][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['etatnonsolde']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][3][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>



                                            <tr class="etatsoldedivers">
                                                <td align="left">Etat Solde Divers</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['clients']['etatsoldedivers']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][4][add]" value="1">
                                                    <input type="hidden" name="data[9][Lien][4][lien]" value="etatsoldedivers">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['etatsoldedivers']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][4][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['etatsoldedivers']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][4][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['etatsoldedivers']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][4][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>


                                            <tr class="etatretenus">
                                                <td align="left">Etat Retenus
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['clients']['etatretenus']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][5][add]" value="1">
                                                    <input type="hidden" name="data[9][Lien][5][lien]" value="etatretenus">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['etatretenus']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][5][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['etatretenus']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][5][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['clients']['etatretenus']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[9][Lien][5][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>






                                        </tbody>
                                    </table>
                                </div>







                                <div class="tab-pane fade in param" id="articles">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['Article'])) { ?> checked="checked" <?php } ?> name="acces[]" id="ventetab" value="8"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                                <!-- <td align="center">Cout de revient </td> -->
                                            </tr>



                                            <tr class="unitecontenance">
                                                <td align="left"> Unités </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Article']['unitecontenance']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][1][add]" value="1">
                                                    <input type="hidden" name="data[8][Lien][1][lien]" value="unitecontenance">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['unitecontenance']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][1][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['unitecontenance']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][1][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['unitecontenance']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][1][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>


                                            <tr class="marques">
                                                <td align="left"> Marques </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Article']['marques']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][15][add]" value="1">
                                                    <input type="hidden" name="data[8][Lien][15][lien]" value="marques">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['marques']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][15][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['marques']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][15][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['marques']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][15][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>


                                            <tr class="unitearticle" hidden>
                                                <td align="left">Unités article</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Article']['unitearticle']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][0][add]" value="1">
                                                    <input type="hidden" name="data[8][Lien][0][lien]" value="unitearticle">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['unitearticle']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][0][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['unitearticle']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][0][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['unitearticle']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][0][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="famille">
                                                <td align="left"> Familles </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Article']['famille']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][3][add]" value="1">
                                                    <input type="hidden" name="data[8][Lien][3][lien]" value="famille">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['famille']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][3][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['famille']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][3][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['famille']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][3][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>

                                            <tr class="sousfamille">
                                                <td align="left"> Sous famille</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Article']['sousfamille']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][4][add]" value="1">
                                                    <input type="hidden" name="data[8][Lien][4][lien]" value="sousfamille">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['sousfamille']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][4][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['sousfamille']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][4][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['sousfamille']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][4][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>




                                            <tr class="article">
                                                <td align="left"> Articles</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Article']['article']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][6][add]" value="1">
                                                    <input type="hidden" name="data[8][Lien][6][lien]" value="article">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['article']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][6][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['article']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][6][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['article']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][6][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                                <!-- <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['article']['coutrevient'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][6][imprimer]" value="1"></td> -->

                                            </tr>



                                            <tr class="changementprix">
                                                <td align="left"> Changement de prix</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Article']['changementprix']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][7][add]" value="1">
                                                    <input type="hidden" name="data[8][Lien][7][lien]" value="changementprix">
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['Article']['changementprix']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][7][edit]" value="1"> -->
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['Article']['changementprix']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][7][delete]" value="1"> -->
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['Article']['changementprix']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][7][imprimer]" value="1"> -->
                                                </td>

                                                <td align="center"></td>

                                            </tr>

                                            <tr class="historiquearticles">
                                                <td align="left"> Etat historique article</td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['Article']['historiquearticles']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][8][add]" value="1"> -->
                                                    <input type="hidden" name="data[8][Lien][8][lien]" value="historiquearticles">
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['Article']['historiquearticles']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][8][edit]" value="1"> -->
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['Article']['historiquearticles']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][8][delete]" value="1"> -->
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Article']['historiquearticles']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][8][imprimer]" value="1">
                                                </td>

                                                <td align="center"></td>

                                            </tr>




                                        </tbody>
                                    </table>
                                </div>












                                <div class="tab-pane fade in param" id="caisses">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['caisses'])) { ?> checked="checked" <?php } ?> name="acces[]" id="caisse1" value="10"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>




                                            <tr class="etatdecaisses">
                                                <td align="left">Etat de caisse</td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['caisses']['etatdecaisses']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][0][add]" value="1"> -->
                                                    <input type="hidden" name="data[10][Lien][0][lien]" value="etatdecaisses">
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['caisses']['etatdecaisses']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][0][edit]" value="1"> -->
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" <?php if (@$matrice['caisses']['etatdecaisses']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][0][delete]" value="1"> -->
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['etatdecaisses']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][0][imprimer]" value="1">
                                                </td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="transferts">
                                                <td align="left"> Transfert entre les caisses </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['caisses']['transferts']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][1][add]" value="1">
                                                    <input type="hidden" name="data[10][Lien][1][lien]" value="transferts">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['transferts']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][1][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['transferts']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][1][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['transferts']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][1][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>

                                            <!-- <tr class="depenses">
                                                <td align="left"> Dépenses </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['caisses']['depenses']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][2][add]" value="1">
                                                    <input type="hidden" name="data[10][Lien][2][lien]" value="depenses">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['depenses']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][2][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['depenses']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][2][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['depenses']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][2][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr> -->

















                                        </tbody>
                                    </table>
                                </div>







                                <div class="tab-pane fade in finance" id="finance">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['Finance'])) { ?> checked="checked" <?php } ?> name="acces[]" id="ventetab" value="5"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                            </tr>


                                            <tr class="engagementcomptes">
                                                <td align="left">Engagement Compte</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['engagementcomptes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][16][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][16][lien]" value="engagementcomptes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementcomptes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][16][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementcomptes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][16][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementcomptes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][16][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="engagementfournisseur">
                                                <td align="left">Engagement Fournisseur</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['engagementfournisseur']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][13][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][13][lien]" value="engagementfournisseur">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementfournisseur']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][13][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementfournisseur']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][13][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementfournisseur']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][13][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="engagementclients">
                                                <td align="left">Engagement Client</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['engagementclients']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][17][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][17][lien]" value="engagementclients">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementclients']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][17][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementclients']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][17][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementclients']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][17][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="banques">
                                                <td align="left">Banques</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['banques']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][18][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][18][lien]" value="banques">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['banques']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][18][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['banques']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][18][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['banques']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][18][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="comptes">
                                                <td align="left">Comptes</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['comptes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][26][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][26][lien]" value="comptes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['comptes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][26][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['comptes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][26][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['comptes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][26][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="typecredits">
                                                <td align="left">Type crédit</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['typecredits']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][19][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][19][lien]" value="typecredits">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['typecredits']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][19][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['typecredits']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][19][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['typecredits']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][19][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="typeoperations">
                                                <td align="left">Type opération</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['typeoperations']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][20][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][20][lien]" value="typeoperations">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['typeoperations']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][20][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['typeoperations']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][20][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['typeoperations']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][20][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="operations">
                                                <td align="left">Opérations</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['operations']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][21][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][21][lien]" value="operations">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['operations']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][21][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['operations']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][21][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['operations']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][21][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="frequences">
                                                <td align="left">Fréquences</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['frequences']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][22][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][22][lien]" value="frequences">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['frequences']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][22][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['frequences']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][22][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['frequences']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][22][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="carnetcheques">
                                                <td align="left">Carnet cheques</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['carnetcheques']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][23][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][23][lien]" value="carnetcheques">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['carnetcheques']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][23][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['carnetcheques']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][23][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['carnetcheques']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][23][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="bordereaucheques">
                                                <td align="left">Bordereau Chéques
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['bordereaucheques']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][24][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][24][lien]" value="bordereaucheques">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['bordereaucheques']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][24][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['bordereaucheques']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][24][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['bordereaucheques']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][24][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="bordereautraites">
                                                <td align="left">Bordereau Traites </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Finance']['bordereautraites']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][25][add]" value="1">
                                                    <input type="hidden" name="data[5][Lien][25][lien]" value="bordereautraites">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['bordereautraites']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][25][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['bordereautraites']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][25][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['bordereautraites']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][25][imprimer]" value="1"></td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>




                                <div class="tab-pane fade in statistiques" id="statistiques">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['Stat'])) { ?> checked="checked" <?php } ?> name="acces[]" id="ventetab" value="6"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                            </tr>
                                            <tr class="pararticle">
                                                <td align="left">Statistique Par Article</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][0][lien]" value="pararticle">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['pararticle']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][0][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="parclientarticle">
                                                <td align="left">Statistique Par Client/Article</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][1][lien]" value="parclientarticle">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['parclientarticle']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][1][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="pararticleannee">
                                                <td align="left">Statistique Par Article/Année</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][2][lien]" value="pararticleannee">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['pararticleannee']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][2][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="chiffredaffaire">
                                                <td align="left">Chiffre d'affaire</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][3][lien]" value="chiffredaffaire">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['chiffredaffaire']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][3][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="journalvente">
                                                <td align="left">Journal de Vente </td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][4][lien]" value="journalvente">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['journalvente']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][4][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="etatecheance">
                                                <td align="left">Etat des Echéances</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][5][lien]" value="etatecheance">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatecheance']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][5][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="etatsoldefournisseur">
                                                <td align="left">Etat Solde Fournisseurs</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][6][lien]" value="etatsoldefournisseur">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatsoldefournisseur']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][6][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="etatsoldeclient">
                                                <td align="left">Etat solde Client</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][7][lien]" value="etatsoldeclient">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatsoldeclient']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][7][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="etatsoldedivers">
                                                <td align="left">Etat solde Divers</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][8][lien]" value="etatsoldedivers">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatsoldedivers']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][8][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="detailsvente">
                                                <td align="left">Détails de Vente</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][9][lien]" value="detailsvente">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['detailsvente']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][9][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="etatjournalier">
                                                <td align="left">Etat Journalier</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][10][lien]" value="etatjournalier">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatjournalier']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][10][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="etatecart">
                                                <td align="left">Etat Ecart</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][11][lien]" value="etatecart">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatecart']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][11][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="etatimpaye">
                                                <td align="left">Etat Impayé</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][12][lien]" value="etatimpaye">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatimpaye']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][12][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="etatpayeimpaye">
                                                <td align="left">Etat Payé/Impayé</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][13][lien]" value="etatpayeimpaye">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatpayeimpaye']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][13][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="etatdebitcredit">
                                                <td align="left">Etat Débit/Crédit</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][14][lien]" value="etatdebitcredit">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatdebitcredit']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][14][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="etatreglementbl">
                                                <td align="left">Etat Réglement BL</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][15][lien]" value="etatreglementbl">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['etatreglementbl']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][15][imprimer]" value="1"></td>

                                            </tr>



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </nav>
                </div>
            </div>
            <!-- /.box -->
</section>


<script>
    $(document).ready(function() {
        function updateButtonState() {
            $('.toggle-btn').each(function() {
                var checkboxes = $(this).closest('tr').find(':checkbox');
                var isChecked = checkboxes.length > 0 && checkboxes.filter(':checked').length === checkboxes.length;
                $(this).toggleClass('active', isChecked);
            });
        }

        // On page load, update button states
        updateButtonState();

        // Handle toggle button clicks

    });
</script>
<style>
    .toggle-btn {
        display: inline-block;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        border: 1px solid #007BFF;
        color: #007BFF;
        border-radius: 5px;
        cursor: pointer;
        background-color: white;
        transition: all 0.3s ease;
    }

    /* .toggle-btn.active {
        background-color: #007BFF;
        color: white;
    } */
</style>

<script>
    $(function() {
        $('.cocheru').on('click', function() {
            index = $(this).attr('index');
            ligne = $(this).attr('ligne');
            ind = $(this).attr('ind');
            for (i = 0; i <= Number(ligne); i++) {
                for (j = 0; i <= Number(ind); i++) {
                    $('#' + index + i).prop('checked', true);
                }
            }
        })
        //*************************************************************************************************************
        $('.decocheru').on('click', function() {
            index = $(this).attr('index');
            ligne = $(this).attr('ligne');
            ind = $(this).attr('ind');
            for (i = 0; i <= Number(ligne); i++) {
                for (j = 0; i <= Number(ind); i++) {
                    $('#' + index + i).prop('checked', false);
                }
            }
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('.toggle-col-btn').click(function() {
            var columnName = $(this).data('col');

            var checkboxes = $('table td').find('[name$=' + columnName + ']');

            // Vérifier si la plupart des cases sont cochées
            var isChecked = checkboxes.filter(':checked').length > checkboxes.length / 2;


            // Cocher ou décocher toutes les cases en fonction de l'état actuel
            checkboxes.prop('checked', !isChecked);


        });
    });
</script>

<script>
    $(document).ready(function() {
        // Gérer le clic sur l'icône de bascule
        $('.toggle-btn').click(function() {
            // Trouver les cases à cocher dans la même ligne
            var checkboxes = $(this).closest('tr').find(':checkbox');

            // Vérifier si la plupart des cases sont cochées
            var isChecked = checkboxes.filter(':checked').length > checkboxes.length / 2;

            // Cocher ou décocher toutes les cases en fonction de l'état actuel
            checkboxes.prop('checked', !isChecked);

            $(this).toggleClass('active');

        });
    });

    $(document).ready(function() {
        $('.check-all').click(function() {
            var tabId = $(this).data('tab');
            $('#' + tabId).find(':checkbox').prop('checked', true);
        });

        $('.uncheck-all').click(function() {
            var tabId = $(this).data('tab');
            $('#' + tabId).find(':checkbox').prop('checked', false);
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Disable all input and select elements
        $('input, select ,textarea').prop('disabled', true);
    });
</script>