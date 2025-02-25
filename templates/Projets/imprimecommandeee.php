<?php

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

?>
<?php $this->layout = 'def'; ?>
<?php
use App\Model\Table\SignaturesTable;

$session = $this->request->getSession();

$authData = $session->read('Auth');
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$domainName = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

$baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

$wr = $protocol . $domainName.$baseSegment;
if ($authData && is_object($authData)) {
    $personnelId = $authData->personnel_id;
    $signaturesTable = new SignaturesTable();
    $userSignature = $signaturesTable->find()
        ->where(['personnel_id' => $personnelId])
        ->first();

}
?>
<script>
    function openWindow(h, w, url) {
        leftOffset = screen.width / 2 - w / 2;
        topOffset = screen.height / 2 - h / 2;
        window.open(
            url,
            this.target,
            "left=" +
            leftOffset +
            ",top=" +
            topOffset +
            ",width=" +
            w +
            ",height=" +
            h +
            ",resizable,scrollbars=yes"
        );
    }
</script>
<br>

<style>
    .glow-on-hover {
        width: 220px;
        height: 50px;
        border: none;
        outline: none;
        color: #fff;
        background: #111;
        cursor: pointer;
        position: relative;
        z-index: 0;
        border-radius: 10px;
    }

    .glow-on-hover:before {
        content: '';
        background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
        position: absolute;
        top: -2px;
        left: -2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowing 20s linear infinite;
        opacity: 0;
        transition: opacity .3s ease-in-out;
        border-radius: 10px;
    }

    .glow-on-hover:active {
        color: #000
    }

    .glow-on-hover:active:after {
        background: transparent;
    }

    .glow-on-hover:hover:before {
        opacity: 1;
    }

    .glow-on-hover:after {
        z-index: -1;
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: #55ebcb;
        left: 0;
        top: 0;
        border-radius: 10px;
    }

    @keyframes glowing {
        0% {
            background-position: 0 0;
        }

        50% {
            background-position: 400% 0;
        }

        100% {
            background-position: 0 0;
        }
    }


    #tabligne1 {
        border-collapse: collapse;
        width: 100%;
    }

    #tabligne1 th,
    #tabligne1 td {
        padding: 5px;
        text-align: center;
        border: 1px solid #ccc;
    }

    #tabligne1 th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .header {
        display: flex;
        margin-bottom: 20px;
    }

    .logo {
        margin-left: 6%;
    }

    .company-info {
        width: 75%;
        margin-left: 23%;
        font-size: 14px;
        line-height: 1.5;
    }

    .box {
        border: 1px solid #FFFFFF;
        padding: 5px;
    }

    h3 {
        color: red;
        font-family: monospace;
        text-align: center;
        margin-top: 40px;
    }

    .row {
        margin: 0 auto;
        margin-left: 20px;
        margin-right: 20px;
        position: static;
    }

    .col-xs-6 {
        width: 50%;
        float: left;
    }

    .field-container {
        border: 1px solid black;
        padding: 5px;
        margin-bottom: 10px;
    }

    .field-container .field-label {
        font-weight: bold;
    }

    .field-container .field-value {
        margin-top: 5px;
    }

    .field-value {
        border: 1px solid black;
        padding: 5px;
        min-height: 20px;
    }
</style>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 5px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    /* tr:nth-child(even) {
        background-color: #f2f2f2;
    } */
</style>
<style>
    .boxgris {
        position: relative;
        background: #E6E6E6;
        width: 50%;
        color: #000040;
    }

    .boxblanc {
        position: relative;
        border: 1px solid #B3B4B2;
        background: #ffffff;
        width: 50%;
        color: #000000;
    }

    .boxbordergray {
        position: relative;
        border: 1px solid #B3B4B2;
        /* Utilisation d'une teinte de gris plus claire */
        background: #FFFFFF;
        width: 99%;
        color: #000000;
    }


    .boxbordergris {
        position: relative;
        border: 1px solid #DADADA;
        background: #ffffff;
        width: 99%;
        color: #000000;
    }
