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

                                <li><a href="#clients" data-toggle="tab"><i class="fa fa-fw fa-user-circle-o"></i>Clients</a></li>
                                <li><a href="#articles" data-toggle="tab"><i class="fa fa-fw  fa-cube text-aqua"></i>Articles</a></li>
                                <!-- <li><a href="#prévisionnement" data-toggle="tab"> <i class="fa fa-fw fa-search text-yellow"></i> Prévisionnement</a></li> -->

                                <!-- <li><a href="#zones" data-toggle="tab"><i class=" fa fa-map-o"></i> Zones</a></li> -->

                                <li><a href="#commercials" data-toggle="tab"> <i class="fa fa-fw fa-users text-purple"></i> Commercials</a></li>
                                <!-- <li><a href="#caisses" data-toggle="tab"> <i class="fa fa-fw fa-dollar" style="color: #515DF9;"></i> Caisses</a></li> -->
                                <li><a href="#finance" data-toggle="tab"> <i class="fa fa-fw fa-money text-red"></i> Finances</a></li>
                                <li><a href="#statistiques" data-toggle="tab"> <i class="fa fa-fw fa-bar-chart" style="color: #4DAAA5;"></i> Statistiques</a></li>


                            </ul>
                            <div class="tab-content tab-border">
                                <div class="tab-pane fade in param active" id="parametrage">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['Parametrage'])) { ?> checked="checked" <?php } ?> name="acces[]" id="ventetab" value="2"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>

                                            </tr>
                                            <tr class="societes">
                                                <td align="left">Societés</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['societes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][0][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][0][lien]" value="societes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['societes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][0][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['societes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][0][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['societes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][0][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="banques">
                                                <td align="left">Banques</td>
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
                                                <td align="left">Devise</td>
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
                                                <td align="left">Transporteurs</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['transporteurs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][30][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][30][lien]" value="transporteurs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['transporteurs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][30][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['transporteurs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][30][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['transporteurs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][30][imprimer]" value="1"></td>

                                            </tr>
                                            
                                            <tr class="fonctions">
                                                <td align="left">Fonctions</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['fonctions']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][3][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][3][lien]" value="fonctions">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fonctions']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][3][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fonctions']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][3][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fonctions']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][3][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="profil">
                                                <td align="left">Profile</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['profile']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][4][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][4][lien]" value="profile">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['profile']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][4][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['profile']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][4][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['profile']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][4][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="utilisateurs">
                                                <td align="left">Utilisateurs</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['utilisateurs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][5][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][5][lien]" value="utilisateurs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['utilisateurs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][5][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['utilisateurs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][5][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['utilisateurs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][5][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="users">
                                                <td align="left">Users</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['users']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][6][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][6][lien]" value="users">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['users']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][6][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['users']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][6][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['users']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][6][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="personnels">
                                                <td align="left">Personnels</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['personnels']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][7][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][7][lien]" value="personnels">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['personnels']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][7][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['personnels']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][7][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['personnels']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][7][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="pays" hidden>
                                                <td align="left">Pays</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['pays']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][21][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][21][lien]" value="pays">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['pays']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][21][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['pays']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][21][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['pays']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][21][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="gouvernorats" hidden>
                                                <td align="left">Gouvernorats</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['gouvernorats']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][8][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][8][lien]" value="gouvernorats">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['gouvernorats']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][8][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['gouvernorats']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][8][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['gouvernorats']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][8][imprimer]" value="1"></td>

                                            </tr><!-- comment -->




                                            <tr class="delegations" hidden>
                                                <td align="left">Délégations</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['delegations']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][9][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][9][lien]" value="delegations">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['delegations']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][9][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['delegations']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][9][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['delegations']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][9][imprimer]" value="1"></td>

                                            </tr>



                                            <tr class="gouvernorats" hidden>
                                                <td align="left">Localités</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['localites']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][10][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][10][lien]" value="localites">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['localites']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][10][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['localites']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][10][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['localites']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][10][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="basepostes" hidden>
                                                <td align="left">Base postes</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['basepostes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][35][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][35][lien]" value="basepostes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['basepostes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][35][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['basepostes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][35][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['basepostes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][35][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="cartecarburants" hidden>
                                                <td align="left">Cartecarburant</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['cartecarburants']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][11][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][11][lien]" value="cartecarburants">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['cartecarburants']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][11][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['cartecarburants']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][11][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['cartecarburants']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][11][imprimer]" value="1"></td>

                                            </tr>


                                            <tr class="typecartecarburants" hidden>
                                                <td align="left">Type Carte Carburants</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['typecartecarburants']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][12][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][12][lien]" value="typecartecarburants">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typecartecarburants']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][12][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typecartecarburants']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][12][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typecartecarburants']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][12][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="materieltransports" hidden>
                                                <td align="left">Materieltransports</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['materieltransports']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][13][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][13][lien]" value="materieltransports">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['materieltransports']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][13][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['materieltransports']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][13][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['materieltransports']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][13][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="timbres">
                                                <td align="left">Timbres</td>
                                                <td align="center">
                                                    <input type="hidden" name="data[2][Lien][14][lien]" value="timbres">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['timbres']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][14][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['timbres']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][14][delete]" value="1"></td>
                                            </tr>

                                            <tr class="tvas">
                                                <td align="left">TVA</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['tvas']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][15][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][15][lien]" value="tvas">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tvas']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][15][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tvas']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][15][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tvas']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][15][imprimer]" value="1"></td>

                                            </tr>
                                            <tr class="tpes">
                                                <td align="left">TPE</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['tpes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][16][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][16][lien]" value="tpes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tpes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][16][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tpes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][16][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['tpes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][16][imprimer]" value="1"></td>
                                            </tr>
                                            <tr class="fodecs">
                                                <td align="left">Fodec</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['fodecs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][17][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][17][lien]" value="fodecs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fodecs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][17][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fodecs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][17][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['fodecs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][17][imprimer]" value="1"></td>
                                            </tr>


                                            <tr class="typeexons">
                                                <td align="left">Type exonerations</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['typeexons']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][18][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][18][lien]" value="typeexons">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typeexons']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][18][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typeexons']['delete'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][18][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['typeexons']['imprimer'] == 1) { ?> checked="checked" <?php } ?>name="data[2][Lien][18][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>



                                            <tr class="caisses" hidden>
                                                <td align="left">Caisses</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Parametrage']['caisses']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][2][add]" value="1">
                                                    <input type="hidden" name="data[2][Lien][2][lien]" value="caisses">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['caisses']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][2][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['caisses']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][2][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Parametrage']['caisses']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[2][Lien][2][imprimer]" value="1"></td>

                                            </tr>

                                            <tr class="tracemisajour">
                                                <td align="left">Trace mise a jour</td>
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
                                            <tr class="bondechargements">
                                                <td align="left">Bon De Chargements</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Stock']['bondechargements']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][5][add]" value="1">
                                                    <input type="hidden" name="data[1][Lien][5][lien]" value="bondechargements">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bondechargements']['edit'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][5][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bondechargements']['delete'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][5][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bondechargements']['imprimer'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][5][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="bonreceptionstocks">
                                                <td align="left">Bon Reception Stocks</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Stock']['bonreceptionstocks']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][6][add]" value="1">
                                                    <input type="hidden" name="data[1][Lien][6][lien]" value="bonreceptionstocks">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bonreceptionstocks']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][6][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bonreceptionstocks']['delete'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][6][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bonreceptionstocks']['imprimer'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][6][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                            <tr class="bondetransferts">
                                                <td align="left">Bon De Transferts</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Stock']['bondetransferts']['add'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][7][add]" value="1">
                                                    <input type="hidden" name="data[1][Lien][7][lien]" value="bondetransferts">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bondetransferts']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[1][Lien][7][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bondetransferts']['delete'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][7][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Stock']['bondetransferts']['imprimer'] == 1) { ?> checked="checked" <?php } ?>name="data[1][Lien][7][imprimer]" value="1"></td>

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
                                                <td align="left">Fournisseurs</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['fournisseurs']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][0][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][0][lien]" value="fournisseurs">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['fournisseurs']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][0][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['fournisseurs']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][0][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['fournisseurs']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][0][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                            <tr class="services">
                                                <td align="left">Services</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['services']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][6][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][6][lien]" value="services">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['services']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][6][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['services']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][6][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['services']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][6][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="machines">
                                                <td align="left">Machines</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['machines']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][9][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][9][lien]" value="machines">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['machines']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][9][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['machines']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][9][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['machines']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][9][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>


                                            <tr class="charges">
                                                <td align="left">Charges</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['charges']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][7][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][7][lien]" value="charges">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['charges']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][7][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['charges']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][7][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['charges']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][7][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                            <tr class="besionachats">
                                                <td align="left">Besoin Achat</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['besionachats']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][8][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][8][lien]" value="besionachats">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['besionachats']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][8][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['besionachats']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][8][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['besionachats']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][8][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="demandeoffredeprixes">
                                                <td align="left">demande offre de prix</td>
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
                                                <td align="left">Bon commandes</td>
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
                                                <td align="left">Bon livraisons</td>
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
                                                <td align="left">Factures</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Achat']['factures']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][4][add]" value="1">
                                                    <input type="hidden" name="data[3][Lien][4][lien]" value="factures">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['factures']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][4][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['factures']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][4][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Achat']['factures']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[3][Lien][4][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>
                                            <tr class="reglements">
                                                <td align="left">Reglements</td>
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
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['Vente'])) { ?> checked="checked" <?php } ?> name="acces[]" id="ventetab" value="4"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>


                                            <tr class="integrations" hidden>
                                                <td align="left">Integrations</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['integrations']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][9][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][9][lien]" value="integrations">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['integrations']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][9][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['integrations']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][9][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['integrations']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][9][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="offredeprix">
                                                <td align="left">Devis</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['offredeprix']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][18][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][18][lien]" value="offredeprix">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['offredeprix']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][18][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['offredeprix']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][18][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['offredeprix']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][18][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="commandes">
                                                <td align="left">Commande clients</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['commandes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][10][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][10][lien]" value="commandes">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['commandes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][10][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['commandes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][10][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['commandes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][10][imprimer]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['commandes']['valide'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][10][valide]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>


                                            <tr class="bonlivraisons">
                                                <td align="left">Bon livraison</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['bonlivraisons']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][16][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][16][lien]" value="bonlivraisons">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['bonlivraisons']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][16][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['bonlivraisons']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][16][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['bonlivraisons']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][16][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="factureclients">
                                                <td align="left">Facture client</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['factureclients']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][17][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][17][lien]" value="factureclients">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureclients']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][17][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureclients']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][17][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['factureclients']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][17][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="reglementclients">
                                                <td align="left">Reglement</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Vente']['reglementclients']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][19][add]" value="1">
                                                    <input type="hidden" name="data[4][Lien][19][lien]" value="reglementclients">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclients']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][19][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclients']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][19][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Vente']['reglementclients']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[4][Lien][19][imprimer]" value="1"></td>

                                                <td align="center"></td>
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

                                           




                                        </tbody>
                                    </table>
                                </div>


                                <!-- <div class="tab-pane fade in param" id="prévisionnement">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['prévisionnement'])) { ?> checked="checked" <?php } ?> name="acces[]" id="prévisionnement" value="12"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>
                                            <tr class="inventaires">
                                                <td align="left">Achat</td>
                                                <td align="center">
                                                    <input type="hidden" name="data[12][Lien][0][lien]" value="inventaires">
                                                </td>
                                                <td align="center"></td>
                                                <td align="center"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['prévisionnement']['inventaires']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[12][Lien][0][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="previsionachats">
                                                <td align="left">Productions </td>
                                                <td align="center">

                                                    <input type="hidden" name="data[12][Lien][1][lien]" value="previsionachats">
                                                </td>
                                                <td align="center"></td>
                                                <td align="center"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['prévisionnement']['previsionachats']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[12][Lien][1][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>
                                            <tr class="previsionachatsv">
                                                <td align="left">Vente N-1 </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['prévisionnement']['previsionachatsv']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[12][Lien][2][add]" value="1">
                                                    <input type="hidden" name="data[12][Lien][2][lien]" value="previsionachatsv">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['prévisionnement']['previsionachatsv']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[12][Lien][2][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['prévisionnement']['previsionachatsv']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[12][Lien][2][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['prévisionnement']['previsionachatsv']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[12][Lien][2][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> -->




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
                                                <td align="left">Unités </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['Article']['unitecontenance']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][1][add]" value="1">
                                                    <input type="hidden" name="data[8][Lien][1][lien]" value="unitecontenance">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['unitecontenance']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][1][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['unitecontenance']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][1][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['Article']['unitecontenance']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[8][Lien][1][imprimer]" value="1"></td>

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
                                                <td align="left">Familles </td>
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
                                                <td align="left">Sous famille</td>
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
                                                <td align="left">Articles</td>
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
                                                <td align="left">Changement de prix</td>
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
                                                <td align="left">Etat historique article</td>
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

                                            <tr class="depenses">
                                                <td align="left"> Dépenses </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['caisses']['depenses']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][2][add]" value="1">
                                                    <input type="hidden" name="data[10][Lien][2][lien]" value="depenses">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['depenses']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][2][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['depenses']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][2][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['caisses']['depenses']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[10][Lien][2][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>

















                                        </tbody>
                                    </table>
                                </div>






                                <div class="tab-pane fade in param" id="commercials">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%">

                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" <?php if (isset($matrice['commercials'])) { ?> checked="checked" <?php } ?> name="acces[]" id="zones1" value="11"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>




                                            <tr class="commercials">
                                                <td align="left">Commercial</td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['commercials']['commercials']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][0][add]" value="1">
                                                    <input type="hidden" name="data[11][Lien][0][lien]" value="commercials">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['commercials']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][0][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['commercials']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][0][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['commercials']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][0][imprimer]" value="1"></td>

                                                <td align="center"></td>
                                            </tr>

                                            <tr class="categories">
                                                <td align="left">Categories </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['commercials']['categories']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][1][add]" value="1">
                                                    <input type="hidden" name="data[11][Lien][1][lien]" value="categories">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['categories']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][1][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['categories']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][1][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['categories']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][1][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>

                                            <!-- <tr class="commandes">
                                                <td align="left">Bonus/Malus </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['commercials']['bonusmalus']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][2][add]" value="1">
                                                    <input type="hidden" name="data[11][Lien][2][lien]" value="bonusmalus">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['bonusmalus']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][2][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['bonusmalus']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][2][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['bonusmalus']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][2][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>





                                            <tr class="commandes">
                                                <td align="left">Reglement commercial </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['commercials']['reglementcommercial']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][3][add]" value="1">
                                                    <input type="hidden" name="data[11][Lien][3][lien]" value="reglementcommercial">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['reglementcommercial']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][3][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['reglementcommercial']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][3][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['reglementcommercial']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][3][imprimer]" value="1"></td>
                                                <td align="center"></td>
                                            </tr>

                                            <tr class="commandes">
                                                <td align="left">Relev� commercial </td>
                                                <td align="center">
                                                    <input type="checkbox" <?php if (@$matrice['commercials']['relevecommercial']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][4][add]" value="1">
                                                    <input type="hidden" name="data[11][Lien][4][lien]" value="relevecommercial">
                                                </td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['relevecommercial']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][4][edit]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['relevecommercial']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][4][delete]" value="1"></td>
                                                <td align="center"><input type="checkbox" <?php if (@$matrice['commercials']['relevecommercial']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[11][Lien][4][imprimer]" value="1"></td>
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
                                      <tr class="engagementfournisseur">
                                        <td align="left">Etat de paiement Fournisseur</td>
                                        <td align="center">
                                          <input type="checkbox" <?php if (@$matrice['Finance']['engagementfournisseur']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][13][add]" value="1">
                                          <input type="hidden" name="data[5][Lien][13][lien]" value="engagementfournisseur">
                                        </td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementfournisseur']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][13][edit]" value="1"></td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementfournisseur']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][13][delete]" value="1"></td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['engagementfournisseur']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][13][imprimer]" value="1"></td>
                
                                      </tr>
                                      <tr class="listecheque">
                                        <td align="left">Liste chéque</td>
                                        <td align="center">
                                          <input type="checkbox" <?php if (@$matrice['Finance']['listecheque']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][14][add]" value="1">
                                          <input type="hidden" name="data[5][Lien][14][lien]" value="listecheque">
                                        </td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['listecheque']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][14][edit]" value="1"></td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['listecheque']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][14][delete]" value="1"></td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['listecheque']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][14][imprimer]" value="1"></td>
                
                                      </tr>
                                      <tr class="listetraite">
                                        <td align="left">Liste traite</td>
                                        <td align="center">
                                          <input type="checkbox" <?php if (@$matrice['Finance']['listetraite']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][15][add]" value="1">
                                          <input type="hidden" name="data[5][Lien][15][lien]" value="listetraite">
                                        </td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['listetraite']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][15][edit]" value="1"></td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['listetraite']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][15][delete]" value="1"></td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Finance']['listetraite']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[5][Lien][15][imprimer]" value="1"></td>
                
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
                                      <tr class="listeoffres">
                                        <td align="left">Liste Offres de prix Vente</td>
                                        <td align="center">
                                          <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listeoffres']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][13][add]" value="1"> -->
                                          <input type="hidden" name="data[6][Lien][13][lien]" value="listeoffres">
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listeoffres']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][13][edit]" value="1"> -->
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listeoffres']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][13][delete]" value="1"> -->
                                        </td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['listeoffres']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][13][imprimer]" value="1"></td>
                
                                      </tr>
                                      <tr class="listecommandes">
                                        <td align="left">Liste Commandes Vente</td>
                                        <td align="center">
                                          <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listecommandes']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][14][add]" value="1"> -->
                                          <input type="hidden" name="data[6][Lien][14][lien]" value="listecommandes">
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listecommandes']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][14][edit]" value="1"> -->
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listecommandes']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][14][delete]" value="1"> -->
                                        </td>
                                        <td align="center">
                                            <input type="checkbox" <?php if (@$matrice['Stat']['listecommandes']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][14][imprimer]" value="1"></td>
                
                                      </tr>
                                      <tr class="listefactures">
                                        <td align="left">Liste Factures Vente</td>
                                        <td align="center">
                                          <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listefactures']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][15][add]" value="1"> -->
                                          <input type="hidden" name="data[6][Lien][15][lien]" value="listefactures">
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listefactures']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][15][edit]" value="1"> -->
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listefactures']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][15][delete]" value="1"> -->
                                        </td>
                                        <td align="center">
                                            <input type="checkbox" <?php if (@$matrice['Stat']['listefactures']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][15][imprimer]" value="1">
                                        </td>
                
                                      </tr>

                                      <tr class="listebl">
                                        <td align="left">Liste Bons de livraisons Vente</td>
                                        <td align="center">
                                          <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listebl']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][add]" value="1"> -->
                                          <input type="hidden" name="data[6][Lien][16][lien]" value="listebl">
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listebl']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][edit]" value="1"> -->
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listebl']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][delete]" value="1"> -->
                                        </td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['listebl']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][imprimer]" value="1"></td>
                
                                      </tr>


                                     


                                      <tr class="listecommandesachat">
                                        <td align="left">Liste Commandes Achat</td>
                                        <td align="center">
                                          <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listecommandesachat']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][add]" value="1"> -->
                                          <input type="hidden" name="data[6][Lien][18][lien]" value="listecommandesachat">
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listecommandesachat']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][edit]" value="1"> -->
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listecommandesachat']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][delete]" value="1"> -->
                                        </td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['listecommandesachat']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][18][imprimer]" value="1"></td>
                
                                      </tr>

                                      <tr class="listeblachat">
                                        <td align="left">Liste Bons de livraisons Achat</td>
                                        <td align="center">
                                          <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listeblachat']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][add]" value="1"> -->
                                          <input type="hidden" name="data[6][Lien][17][lien]" value="listeblachat">
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listeblachat']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][edit]" value="1"> -->
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listeblachat']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][delete]" value="1"> -->
                                        </td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['listeblachat']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][17][imprimer]" value="1"></td>
                
                                      </tr>


                                      <tr class="listefacturesachat">
                                        <td align="left">Liste Factures Achat</td>
                                        <td align="center">
                                          <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listefacturesachat']['add'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][add]" value="1"> -->
                                          <input type="hidden" name="data[6][Lien][19][lien]" value="listefacturesachat">
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listefacturesachat']['edit'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][edit]" value="1"> -->
                                        </td>
                                        <td align="center">
                                            <!-- <input type="checkbox" <?php if (@$matrice['Stat']['listefacturesachat']['delete'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][16][delete]" value="1"> -->
                                        </td>
                                        <td align="center"><input type="checkbox" <?php if (@$matrice['Stat']['listefacturesachat']['imprimer'] == 1) { ?> checked="checked" <?php } ?> name="data[6][Lien][19][imprimer]" value="1"></td>
                
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
    $(document).ready(function() {
    var $checkboxes = $('input[type="checkbox"]');
    var $inputs = $('input[type="text"], input[type="number"], input[type="email"], input[type="password"], input[type="date"], input[type="file"], input[type="radio"], input[type="time"]');
    var $textareas = $('textarea');
    var $selects = $('select');
    $checkboxes.prop('disabled', true);
    $inputs.prop('disabled', true);
    $textareas.prop('disabled', true);
    $selects.prop('disabled', true);
  });
</script>
