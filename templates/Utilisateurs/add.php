<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Utilisateur $utilisateur
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
    <h1>
        <?php
        // $acc = ClassRegistry::init('Accueil')->find('first');
        // $abrv = $acc['Accueil']['name']; 
        ?>
        Profile
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo $this->Form->create($utilisateur, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->control('name');
                    ?>

                    <!-- <label style="margin-right:2px" class="control-label"> Commercials: </label>
                    <input type="checkbox" name="commercial" value="1"> -->
                    <!--                    <input type="text" name="data[commercials][lien]" value="menucommercial">-->
                </div>
                <div>
                    <h4 class="box" style="background-color: 	#f8f8ff ; border: 20px solid #f8f8ff;">
                        Droit D'acces
                    </h4>
                    <nav class="navbar navbar-default" style="background-color:white;">
                        <div class="container-fluid">
                            <ul class="nav navbar-nav">
                                <li><a href="#parametrage" data-toggle="tab"><i class="fa fa-fw fa-cog text-aqua"></i>Parametrage</a></li>
                                <li><a href="#achat" data-toggle="tab"><i class="fa fa-fw fa-cart-plus text-yellow"></i>Achat</a></li>
                                <li><a href="#vente" data-toggle="tab"><i class="fa fa-laptop text-green"></i>Vente</a></li>
                                <li><a href="#stock" data-toggle="tab"><i class="fa fa-fw  fa-cubes text-red"></i>Stock</a></li>
                                <li><a href="#gestionprojet" data-toggle="tab"><i class="fa fa-fw fa-laptop text-green"></i>Gestion Projet</a></li>

                                <!-- <li><a href="#prévisionnement" data-toggle="tab"> <i class="fa fa-fw fa-search text-yellow"></i> Prévisionnements</a></li> -->
                                <li><a href="#clients" data-toggle="tab"><i class="fa fa-user-circle-o"></i>clients</a></li>
                                <li><a href="#articles" data-toggle="tab"><i class="fa fa-fw  fa-cube text-aqua"></i>Articles</a></li>
                                <!-- <li><a href="#zones" data-toggle="tab"><i class=" fa fa-map-o"></i> Zones</a></li> -->
                                <li><a href="#commercials" data-toggle="tab"> <i class="fa fa-fw fa-users text-purple"></i> Commercials</a></li>
                                <!-- <li><a  hidden href="#caisses" data-toggle="tab"> <i class="fa fa-fw fa-dollar" style="color: #515DF9;"></i> Caisses</a></li> -->
                                <li><a href="#finance" data-toggle="tab"> <i class="fa fa-fw fa-money text-red"></i> Finances</a></li>
                                <li><a href="#statistiques" data-toggle="tab"> <i class="fa fa-fw fa-bar-chart" style="color: #4DAAA5;"></i> Statistiques</a></li>

                            </ul>

                            <div class="tab-content tab-border">
                                <div class="tab-pane fade in param active" id="parametrage">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="p" ligne="1" ind="100" class="cocheru">Tout Cocher</a>/
                                        <a index="p" ligne="1" ind="100" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="p1" value="2"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                            </tr>
                                            <tr class="societes">
                                                <td align="left">Societés</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][0][add]" id="p2" value="1">
                                                    <input type="hidden" name="data[2][Lien][0][lien]" value="societes">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][0][edit]" id="p3" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][0][delete]" id="p4" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][0][imprimer]" id="p5" value="1"></td>
                                            </tr>


                                            <tr class="banques">
                                                <td align="left">Banques</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][1][add]" id="p6" value="1">
                                                    <input type="hidden" name="data[2][Lien][1][lien]" value="banques">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][1][edit]" id="p7" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][1][delete]" id="p8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][1][imprimer]" id="p9" value="1"></td>
                                            </tr>

                                            <tr class="devises">
                                                <td align="left">Devise</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][20][add]" id="p80" value="1">
                                                    <input type="hidden" name="data[2][Lien][20][lien]" value="devises">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][20][edit]" id="p81" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][20][delete]" id="p82" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][20][imprimer]" id="p83" value="1"></td>
                                            </tr>
                                            <tr class="transporteurs">
                                                <td align="left">Transporteurs</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][30][add]" id="p80" value="1">
                                                    <input type="hidden" name="data[2][Lien][30][lien]" value="transporteurs">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][30][edit]" id="p81" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][30][delete]" id="p82" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][30][imprimer]" id="p83" value="1"></td>
                                            </tr>


                                            <tr class="fonctions">
                                                <td align="left">Fonctions</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][3][add]" id="p14" value="1">
                                                    <input type="hidden" name="data[2][Lien][3][lien]" value="fonctions">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][3][edit]" id="p15" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][3][delete]" id="p16" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][3][imprimer]" id="p17" value="1"></td>
                                            </tr>

                                            <tr class="fonctions">
                                                <td align="left">profile</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][4][add]" id="p18" value="1">
                                                    <input type="hidden" name="data[2][Lien][4][lien]" value="profile">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][4][edit]" id="p19" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][4][delete]" id="p20" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][4][imprimer]" id="p21" value="1"></td>
                                            </tr>



                                            <tr class="utilisateurs">
                                                <td align="left">Utilisateurs</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][5][add]" id="p22" value="1">
                                                    <input type="hidden" name="data[2][Lien][5][lien]" value="utilisateurs">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][5][edit]" id="p23" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][5][delete]" id="p24" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][5][imprimer]" id="p25" value="1"></td>
                                            </tr>


                                            <tr class="users">
                                                <td align="left">Users</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][6][add]" id="p26" value="1">
                                                    <input type="hidden" name="data[2][Lien][6][lien]" value="users">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][6][edit]" id="p27" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][6][delete]" id="p28" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][6][imprimer]" id="p29" value="1"></td>
                                            </tr>




                                            <tr class="personnels">
                                                <td align="left">Personnels</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][7][add]" id="p30" value="1">
                                                    <input type="hidden" name="data[2][Lien][7][lien]" value="personnels">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][7][edit]" id="p31" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][7][delete]" id="p32" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][7][imprimer]" id="p33" value="1"></td>
                                            </tr>
                                            <tr class="pays" hidden>
                                                <td align="left">Pays</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][21][add]" id="p84" value="1">
                                                    <input type="hidden" name="data[2][Lien][21][lien]" value="pays">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][21][edit]" id="p85" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][21][delete]" id="p86" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][21][imprimer]" id="p87" value="1"></td>
                                            </tr>

                                            <tr class="gouvernorats" hidden>
                                                <td align="left">Gouvernorats</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][8][add]" id="p34" value="1">
                                                    <input type="hidden" name="data[2][Lien][8][lien]" value="gouvernorats">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][8][edit]" id="p35" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][8][delete]" id="p36" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][8][imprimer]" id="p37" value="1"></td>
                                            </tr><!-- comment -->


                                            <tr class="delegations" hidden>
                                                <td align="left">Delegations</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][9][add]" id="p38" value="1">
                                                    <input type="hidden" name="data[2][Lien][9][lien]" value="delegations">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][9][edit]" id="p39" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][9][delete]" id="p40" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][9][imprimer]" id="p41" value="1"></td>
                                            </tr>



                                            <tr class="localites" hidden>
                                                <td align="left">Localites</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][10][add]" id="p42" value="1">
                                                    <input type="hidden" name="data[2][Lien][10][lien]" value="localites">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][10][edit]" id="p43" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][10][delete]" id="p44" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][10][imprimer]" id="p45" value="1"></td>
                                            </tr>
                                            <tr class="basepostes" hidden>
                                                <td align="left">Base postes </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][35][add]" id="p76" value="1">
                                                    <input type="hidden" name="data[2][Lien][35][lien]" value="basepostes">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][35][edit]" id="p77" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][35][delete]" id="p78" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][35][imprimer]" id="p79" value="1"></td>
                                            </tr>
                                            <tr class="cartecarburants" hidden>
                                                <td align="left">Cartecarburant</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][11][add]" id="p46" value="1">
                                                    <input type="hidden" name="data[2][Lien][11][lien]" value="cartecarburants">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][11][edit]" id="p47" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][11][delete]" id="p48" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][11][imprimer]" id="p49" value="1"></td>
                                            </tr>
                                            <tr class="typecartecarburants" hidden>
                                                <td align="left">Type Carte Carburant</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][12][add]" id="p50" value="1">
                                                    <input type="hidden" name="data[2][Lien][12][lien]" value="typecartecarburants">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][12][edit]" id="p51" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][12][delete]" id="p52" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][12][imprimer]" id="p53" value="1"></td>
                                            </tr>
                                            <tr class="materieltransports" hidden>
                                                <td align="left">Materieltransports</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][13][add]" id="p54" value="1">
                                                    <input type="hidden" name="data[2][Lien][13][lien]" value="materieltransports">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][13][edit]" id="p55" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][13][delete]" id="p56" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][13][imprimer]" id="p57" value="1"></td>
                                            </tr>
                                            <!--                                            <tr class="pointdeventes">
                                                <td align="left">Points De Ventes</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][4][add]" id="p6" value="1">
                                                    <input type="hidden" name="data[2][Lien][4][lien]" value="pointdeventes">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][4][edit]" id="p7" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][4][delete]" id="p8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][4][imprimer]" id="p9" value="1"></td>
                                            </tr>-->


                                            <tr class="timbres">
                                                <td align="left">Timbres</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[2][Lien][14][lien]" value="timbres">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][14][edit]" id="p58" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][14][delete]" id="p59" value="1"></td>
                                            </tr>







                                            <tr class="tvas">
                                                <td align="left">TVA</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][15][add]" id="p60" value="1">
                                                    <input type="hidden" name="data[2][Lien][15][lien]" value="tvas">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][15][edit]" id="p61" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][15][delete]" id="p62" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][15][imprimer]" id="p63" value="1"></td>
                                            </tr>
                                            <tr class="tpes">
                                                <td align="left">TPE</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][16][add]" id="p79" value="1">
                                                    <input type="hidden" name="data[2][Lien][16][lien]" value="tpes">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][16][edit]" id="p64" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][16][delete]" id="p65" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][16][imprimer]" id="p66" value="1"></td>
                                            </tr>
                                            <tr class="fodecs">
                                                <td align="left">Fodec</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][17][add]" id="p67" value="1">
                                                    <input type="hidden" name="data[2][Lien][17][lien]" value="fodecs">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][17][edit]" id="p68" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][17][delete]" id="p69" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][17][imprimer]" id="p70" value="1"></td>
                                            </tr>
                                            <tr class="typeexons">
                                                <td align="left">Type exonerations</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][18][add]" id="p71" value="1">
                                                    <input type="hidden" name="data[2][Lien][18][lien]" value="typeexons">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][18][edit]" id="p72" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][18][delete]" id="p73" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][18][imprimer]" id="p74" value="1"></td>
                                            </tr>
                                            <tr class="caisses" hidden>
                                                <td align="left">Caisses</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][2][add]" id="p10" value="1">
                                                    <input type="hidden" name="data[2][Lien][2][lien]" value="caisses">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][2][edit]" id="p11" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][2][delete]" id="p12" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][2][imprimer]" id="p13" value="1"></td>
                                            </tr>

                                            <tr class="tracemisajour">
                                                <td align="left">Trace mise a jour</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][19][add]" id="p75" value="1">
                                                    <input type="hidden" name="data[2][Lien][19][lien]" value="tracemisajour">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][19][edit]" id="p76" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][19][delete]" id="p77" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][19][imprimer]" id="p78" value="1"></td>
                                            </tr>

                                            <!--                                            <tr class="remiseqtes">
                                                <td align="left">Remise/comptant </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][36][add]" id="p80" value="1">
                                                    <input type="hidden" name="data[2][Lien][36][lien]" value="remiseqtes">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][36][edit]" id="p81" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][36][delete]" id="p82" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][36][imprimer]" id="p83" value="1"></td>
                                            </tr>
                                            <tr class="familles">
                                                <td align="left">Familles </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][37][add]" id="p84" value="1">
                                                    <input type="hidden" name="data[2][Lien][37][lien]" value="familles">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][37][edit]" id="p85" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][37][delete]" id="p86" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][37][imprimer]" id="p87" value="1"></td>
                                            </tr>
                                            <tr class="sousfamille1s">
                                                <td align="left">Sous Familles </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][38][add]" id="p88" value="1">
                                                    <input type="hidden" name="data[2][Lien][38][lien]" value="sousfamille1s">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][38][edit]" id="p89" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][38][delete]" id="p90" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][38][imprimer]" id="p91" value="1"></td>
                                            </tr>
                                            <tr class="sousfamille2s">
                                                <td align="left">Sous sous Familles </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][39][add]" id="p92" value="1">
                                                    <input type="hidden" name="data[2][Lien][39][lien]" value="sousfamille2s">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][39][edit]" id="p93" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][39][delete]" id="p94" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][39][imprimer]" id="p95" value="1"></td>
                                            </tr>
                                            <tr class="unites">
                                                <td align="left">Unites</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][40][add]" id="p96" value="1">
                                                    <input type="hidden" name="data[2][Lien][40][lien]" value="unites">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][40][edit]" id="p97" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][40][delete]" id="p98" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][40][imprimer]" id="p99" value="1"></td>
                                            </tr>
                                            <tr class="nombrecommandes">
                                                <td align="left">BC Bonifier</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][41][add]" id="p100" value="1">
                                                    <input type="hidden" name="data[2][Lien][41][lien]" value="nombrecommandes">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][41][edit]" id="p101" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][41][delete]" id="p102" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][41][imprimer]" id="p103" value="1"></td>
                                            </tr>
                                            <tr class="coefficientclients">
                                                <td align="left">Coefficient Clients</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[2][Lien][42][add]" id="p104" value="1">
                                                    <input type="hidden" name="data[2][Lien][42][lien]" value="coefficientclients">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][42][edit]" id="p105" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][42][delete]" id="p106" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[2][Lien][42][imprimer]" id="p107" value="1"></td>
                                            </tr>-->

                                            <!--                                            <tr class="articleunites">
     <td align="left">Article Unites</td>
     <td align="center">
         <input type="checkbox" name="data[2][Lien][44][add]" id="p112" value="1">
         <input type="hidden" name="data[2][Lien][44][lien]" value="articleunites">
     </td>
     <td align="center"><input type="checkbox" name="data[2][Lien][44][edit]" id="p113" value="1"></td>
     <td align="center"><input type="checkbox" name="data[2][Lien][44][delete]" id="p114" value="1"></td>
     <td align="center"><input type="checkbox" name="data[2][Lien][44][imprimer]" id="p115" value="1"></td>
 </tr>
 <tr class="categories">
     <td align="left">Categories</td>
     <td align="center">
         <input type="checkbox" name="data[2][Lien][45][add]" id="p116" value="1">
         <input type="hidden" name="data[2][Lien][45][lien]" value="categories">
     </td>
     <td align="center"><input type="checkbox" name="data[2][Lien][45][edit]" id="p117" value="1"></td>
     <td align="center"><input type="checkbox" name="data[2][Lien][45][delete]" id="p118" value="1"></td>
     <td align="center"><input type="checkbox" name="data[2][Lien][45][imprimer]" id="p119" value="1"></td>
 </tr>
 <tr class="famillerotations">
     <td align="left">Famille Rotations</td>
     <td align="center">
         <input type="checkbox" name="data[2][Lien][46][add]" id="p120" value="1">
         <input type="hidden" name="data[2][Lien][46][lien]" value="famillerotations">
     </td>
     <td align="center"><input type="checkbox" name="data[2][Lien][46][edit]" id="p121" value="1"></td>
     <td align="center"><input type="checkbox" name="data[2][Lien][46][delete]" id="p122" value="1"></td>
     <td align="center"><input type="checkbox" name="data[2][Lien][46][imprimer]" id="p123" value="1"></td>
 </tr>-->







                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade in " id="stock<?php $abrv ?>">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="s" ligne="1" ind="59" class="cocheru">Tout Cocher</a>/
                                        <a index="s" ligne="1" ind="59" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="s1" value="1"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                            </tr>
                                            <tr class="depots">
                                                <td align="left">Dépots</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[1][Lien][7][add]" id="s34" value="1">
                                                    <input type="hidden" name="data[1][Lien][7][lien]" value="depots">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][7][edit]" id="s35" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][7][delete]" id="s36" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][7][imprimer]" id="s37" value="1"></td>
                                            </tr>
                                            <tr class="stockdepots">
                                                <td align="left">Stock depots</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[1][Lien][14][add]" id="s54" value="1">
                                                    <input type="hidden" name="data[1][Lien][14][lien]" value="stockdepots">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][14][edit]" id="s55" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][14][delete]" id="s56" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][14][imprimer]" id="s57" value="1"></td>
                                            </tr>

                                            <tr class="suivistocks">
                                                <td align="left">Suivi stock </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[1][Lien][12][add]" id="s2" value="1">
                                                    <input type="hidden" name="data[1][Lien][12][lien]" value="suivistocks">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][12][edit]" id="s3" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][12][delete]" id="s4" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][12][imprimer]" id="s5" value="1"></td>
                                            </tr>

                                            <tr class="inventairestock">
                                                <td align="left">Inventaires</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[1][Lien][13][add]" id="s6" value="1">
                                                    <input type="hidden" name="data[1][Lien][13][lien]" value="inventairestock">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][13][edit]" id="s7" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][13][delete]" id="s8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][13][imprimer]" id="s9" value="1"></td>
                                            </tr>



                                            <tr class="bondechargements">
                                                <td align="left">Bon chargements</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[1][Lien][11][add]" id="s50" value="1">
                                                    <input type="hidden" name="data[1][Lien][11][lien]" value="bondechargements">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][11][edit]" id="s51" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][11][delete]" id="s52" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][11][imprimer]" id="s53" value="1"></td>
                                            </tr>
                                            <tr class="bonsortiestocks">
                                                <td align="left">Bon sortie du stock</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[1][Lien][8][add]" id="s46" value="1">
                                                    <input type="hidden" name="data[1][Lien][8][lien]" value="bonsortiestocks">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][8][edit]" id="s47" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][8][delete]" id="s48" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][8][imprimer]" id="s49" value="1"></td>
                                            </tr>
                                            <tr class="bonreceptionstocks">
                                                <td align="left">Bon reception du stock</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[1][Lien][9][add]" id="s38" value="1">
                                                    <input type="hidden" name="data[1][Lien][9][lien]" value="bonreceptionstocks">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][9][edit]" id="s39" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][9][delete]" id="s40" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][9][imprimer]" id="s41" value="1"></td>
                                            </tr>
                                            <tr class="bondetransferts">
                                                <td align="left">bon transferts</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[1][Lien][10][add]" id="s42" value="1">
                                                    <input type="hidden" name="data[1][Lien][10][lien]" value="bondetransferts">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][10][edit]" id="s43" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][10][delete]" id="s44" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[1][Lien][10][imprimer]" id="s45" value="1"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                
                                <div class="tab-pane fade in param" id="gestionprojet">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="a" ligne="1" ind="100" class="cocheru">Tout Cocher</a>/
                                        <a index="a" ligne="1" ind="100" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="a1" value="26"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>
                                            <tr class="projets">
                                                <td align="left">Projets</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[26][Lien][1][add]" id="a2" value="1">
                                                    <input type="hidden" name="data[26][Lien][1][lien]" value="projets">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][1][edit]" id="a3" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][1][delete]" id="a4" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][1][imprimer]" id="a5" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][1][valide]" id="a6" value="1"></td>
                                            </tr>
                                            <tr class="contrats">
                                                <td align="left">Contrats</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[26][Lien][4][add]" id="a17" value="1">
                                                    <input type="hidden" name="data[26][Lien][4][lien]" value="contrats">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][4][edit]" id="a18" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][4][delete]" id="a19" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][4][imprimer]" id="a20" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][4][valide]" id="a21" value="1"></td>
                                            </tr>
                                            <tr class="transferts">
                                                <td align="left">Transferts</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[26][Lien][3][add]" id="a12" value="1">
                                                    <input type="hidden" name="data[26][Lien][3][lien]" value="transferts">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][3][edit]" id="a13" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][3][delete]" id="a14" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][3][imprimer]" id="a15" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][3][valide]" id="a16" value="1"></td>
                                            </tr>
                                            <tr class="taches">
                                                <td align="left">Taches</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[26][Lien][0][add]" id="a7" value="1">
                                                    <input type="hidden" name="data[26][Lien][0][lien]" value="taches">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][0][edit]" id="a8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][0][delete]" id="a9" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][0][imprimer]" id="a10" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][0][valide]" id="a11" value="1"></td>
                                            </tr>
                                            <!-- <tr class="etatfinance">
                                                <td align="left">Etat Finance</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[26][Lien][2][add]" id="a12" value="1">
                                                    <input type="hidden" name="data[26][Lien][2][lien]" value="etatfinance">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][2][edit]" id="a13" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][2][delete]" id="a14" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][2][imprimer]" id="a15" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[26][Lien][2][valide]" id="a16" value="1"></td>

                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade in vente" id="vente">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="v" ligne="1" ind="59" class="cocheru">Tout Cocher</a>/
                                        <a index="v" ligne="1" ind="59" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="v1" value="4"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>

                                            <tr class="integrations" hidden>
                                                <td align="left">Intégration</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[4][Lien][1][add]" id="v6" value="1">
                                                    <input type="hidden" name="data[4][Lien][1][lien]" value="integrations">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][1][edit]" id="v7" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][1][delete]" id="v8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][1][imprimer]" id="v9" value="1"></td>
                                            </tr>

                                            <tr class="offredeprix">
                                                <td align="left">Devis</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[4][Lien][6][add]" id="v26" value="1">
                                                    <input type="hidden" name="data[4][Lien][6][lien]" value="offredeprix">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][6][edit]" id="v27" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][6][delete]" id="v28" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][6][imprimer]" id="v29" value="1"></td>
                                            </tr>
                                            <tr class="commandes">
                                                <td align="left">Commande clients</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[4][Lien][2][add]" id="v10" value="1">
                                                    <input type="hidden" name="data[4][Lien][2][lien]" value="commandes">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][2][edit]" id="v11" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][2][delete]" id="v12" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][2][imprimer]" id="v13" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][2][valide]" id="v26" value="1"></td>
                                            </tr>
                                            <tr class="bonlivraisons">
                                                <td align="left">Bon livraison</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[4][Lien][3][add]" id="v14" value="1">
                                                    <input type="hidden" name="data[4][Lien][3][lien]" value="bonlivraisons">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][3][edit]" id="v15" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][3][delete]" id="v16" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][3][imprimer]" id="v17" value="1"></td>
                                            </tr>
                                            <tr class="factureclients">
                                                <td align="left">Facture client</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[4][Lien][4][add]" id="v18" value="1">
                                                    <input type="hidden" name="data[4][Lien][4][lien]" value="factureclients">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][4][edit]" id="v19" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][4][delete]" id="v20" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][4][imprimer]" id="v21" value="1"></td>
                                            </tr>
                                            <tr class="reglementclients">
                                                <td align="left">Reglement</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[4][Lien][5][add]" id="v22" value="1">
                                                    <input type="hidden" name="data[4][Lien][5][lien]" value="reglementclients">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][5][edit]" id="v23" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][5][delete]" id="v24" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[4][Lien][5][imprimer]" id="v25" value="1"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="tab-pane fade in param" id="achat">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="a" ligne="1" ind="59" class="cocheru">Tout Cocher</a>/
                                        <a index="a" ligne="1" ind="59" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="a1" value="3"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>
                                            <tr class="fournisseurs">
                                                <td align="left">Fournisseurs</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][0][add]" id="a2" value="1">
                                                    <input type="hidden" name="data[3][Lien][0][lien]" value="fournisseurs">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][0][edit]" id="a3" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][0][delete]" id="a4" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][0][imprimer]" id="a5" value="1"></td>
                                            </tr>
                                            <tr class="services">
                                                <td align="left">Services</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][7][add]" id="a39" value="1">
                                                    <input type="hidden" name="data[3][Lien][7][lien]" value="services">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][7][edit]" id="a40" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][7][delete]" id="a41" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][7][imprimer]" id="a42" value="1"></td>
                                            </tr>
                                            <tr class="machines">
                                                <td align="left">Machines</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][9][add]" id="a43" value="1">
                                                    <input type="hidden" name="data[3][Lien][9][lien]" value="machines">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][9][edit]" id="a44" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][9][delete]" id="a45" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][9][imprimer]" id="a46" value="1"></td>
                                            </tr>

                                            <tr class="charges">
                                                <td align="left">Charges</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][6][add]" id="a26" value="1">
                                                    <input type="hidden" name="data[3][Lien][6][lien]" value="charges">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][6][edit]" id="a27" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][6][delete]" id="a28" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][6][imprimer]" id="a29" value="1"></td>
                                            </tr>

                                            <tr class="besionachats">
                                                <td align="left">Besoin Achat</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][8][add]" id="a35" value="1">
                                                    <input type="hidden" name="data[3][Lien][8][lien]" value="besionachats">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][8][edit]" id="a36" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][8][delete]" id="a37" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][8][imprimer]" id="a38" value="1"></td>
                                            </tr>

                                            <tr class="demandeoffredeprixes">
                                                <td align="left">demande offre de prix</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][1][add]" id="a6" value="1">
                                                    <input type="hidden" name="data[3][Lien][1][lien]" value="demandeoffredeprixes">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][1][edit]" id="a7" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][1][delete]" id="a8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][1][imprimer]" id="a9" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][1][valide]" id="a10" value="1"></td>
                                            </tr>
                                            <tr class="commandes">
                                                <td align="left">Bon commandes</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][2][add]" id="a30" value="1">
                                                    <input type="hidden" name="data[3][Lien][2][lien]" value="commandes">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][2][edit]" id="a31" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][2][delete]" id="a32" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][2][imprimer]" id="a33" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][2][valide]" id="a34" value="1"></td>

                                            </tr>
                                            <tr class="livraisons">
                                                <td align="left">Bon livraisons</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][3][add]" id="a14" value="1">
                                                    <input type="hidden" name="data[3][Lien][3][lien]" value="livraisons">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][3][edit]" id="a15" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][3][delete]" id="a16" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][3][imprimer]" id="a17" value="1"></td>
                                            </tr>
                                            <tr class="factures">
                                                <td align="left">Factures</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][4][add]" id="a18" value="1">
                                                    <input type="hidden" name="data[3][Lien][4][lien]" value="factures">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][4][edit]" id="a19" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][4][delete]" id="a20" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][4][imprimer]" id="a21" value="1"></td>
                                            </tr>
                                            <tr class="reglements">
                                                <td align="left">Reglements</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[3][Lien][5][add]" id="a25" value="1">
                                                    <input type="hidden" name="data[3][Lien][5][lien]" value="reglements">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][5][edit]" id="a22" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][5][delete]" id="a23" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[3][Lien][5][imprimer]" id="a24" value="1"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- <div class="tab-pane fade in param" id="prévisionnement">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="pr" ligne="1" ind="150" class="cocheru">Tout Cocher</a>/
                                        <a index="pr" ligne="1" ind="150" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="pr1" value="12"></td>
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
                                                <td align="center"><input type="checkbox" name="data[12][Lien][0][imprimer]" id="pr5" value="1"></td>
                                            </tr>

                                            <tr class="previsionachats">
                                                <td align="left">Productions</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[12][Lien][1][lien]" value="previsionachats">
                                                </td>
                                                <td align="center"></td>
                                                <td align="center"></td>
                                                <td align="center"><input type="checkbox" name="data[12][Lien][1][imprimer]" id="pr9" value="1"></td>
                                            </tr>
                                            <tr class="previsionachatsv">
                                                <td align="left">Vente N-1</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[12][Lien][2][add]" id="pr10" value="1">
                                                    <input type="hidden" name="data[12][Lien][2][lien]" value="previsionachatsv">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[12][Lien][2][edit]" id="pr11" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[12][Lien][2][delete]" id="pr12" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[12][Lien][2][imprimer]" id="pr13" value="1"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> -->


                                <div class="tab-pane fade in param" id="clients">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="cli" ligne="1" ind="59" class="cocheru">Tout Cocher</a>/
                                        <a index="cli" ligne="1" ind="59" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="cli1" value="9"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                                <td align="center">Fiche article</td>
                                            </tr>
                                            <tr class="clients">
                                                <td align="left">Clients</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[9][Lien][0][add]" id="cli2" value="1">
                                                    <input type="hidden" name="data[9][Lien][0][lien]" value="clients">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[9][Lien][0][edit]" id="cli3" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[9][Lien][0][delete]" id="cli4" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[9][Lien][0][imprimer]" id="cli5" value="1"></td>
                                            </tr>
                                            <tr class="releveclients">
                                                <td align="left">Relevé clients </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[9][Lien][1][add]" id="cli6" value="1">
                                                    <input type="hidden" name="data[9][Lien][1][lien]" value="releveclients">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[9][Lien][1][edit]" id="cli7" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[9][Lien][1][delete]" id="cli8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[9][Lien][1][imprimer]" id="cli9" value="1"></td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
























                                <div class="tab-pane fade in param" id="articles">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="art" ligne="1" ind="59" class="cocheru">Tout Cocher</a>/
                                        <a index="art" ligne="1" ind="59" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="art1" value="8"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>

                                            </tr>
                                            <tr class="unitecontenance">
                                                <td align="left">Unités </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[8][Lien][0][add]" id="art2" value="1">
                                                    <input type="hidden" name="data[8][Lien][0][lien]" value="unitecontenance">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][0][edit]" id="art3" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][0][delete]" id="art4" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][0][imprimer]" id="art5" value="1"></td>
                                            </tr>



                                            <tr class="factures" hidden>
                                                <td align="left">Unites article </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[8][Lien][1][add]" id="art6" value="1">
                                                    <input type="hidden" name="data[8][Lien][1][lien]" value="unitearticle">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][1][edit]" id="art7" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][1][delete]" id="art8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][1][imprimer]" id="art9" value="1"></td>
                                            </tr>


                                            <tr class="famille">
                                                <td align="left">Familles</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[8][Lien][2][add]" id="art10" value="1">
                                                    <input type="hidden" name="data[8][Lien][2][lien]" value="famille">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][2][edit]" id="art11" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][2][delete]" id="art12" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][2][imprimer]" id="art13" value="1"></td>
                                            </tr>


                                            <tr class="sousfamille">
                                                <td align="left">Sous famille</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[8][Lien][7][add]" id="art30" value="1">
                                                    <input type="hidden" name="data[8][Lien][7][lien]" value="sousfamille">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][7][edit]" id="art31" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][7][delete]" id="art32" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][7][imprimer]" id="art33" value="1"></td>

                                            </tr>
                                            <tr class="article">
                                                <td align="left">Articles</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[8][Lien][6][add]" id="art26" value="1">
                                                    <input type="hidden" name="data[8][Lien][6][lien]" value="article">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][6][edit]" id="art27" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][6][delete]" id="art28" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][6][imprimer]" id="art29" value="1"></td>
                                                <td align="center"></td>


                                            </tr>
                                            <tr class="changementprix">
                                                <td align="left">Changement de prix</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[8][Lien][8][add]" id="art35" value="1">
                                                    <input type="hidden" name="data[8][Lien][8][lien]" value="changementprix">
                                                </td>
                                                <!-- <td align="center"><input type="checkbox" name="data[8][Lien][8][edit]" id="art36" value="1"></td> -->
                                                <!-- <td align="center"><input type="checkbox" name="data[8][Lien][8][delete]" id="art37" value="1"></td> -->
                                                <!-- <td align="center"><input type="checkbox" name="data[8][Lien][8][imprimer]" id="art38" value="1"></td> -->

                                            </tr>
                                            <tr class="historiquearticles">
                                                <td align="left">Etat historique article</td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" name="data[8][Lien][9][add]" id="art39" value="1"> -->
                                                    <input type="hidden" name="data[8][Lien][9][lien]" value="historiquearticles">
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" name="data[8][Lien][9][edit]" id="art40" value="1"> -->
                                                </td>
                                                <td align="center">
                                                    <!-- <input type="checkbox" name="data[8][Lien][9][delete]" id="art41" value="1"> -->
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[8][Lien][9][imprimer]" id="art42" value="1"></td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                                <div hidden class="tab-pane fade in caisses" id="caisses">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="cai" ligne="1" ind="59" class="cocheru">Tout Cocher</a>/
                                        <a index="cai" ligne="1" ind="59" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="cai1" value="10"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>
                                            <tr class="etatdecaisses">
                                                <td align="left">Etat de caisses</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[10][Lien][0][add]" id="cai2" value="1">
                                                    <input type="hidden" name="data[10][Lien][0][lien]" value="etatdecaisses">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[10][Lien][0][edit]" id="cai3" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[10][Lien][0][delete]" id="cai4" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[10][Lien][0][imprimer]" id="cai5" value="1"></td>
                                            </tr>
                                            <tr class="transferts">
                                                <td align="left">Transfert entre les caisses </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[10][Lien][1][add]" id="cai6" value="1">
                                                    <input type="hidden" name="data[10][Lien][1][lien]" value="transferts">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[10][Lien][1][edit]" id="cai7" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[10][Lien][1][delete]" id="cai8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[10][Lien][1][imprimer]" id="cai9" value="1"></td>

                                            </tr>
                                            <tr class="depenses">
                                                <td align="left">Dépenses </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[10][Lien][2][add]" id="cai10" value="1">
                                                    <input type="hidden" name="data[10][Lien][2][lien]" value="depenses">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[10][Lien][2][edit]" id="cai11" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[10][Lien][2][delete]" id="cai12" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[10][Lien][2][imprimer]" id="cai13" value="1"></td>

                                            </tr>



                                        </tbody>
                                    </table>
                                </div>



                                <div class="tab-pane fade in param" id="commercials">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="commercial" ligne="1" ind="59" class="cocheru">Tout Cocher</a>/
                                        <a index="commercial" ligne="1" ind="59" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="commercial1" value="11"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                                <td align="center">Validation</td>
                                            </tr>
                                            <tr class="commercial">
                                                <td align="left">Commercial</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[11][Lien][0][add]" id="commercial2" value="1">
                                                    <input type="hidden" name="data[11][Lien][0][lien]" value="commercials">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][0][edit]" id="commercial3" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][0][delete]" id="commercial4" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][0][imprimer]" id="commercial5" value="1"></td>
                                            </tr>
                                            <tr class="categories">
                                                <td align="left">Categories </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[11][Lien][1][add]" id="commercial6" value="1">
                                                    <input type="hidden" name="data[11][Lien][1][lien]" value="categories">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][1][edit]" id="commercial7" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][1][delete]" id="commercial8" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][1][imprimer]" id="commercial9" value="1"></td>

                                            </tr>
                                            <!-- <tr class="bonusmalus">
                                                <td align="left">Bonus/Malus </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[11][Lien][2][add]" id="commercial10" value="1">
                                                    <input type="hidden" name="data[11][Lien][2][lien]" value="bonusmalus">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][2][edit]" id="commercial11" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][2][delete]" id="commercial12" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][2][imprimer]" id="commercial13" value="1"></td>

                                            </tr>
                                            <tr class="reglementcommercial">
                                                <td align="left">Reglement commercial </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[11][Lien][3][add]" id="commercial14" value="1">
                                                    <input type="hidden" name="data[11][Lien][3][lien]" value="reglementcommercial">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][3][edit]" id="commercial15" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][3][delete]" id="commercial16" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][3][imprimer]" id="commercial17" value="1"></td>

                                            </tr>

                                            <tr class="relevecommercial">
                                                <td align="left">Relev� commercial </td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[11][Lien][4][add]" id="commercial18" value="1">
                                                    <input type="hidden" name="data[11][Lien][4][lien]" value="relevecommercial">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][4][edit]" id="commercial19" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][4][delete]" id="commercial20" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[11][Lien][4][imprimer]" id="commercial21" value="1"></td>

                                            </tr> -->



                                        </tbody>
                                    </table>
                                </div>


                                <div class="tab-pane fade in finance" id="finance">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="f" ligne="1" ind="60" class="cocheru">Tout Cocher</a>/
                                        <a index="f" ligne="1" ind="60" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="f1" value="5"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                            </tr>
                                            <tr class="engagementfournisseur">
                                                <td align="left">Etat de paiement Fournisseur</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[5][Lien][13][add]" id="f36" value="1">
                                                    <input type="hidden" name="data[5][Lien][13][lien]" value="engagementfournisseur">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[5][Lien][13][edit]" id="f37" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[5][Lien][13][delete]" id="f34" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[5][Lien][13][imprimer]" id="f39" value="1"></td>
                                            </tr>
                                            <tr class="listecheque">
                                                <td align="left">Liste chéque</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[5][Lien][14][add]" id="f40" value="1">
                                                    <input type="hidden" name="data[5][Lien][14][lien]" value="listecheque">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[5][Lien][14][edit]" id="f41" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[5][Lien][14][delete]" id="f42" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[5][Lien][14][imprimer]" id="f43" value="1"></td>
                                            </tr>
                                            <tr class="listetraite">
                                                <td align="left">Liste traite</td>
                                                <td align="center">
                                                    <input type="checkbox" name="data[5][Lien][15][add]" id="f44" value="1">
                                                    <input type="hidden" name="data[5][Lien][15][lien]" value="listetraite">
                                                </td>
                                                <td align="center"><input type="checkbox" name="data[5][Lien][15][edit]" id="f45" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[5][Lien][15][delete]" id="f46" value="1"></td>
                                                <td align="center"><input type="checkbox" name="data[5][Lien][15][imprimer]" id="f47" value="1"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade in statistiques" id="statistiques">
                                    <table cellpadding="4" cellspacing="1" class="table" width="100%" style="background-color: 	#f8f8ff ;">
                                        <a index="st" ligne="1" ind="61" class="cocheru">Tout Cocher</a>/
                                        <a index="st" ligne="1" ind="61" class="decocheru">Tout Decocher</a>
                                        <tbody>
                                            <tr>
                                                <td align="center">Autorisation <input type="checkbox" name="acces[]" id="st1" value="6"></td>
                                                <td align="center">Ajout</td>
                                                <td align="center">Modification</td>
                                                <td align="center">Suppression</td>
                                                <td align="center">Impression</td>
                                            </tr>
                                            <tr class="listeoffres">
                                                <td align="left">Liste Offres de prix Vente</td>
                                                <td align="center">
                                                    <input type="hidden" name="data[6][Lien][13][lien]" value="listeoffres">
                                                </td>
                                                <td align="center"></td>
                                                <td align="center"></td>
                                                <td align="center"><input type="checkbox" name="data[6][Lien][13][imprimer]" id="st39" value="1"></td>
                                            </tr>
                                            <tr class="listecommandes">
                                                <td align="left">Liste Commandes Vente</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][14][lien]" value="listecommandes">
                                                </td>
                                                <td align="center"></td>
                                                <td align="center"></td>
                                                <td align="center"><input type="checkbox" name="data[6][Lien][14][imprimer]" id="st43" value="1"></td>
                                            </tr>
                                            <tr class="listefactures">
                                                <td align="left">Liste Factures Vente</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][15][lien]" value="listefactures">
                                                </td>
                                                <td align="center"></td>
                                                <td align="center"></td>
                                                <td align="center"><input type="checkbox" name="data[6][Lien][15][imprimer]" id="st47" value="1"></td>
                                            </tr>

                                            <tr class="listebl">
                                                <td align="left">Liste Bons de livraisons Vente</td>
                                                <td align="center">

                                                    <input type="hidden" name="data[6][Lien][16][lien]" value="listebl">
                                                </td>
                                                <td align="center"></td>
                                                <td align="center"></td>
                                                <td align="center"><input type="checkbox" name="data[6][Lien][16][imprimer]" id="st51" value="1"></td>
                                            </tr>


                                            <tr class="listecommandesachat" >
                                                <td align="left">Liste Commandes achat</td>
                                                <td align="center">
                                                    <input type="hidden" name="data[6][Lien][17][lien]" value="listecommandesachat">
                                                </td>
                                                <td align="center"></td>
                                                <td align="center"></td>
                                                <td align="center"><input type="checkbox" name="data[6][Lien][17][imprimer]" id="st55" value="1"></td>
                                            </tr>

                                            <tr class="listeblachat">
                                                <td align="left">Liste Bons de livraisons Achat</td>
                                                <td align="center">
                                              
                                                    <input type="hidden" name="data[6][Lien][18][lien]" value="listeblachat">
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td align="center"><input type="checkbox" name="data[6][Lien][18][imprimer]" id="st56" value="1"></td>
                                            </tr>
                                            <tr class="listefacturesachat">
                                                <td align="left">Liste Factures Achat</td>
                                                <td align="center">
                                                    
                                                    <input type="hidden" name="data[6][Lien][19][lien]" value="listefacturesachat">
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td align="center"><input type="checkbox" name="data[6][Lien][19][imprimer]" id="st57" value="1"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="pull-right btn btn-success btn-sm" id="uti" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        <?php echo $this->Form->end(); ?>
                    </nav>
                </div>

            </div>

        </div>
        <!-- /.box -->
    </div>
    </div>
</section>
<script>
    $(function() {
        $('.cocheru').on('click', function() {
            index = $(this).attr('index');
            ligne = $(this).attr('ligne');
            ligne = $(this).attr('ligne');
            // alert(ligne);
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