</style>
<!-- <?php debug($facture->numero); ?> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="position: relative; top: -18px;">
    <!-- Bande noire continue -->
    <div style="background-color: black; height: 40px;"></div>

    <!-- Image au-dessus de la bande noire -->
    <div style="position: absolute; top: 10px; left: 10%; transform: translateX(-50%); z-index: 1;">
        <?php echo $this->Html->image('logoggb.png', ['alt' => 'CakePHP', 'height' => '125px', 'width' => '140px']); ?>
    </div>
    <div style="position: absolute; top: 10px; right: 10%; z-index: 1;">
        <a onclick='openWindow(1000, 1000, `<?php echo $wr; ?>/projets/downloadcommande/<?php echo @$id; ?>`)'>


            <button type="button" style="    font-size: 20px;"
                class="btn btn-xm btn-primary glow-on-hover">Imprimer</button></a>
    </div>
</div>
<div style="width: 87%;height: 20px;margin-left:10%;margin-right:5%;margin-top: 12px;">
    <div style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.5em; ">
        <strong>Commande fournisseur<?php echo $commandefournisseur->numero ?>
        </strong><br>
    </div>

    <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
        Date prévue de livraison :
        <?php $dateprev = $commandefournisseur->dateprev;
        if ($dateprev) {
            $date = $dateprev->format('Y-m-d');
            echo $date;
        } ?>
    </div>

    <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
        Code fournisseur :
        <?= h($commandefournisseur->fournisseur->code) ?>
    </div>
</div>
<br><br>
<br><br><br><br>
<div style="display:flex">
    <div style="width: 30%; margin-left:3%;font-size: 12px;">
        Émetteur:
    </div>
    <div style=" width: 60%; margin-left:13%;font-size: 12px;">
        Adressé à:
    </div>
</div>
<br>
<div style="display:flex">
    <div class="boxgris" style="width: 46%;height: 150px;margin-left:1%;margin-top:-0.5%;">
        <div style="background:#E6E6E6;margin-top:1%; margin-left:1%;font-size: 13px;">
            <br>
            <strong>
                <?= h($societes->nom) ?>
            </strong>
            <br>
            <?= h($societes->adresse) ?>
            <br><br>
            Tél.:
            <?= h($societes->tel) ?>
            <br>
            Email :
            <?= h($societes->mail) ?>
            <br>
            WEB :
            <?= h($societes->site) ?>
            <br>
        </div>
        <br>
    </div>
    <div class="boxblanc"
        style="width: 62%;height: 150px;margin-left:1%;margin-right:3%;font-size: 13px;margin-top:-0.5%;">
        <div style="margin-top:1%; margin-left:1%">
            <strong>
                <?= h($fournisseur->name) ?>
            </strong>
            <br>
            <?= h($fournisseur->adresse) ?>
            <br>
            <?= h($fournisseur->port) ?>
            <br>
            <?= h($fournisseur->Code_VilleL) ?>
            <?php if($fournisseur->tel){ ?>
                Téléphone:
                <?= h($fournisseur->tel) ?><?php } ?>
                <br><?php if($fournisseur->fax){ ?>
                Fax :
                <?= h($fournisseur->fax) ?><?php } ?>
                <br><?php if($fournisseur->mail){ ?>
                Email :
                <?= h($fournisseur->mail) ?><?php } ?>
        </div>
    </div>
</div>
<div class="boxbordergris" style="width: 96%; height: 20px; margin-left: 1%; margin-right: 5%;margin-top: 10px;">
    <div style="font-size: 12px;">
        Incoterm :
        <span style="color: red; font-weight: bold;">
            <?= h($commandefournisseur->incoterm->code); ?>
            <?php if ($commandefournisseur->fournisseur->port != '') {

                ?>-
            <?php }
            h($commandefournisseur->fournisseur->port); ?>
            <?php if ($commandefournisseur['pay'] != '') {
                #
                ?>- <?php }
            echo $commandefournisseur['pay'] ?>
        </span>
    </div>
</div>
<!-- <?php debug($commandeclient->devise->name); ?> -->
<div style="width: 87%;height: 20px;margin-left:1%;margin-right:5%;font-size: 12px;margin-top: 7px;">
    Montants exprimés en
    <?php $devise = $commandefournisseur->devise_id;
    if ($devise) {
        $Devise = $commandefournisseur->devise->name; ?>
        <?= h($Devise) ?>
    <?php } ?>
</div>

<div class="box" style="width: 96%;height :600px; margin-left:0%;margin-right:5%;margin-top: -8px;">
    <div class="panel-body">
        <div class="table-responsive ls-table">
            <table height="430px" style="width: 100%;">
                <thead>
                    <tr height="7px">
                        <td align="center" class="solid-border" style="width: 10%;border:1px solid gray;">
                            Référence
                        </td>
                        <td align="center" class="solid-border" style="width: 40%;border:1px solid gray;">
                            Désignation
                        </td>
                        <td align="center" class="solid-border" style="width: 10%;border:1px solid gray;">
                            P.U.H.T
                        </td>
                        <td align="center" class="solid-border" style="width: 9%;border:1px solid gray;">
                            Qté
                        </td>
                        <td align="center" class="solid-border" style="width: 5%;border:1px solid gray;">
                            Unité
                        </td>
                        <td align="center" class="solid-border" style="width: 10%;border:1px solid gray;">
                            Total HT
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                     $virg=3;
                     if ($commandefournisseur->nbfergule) {
                         $virg=$commandefournisseur->nbfergule;
                     }
                    foreach ($lignecommandefournisseurs as $lignecommande):
                        $qte = $lignecommande->qte;
                        $prix = $lignecommande->prix;
                        $montant = $qte * $prix;
                        // debug($lignecommande);
                        ?>
                        <tr class="tr">
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;height: 1px;">
                                <?php echo h($lignecommande->article->Refggb); ?>
                            </td>
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;">
                                <?php
                                if (isset($lignecommande->article)) {
                                    echo h($lignecommande->article->Dsignation . ' ' . $lignecommande->article->Description);
                                }
                                // debug($lignecommande->article->Dsignation);
                                ?>
                            </td>

                            <?php if ($Devise === 'Dollars US'): ?>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                    style="vertical-align:top;">
                                    <?= $this->Number->format($lignecommande->prix) ?> $
                                </td>
                            <?php elseif ($Devise === 'Euro'): ?>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                    style="vertical-align:top;">
                                    <?= $this->Number->format($lignecommande->prix) ?> €
                                </td>
                            <?php else: ?>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                    style="vertical-align:top;">
                                    <?= $this->Number->format($lignecommande->prix) ?>
                                </td>
                            <?php endif; ?>
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;">
                                <div style="margin-left: 25% ;">
                                    <?= $this->Number->format($lignecommande->qte);
                                    // debug($lignecommande->qte); ?>
                                </div>
                            </td>
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;">
                                <?php $connection = ConnectionManager::get('default');
                                if ($lignecommande->article_id) {
                                    $art = $connection->execute("SELECT unite_id FROM articles WHERE id = '" . $lignecommande->article_id . "'")->fetchAll('assoc');

                                }
                                $unite_id = $art[0]['unite_id'];
                                // debug($art);
                                $name = '';
                                if ($unite_id) {
                                    $unite = $connection->execute("SELECT name FROM unites where id=" . $unite_id . "; ")->fetch('assoc');
                                    $name = $unite['name'];
                                }

                                // debug($unite);
                                echo $name;
                                ?>
                            </td>
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;">
                                <?php if ($Devise === 'Dollars US'): ?>
                                    <?php echo sprintf("%01.".$virg."f", str_replace(",", ".", $montant)) ?> $
                                <?php elseif ($Devise === 'Euro'): ?>
                                    <?php echo sprintf("%01.".$virg."f", str_replace(",", ".", $montant)) ?> €
                                <?php else: ?>
                                    <?php echo sprintf("%01.".$virg."f", str_replace(",", ".", $montant)) ?>
                                <?php endif; ?>
                            </td>
                            <?php
                            $total = $total + $montant;
                            // debug($total);
                            ?>

                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border:1px solid gray;vertical-align:top;"></td>
                        <td style="border:1px solid gray;vertical-align:top;"></td>
                        <td style="border:1px solid gray;vertical-align:top;"></td>
                        <td style="border:1px solid gray;vertical-align:top;"></td>
                        <td style="border:1px solid gray;vertical-align:top;"></td>
                        <td style="border:1px solid gray;vertical-align:top;"></td>
                    </tr>
                </tbody>
            </table>


            <div style="display: flex; justify-content: space-between;margin-top: -14px;margin-left: -1.5%;">
                <div style="width: 65%;">
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 12px;">
                        <strong>Arrêter la présente commande à la somme de :</strong>
                    </div>

                    <div class="boxbordergray"
                        style="height: 30px; margin-left: 3%; margin-right: 5%;font-size: 12px;margin-top: 5px;">
                        <div style="margin-left: 3%;"> <?php debug($total);
                       

                        function ucfirst_minuscule($phrase)
                        {
                            // Supprimer les espaces inutiles avant et après la chaîne
                            $phrase = trim($phrase);

                            // Met tout en minuscules (gestion UTF-8)
                            $phrase = mb_strtolower($phrase, 'UTF-8');

                            // Met le premier caractère en majuscule (gestion UTF-8)
                            $phrase = mb_ucfirst($phrase);

                            return $phrase;
                        }

                        // Fonction personnalisée pour ucfirst avec gestion UTF-8
                        function mb_ucfirst($string, $encoding = 'UTF-8')
                        {
                            if (empty($string)) {
                                return $string; // Si la chaîne est vide, on la retourne directement
                            }

                            // Extraire le premier caractère et le reste de la chaîne
                            $firstChar = mb_substr($string, 0, 1, $encoding);
                            $rest = mb_substr($string, 1, null, $encoding);

                            // Retourner le premier caractère en majuscule + le reste de la chaîne
                            return mb_strtoupper($firstChar, $encoding) . $rest;
                        }

                        if ($Devise === 'Dollars US'):
                            echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $total)), 2, ''));
                        elseif ($Devise === 'Euro'):
                            echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $total)), 3, ''));

                        else:
                            echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $total)), 1, ''));

                        endif;

                        //echo ucfirst(int2str($total)); ?></div>
                    </div>
                    <br>
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;margin-top: -6px;">
                        <strong style="display: inline-block;">Conditions de règlement
                            :</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                        <p style="display: inline-block; margin-left: 10px;">30% Avance , 70% Contre Documents</p>
                    </div><br>
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;margin-top: -6px;">
                        <strong style="display: inline-block;">Mode de reglement :
                        </strong>&nbsp;&nbsp;&nbsp;&nbsp;
                        <p style="display: inline-block; margin-left: 10px;">Virement bancaire</p>
                    </div>
                </div>
                <div style="width: 60%;">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="margin-left: 60px;">
                            <strong>Total :
                                <?php echo $commandefournisseur->incoterm->code ?>
                                <?php if ($commandefournisseur->fournisseur->port != '') {

                                    ?>-
                                <?php }
                                echo $commandefournisseur->fournisseur->port ?>
                                <?php if ($commandefournisseur['pay'] != '') {
                                    #
                                    ?>- <?php }
                                echo $commandefournisseur['pay'] ?>
                            </strong>
                        </div>
                        <div>
                            <?php echo sprintf("%01.3f", str_replace(",", ".", $total)); ?>
                            <?php if ($commandefournisseur->devise_id) {
                                echo $commandefournisseur->devise->code;
                            } ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div style="margin-top: -30px;">
        <?php if ($userSignature): ?>
            <img src="<?= $this->Url->webroot('img/logosignature/' . $userSignature->filename); ?>" width="200px"
                height="80px" style="float: right; margin-top: -6px; margin-right: 20px;">
        <?php endif; ?>
    </div>
</div>
<div class="footerr-text">
    <?php echo $this->Html->image('footer.png', ['width' => '700', 'height' => '85']); ?>
</div>

<style>
    #border {
        border-left-width: 1px;
        border-right-width: 1px;
        border-top-width: 2px;
        border-bottom-width: 2px;
        border-left-style: solid;
        border-right-style: solid;
        border-top-style: dotted;
        border-bottom-style: dotted;
        border-color: gray;
    }

    #bordertop {
        border-left-width: 1px;
        border-right-width: 1px;
        border-top-width: 1px;
        border-bottom-width: 1px;
        border-left-style: solid;
        border-right-style: solid;
        border-top-style: solid;
        border-bottom-style: solid;
        border-color: gray;
    }
</style>
<style>
    .solid-border {
        border-width: 1px;
        border-style: solid;
        border-color: gray;
    }

    .dotted-border {
        border-left-width: 1px;
        border-right-width: 1px;
        border-top-width: 1px;
        border-bottom-width: 2px;
        border-left-style: solid;
        border-right-style: solid;
        border-top-style: dotted;
        border-bottom-style: dotted;
        border-color: gray;
    }
</style>

<style>
    .footerr-text {
        /*  position: fixed; */
        bottom: 10px;
        left: 35px;
        width: 30px;
        text-align: left;
    }
</style>
<style>
    /* CSS pour la bordure pointillée */
    table tr:nth-child(even) {
        border-bottom: 0.01px dotted black;
        /* Ligne pointillée entre chaque paire de lignes */
    }
</style>
<?php
function chifre_en_lettre11($montant, $devise1, $devise2)
{
 
 if(($devise1==1)) $dev1='Dinars';
 if(($devise1==2)) $dev1='Dollars';
 if(($devise1==3)) $dev1='Euro';
 if(($devise1==1)) $dev2='Millimes';
 if(($devise1==2)) $dev2='Centime';
 if(($devise1==3)) $dev2='Centimes';
 $parts = explode('.', $montant);
 $valeur_entiere = intval($parts[0]); // Integer part
 $valeur_decimal = intval($parts[1]); // Decimal part as an integer
//  $valeur_entiere=intval($montant);
//  $valeur_decimal=(($montant-intval($montant))*1000);
 //echo $parts[1];
 $dix_c=($valeur_decimal%100/10);
 $cent_c=intval($valeur_decimal%1000/100);
 $unite_c=$valeur_decimal%10;
 $unite[1]=$valeur_entiere%10;
 $dix[1]=intval($valeur_entiere%100/10);
 $cent[1]=intval($valeur_entiere%1000/100);
 $unite[2]=intval($valeur_entiere%10000/1000);
 $dix[2]=intval($valeur_entiere%100000/10000);
 $cent[2]=intval($valeur_entiere%1000000/100000);
 $unite[3]=intval($valeur_entiere%10000000/1000000);
 $dix[3]=intval($valeur_entiere%100000000/10000000);
 $cent[3]=intval($valeur_entiere%1000000000/100000000);

$dizaines = ['', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante',
     'Soixante', 'Soixante-dix', 'Quatre-vingts', 'Quatre-vingt-dix'];
 //echo $unite_c;
 $chif=array('', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf', 'Dix', 'Onze', 'Douze', 'Treize', 'Quatorze', 'Quinze', 'Seize', 'Dix-sept', 'Dix-huit', 'Dix-neuf');
 
 function convertir_centaines($nombre, $chif, $dizaines) {
    $centaine = intval($nombre / 100);
    $reste = $nombre % 100;
    $result = '';

    if ($centaine > 0) {
        $result .= ($centaine == 1 ? 'Cent' : $chif[$centaine] . ' Cents');
    }
    if ($reste > 0) {
        if ($reste < 20) {
            $result .= ' ' . $chif[$reste];
        } else {
            $dizaine = intval($reste / 10);
            $unite = $reste % 10;
            $result .= ' ' . $dizaines[$dizaine];
            if ($unite == 1 && $dizaine != 8) {
                $result .= ' et Un';
            } elseif ($unite > 1) {
                $result .= '-' . $chif[$unite];
            }
        }
    }
    return trim($result);
}

 $secon_c='';
  $trio_c='';
 for($i=1; $i<=3; $i++){
  $prim[$i]='';
  $secon[$i]='';
  $trio[$i]='';
  if($dix[$i]==0){
   $secon[$i]='';
   $prim[$i]=$chif[$unite[$i]];
  }
  else if($dix[$i]==1){
   $secon[$i]='';
   $prim[$i]=$chif[($unite[$i]+10)];
  }
  else if($dix[$i]==2){
   if($unite[$i]==1){
   $secon[$i]='Vingt et';
   $prim[$i]=$chif[$unite[$i]];
   }
   else {
   $secon[$i]='Vingt';
   $prim[$i]=$chif[$unite[$i]];
   }
  }
  else if($dix[$i]==3){
   if($unite[$i]==1){
   $secon[$i]='Trente et';
   $prim[$i]=$chif[$unite[$i]];
   }
   else {
   $secon[$i]='Trente';
   $prim[$i]=$chif[$unite[$i]];
   }
  }
  else if($dix[$i]==4){
   if($unite[$i]==1){
   $secon[$i]='Quarante et';
   $prim[$i]=$chif[$unite[$i]];
   }
   else {
   $secon[$i]='Quarante';
   $prim[$i]=$chif[$unite[$i]];
   }
  }
  else if($dix[$i]==5){
   if($unite[$i]==1){
   $secon[$i]='Cinquante et';
   $prim[$i]=$chif[$unite[$i]];
   }
   else {
   $secon[$i]='Cinquante';
   $prim[$i]=$chif[$unite[$i]];
   }
  }
  else if($dix[$i]==6){
   if($unite[$i]==1){
   $secon[$i]='Soixante et';
   $prim[$i]=$chif[$unite[$i]];
   }
   else {
   $secon[$i]='Soixante';
   $prim[$i]=$chif[$unite[$i]];
   }
  }
  else if($dix[$i]==7){
   if($unite[$i]==1){
   $secon[$i]='Soixante et';
   $prim[$i]=$chif[$unite[$i]+10];
   }
   else {
   $secon[$i]='Soixante';
   $prim[$i]=$chif[$unite[$i]+10];
   }
  }
  else if($dix[$i]==8){
   if($unite[$i]==1){
   $secon[$i]='Quatre-vingts et';
   $prim[$i]=$chif[$unite[$i]];
   }
   else {
   $secon[$i]='Quatre-vingts';
   $prim[$i]=$chif[$unite[$i]];
   }
  }
  else if($dix[$i]==9){
   if($unite[$i]==1){
   $secon[$i]='Quatre-vingts et';
   $prim[$i]=$chif[$unite[$i]+10];
   }
   else {
   $secon[$i]='Quatre-vingts';
   $prim[$i]=$chif[$unite[$i]+10];
   }
  }
  //echo $cent[$i];
  if($cent[$i]==1) $trio[$i]='Cent';
  else if(($cent[$i]!=0 || $cent[$i]!='')&& $chif[$cent[$i]]!=0 && $chif[$cent[$i]]!='') $trio[$i]=$chif[$cent[$i]] .' cents';
 }
 $v="";
$chif2=array('', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante-dix', 'Quatre-vingts', 'Quatre-vingt-dix');
 $secon_c=$chif2[$dix_c];
 if($cent_c==1) $trio_c='Cent';
 else if($cent_c!=0 || $cent_c!='') $trio_c=$chif[$cent_c] .' Cents';
 if(($cent[3]==0 || $cent[3]=='') && ($dix[3]==0 || $dix[3]=='') && ($unite[3]==1))
  $v=$v.' '. $trio[3]. '  ' .$secon[3]. ' ' . $prim[3]. ' Million ';
 else if(($cent[3]!=0 && $cent[3]!='') || ($dix[3]!=0 && $dix[3]!='') || ($unite[3]!=0 && $unite[3]!=''))
  $$v=$v.' '. $trio[3]. ' ' .$secon[3]. ' ' . $prim[3]. ' Millions ';
 else
  $v=$v.' '. $trio[3]. ' ' .$secon[3]. ' ' . $prim[3];
 if(($cent[2]==0 || $cent[2]=='') && ($dix[2]==0 || $dix[2]=='') && ($unite[2]==1))
  $v=$v.' '. ' Mille ';
 else if(($cent[2]!=0 && $cent[2]!='') || ($dix[2]!=0 && $dix[2]!='') || ($unite[2]!=0 && $unite[2]!=''))
  $v=$v.' '. $trio[2]. ' ' .$secon[2]. ' ' . $prim[2]. ' Milles ';
 else
  $v=$v.' '. $trio[2]. ' ' .$secon[2]. ' ' . $prim[2];
 $v=$v. $trio[1]. ' ' .$secon[1]. ' ' . $prim[1];
 $v=$v. ' '. $dev1 .' ' ;
 if(($cent_c=='0' || $cent_c=='') && ($dix_c=='0' || $dix_c==''))
 // $v=$v.' '. ' et z&eacute;ro '. $dev2;
  $v=$v.' ';
 else
 //echo $valeur_decimal;
 $v=$v.' et '.convertir_centaines($valeur_decimal, $chif, $dizaines) . ' ' . $dev2;
  //$v=$v.' et '.round( $valeur_decimal,0). ' ' . $dev2;
return $v;
}
function int2strr($a)
{
    $joakim = explode('.', $a);
    if (isset($joakim[1]) && $joakim[1] != '') {
        return int2str($joakim[0]) . ' virgule ' . int2str($joakim[1]);
    }
    if ($a == 0)
        return '';
    if ($a < 0)
        return 'moins ' . int2str(-$a);
    if ($a < 17) {
        switch ($a) {
            case 0:
                return 'zero';
            case 1:
                return 'un';
            case 2:
                return 'deux';
            case 3:
                return 'trois';
            case 4:
                return 'quatre';
            case 5:
                return 'cinq';
            case 6:
                return 'six';
            case 7:
                return 'sept';
            case 8:
                return 'huit';
            case 9:
                return 'neuf';
            case 10:
                return 'dix';
            case 11:
                return 'onze';
            case 12:
                return 'douze';
            case 13:
                return 'treize';
            case 14:
                return 'quatorze';
            case 15:
                return 'quinze';
            case 16:
                return 'seize';
        }
    } else if ($a < 20) {
        return 'dix-' . int2str($a - 10);
    } else if ($a < 100) {
        if ($a % 10 == 0) {
            switch ($a) {
                case 20:
                    return 'vingt';
                case 30:
                    return 'trente';
                case 40:
                    return 'quarante';
                case 50:
                    return 'cinquante';
                case 60:
                    return 'soixante';
                case 70:
                    return 'soixante-dix';
                case 80:
                    return 'quatre-vingt';
                case 90:
                    return 'quatre-vingt-dix';
            }
        } elseif (substr($a, -1) == 1) {
            if (((int) ($a / 10) * 10) < 70) {
                return int2str((int) ($a / 10) * 10) . '-et-un';
            } elseif ($a == 71) {
                return 'soixante-et-onze';
            } elseif ($a == 81) {
                return 'quatre-vingt-un';
            } elseif ($a == 91) {
                return 'quatre-vingt-onze';
            }
        } elseif ($a < 70) {
            return int2str($a - $a % 10) . '-' . int2str($a % 10);
        } elseif ($a < 80) {
            return int2str(60) . '-' . int2str($a % 20);
        } else {
            return int2str(80) . '-' . int2str($a % 20);
        }
    } else if ($a == 100) {
        return 'cent';
    } else if ($a < 200) {
        return int2str(100) . ' ' . int2str($a % 100);
    } else if ($a < 1000) {
        return int2str((int) ($a / 100)) . ' ' . int2str(100) . ' ' . int2str($a % 100);
    } else if ($a == 1000) {
        return 'mille';
    } else if ($a < 2000) {
        return int2str(1000) . ' ' . int2str($a % 1000) . ' ';
    } else if ($a < 1000000) {
        return int2str((int) ($a / 1000)) . ' ' . int2str(1000) . ' ' . int2str($a % 1000);
    }
}
?>
<?php
function int2str($a)
{
    $joakim = explode('.', $a);
    //debug($a);
    if (isset($joakim[1]) && $joakim[1] != '') {
        return int2str($joakim[0]) . ' virgule ' . int2str($joakim[1]);
    }
    if ($a == 0)
        return 'zéro';
    if ($a < 0)
        return 'moins ' . int2str(-$a);
    if ($a < 17) {
        switch ($a) {
            case 0:
                return 'zéro';
            case 1:
                return 'un';
            case 2:
                return 'deux';
            case 3:
                return 'trois';
            case 4:
                return 'quatre';
            case 5:
                return 'cinq';
            case 6:
                return 'six';
            case 7:
                return 'sept';
            case 8:
                return 'huit';
            case 9:
                return 'neuf';
            case 10:
                return 'dix';
            case 11:
                return 'onze';
            case 12:
                return 'douze';
            case 13:
                return 'treize';
            case 14:
                return 'quatorze';
            case 15:
                return 'quinze';
            case 16:
                return 'seize';
        }
    } else if ($a < 20) {
        return 'dix-' . int2str($a - 10);
    } else if ($a < 100) {
        if ($a % 10 == 0) {
            switch ($a) {
                case 20:
                    return 'vingt';
                case 30:
                    return 'trente';
                case 40:
                    return 'quarante';
                case 50:
                    return 'cinquante';
                case 60:
                    return 'soixante';
                case 70:
                    return 'soixante-dix';
                case 80:
                    return 'quatre-vingts';
                case 90:
                    return 'quatre-vingt-dix';
            }
        } elseif ($a % 10 == 1 && $a != 71 && $a != 81 && $a != 91) {
            return int2str($a - 1) . '-et-un';
        } elseif ($a < 70) {
            return int2str($a - $a % 10) . '-' . int2str($a % 10);
        } elseif ($a < 80) {
            return 'soixante-' . int2str($a % 20);
        } else {
            return 'quatre-vingt-' . int2str($a % 20);
        }
    } else if ($a < 200) {
        if ($a == 100) {
            return 'cent';
        } else {
            return 'cent ' . int2str($a % 100);
        }
    } else if ($a < 1000) {
        if ($a % 100 == 0) {
            return int2str($a / 100) . ' cents';
        } else {
            return int2str((int) ($a / 100)) . ' cent ' . int2str($a % 100);
        }
    } else if ($a < 2000) {
        if ($a == 1000) {
            return 'mille';
        } else {
            return 'mille ' . int2str($a % 1000);
        }
    } else if ($a < 1000000) {
        return int2str((int) ($a / 1000)) . ' mille ' . int2str($a % 1000);
    } else if ($a < 2000000) {
        return 'un million ' . int2str($a % 1000000);
    } else if ($a < 1000000000) {
        return int2str((int) ($a / 1000000)) . ' millions ' . int2str($a % 1000000);
    } else if ($a < 2000000000) {
        return 'un milliard ' . int2str($a % 1000000000);
    } else {
        return int2str((int) ($a / 1000000000)) . ' milliards ' . int2str($a % 1000000000);
    }
}

// Exemple d'utilisation

?>