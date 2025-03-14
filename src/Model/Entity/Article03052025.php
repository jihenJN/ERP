<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property float|null $Code_Socit
 * @property string|null $Code
 * @property string|null $Dsignation
 * @property string|null $Description
 * @property float|null $famille_id
 * @property int|null $sousfamille1_id
 * @property float|null $tva_id
 * @property float|null $Quantit_Minimale
 * @property float|null $Quantit_Maximale
 * @property float|null $Quantit_Opt_Commande
 * @property float|null $Prix_Moyen_Pondr
 * @property float|null $Quantit_Command
 * @property float|null $Quantit_Reserv
 * @property float|null $Quantit_Disponible
 * @property float|null $Quantit_Inventaire
 * @property string|null $Date_Inventaire
 * @property float|null $Quantit_LastInput
 * @property float|null $Prix_LastInput
 * @property string|null $Date_LastInput
 * @property float|null $Stockage
 * @property string|null $artM
 * @property float|null $PrixGamme
 * @property string|null $AtGamme
 * @property float|null $PrixNom
 * @property float|null $QTR
 * @property float|null $QTRSRT
 * @property float|null $PXNOM2008
 * @property float|null $PXGAMME2008
 * @property float|null $QT2
 * @property float|null $QTLN
 * @property float|null $QTLR
 * @property float|null $NBPC
 * @property float|null $MD1
 * @property float|null $MD2
 * @property float|null $MD3
 * @property float|null $MD4
 * @property float|null $MD5
 * @property float|null $MD6
 * @property float|null $MD7
 * @property float|null $MD8
 * @property float|null $MD9
 * @property float|null $MD10
 * @property float|null $MD11
 * @property float|null $MD12
 * @property float|null $MA1
 * @property float|null $MA2
 * @property float|null $MA3
 * @property float|null $MA4
 * @property float|null $MA5
 * @property float|null $MA6
 * @property float|null $MA7
 * @property float|null $MA8
 * @property float|null $MA9
 * @property float|null $MA10
 * @property float|null $MA11
 * @property float|null $MA12
 * @property float|null $QT1
 * @property float|null $QT2M
 * @property float|null $QT3
 * @property float|null $QT4
 * @property float|null $QT5
 * @property float|null $QT6
 * @property float|null $QT7
 * @property float|null $QT8
 * @property float|null $QT9
 * @property float|null $QT10
 * @property float|null $QT11
 * @property float|null $QT12
 * @property string|null $cptt
 * @property float|null $Poid
 * @property float|null $Unite
 * @property string|null $Barre
 * @property float|null $PHT
 * @property float|null $Poids
 * @property float|null $LG
 * @property float|null $LR
 * @property float|null $LZ
 * @property float|null $GRM
 * @property string|null $TPP
 * @property string|null $FRM
 * @property string|null $CodeM
 * @property string|null $ST
 * @property float|null $QTMAG
 * @property float|null $PTTC
 * @property string|null $Quantit_Disponible02
 * @property string|null $Quantit_Disponible03
 * @property float|null $CodeEcolef
 * @property float|null $PRIXEcolef
 * @property float|null $POIDSECOLEF
 * @property float|null $CodeTPE
 * @property float|null $TXTPE
 * @property float|null $CTGPOINT
 * @property string|null $UserAdd
 * @property string|null $DateAdd
 * @property string|null $UserUpdate
 * @property string|null $DateUpdate
 * @property float|null $QTDISP
 * @property float|null $QTMAGSV
 * @property float|null $QTINV
 * @property string|null $DTINV
 * @property string|null $PrixMP
 * @property string|null $PrixMO
 * @property string|null $PrixMA
 * @property string|null $PrixEN
 * @property string|null $TauxCharge
 * @property float|null $CoutRevient
 * @property string|null $image
 * @property int|null $etat
 *
 * @property \App\Model\Entity\Famille $famille
 * @property \App\Model\Entity\Sousfamille1 $sousfamille1
 * @property \App\Model\Entity\Tva $tva
 * @property \App\Model\Entity\Articlefournisseur[] $articlefournisseurs
 * @property \App\Model\Entity\Articleunite[] $articleunites
 * @property \App\Model\Entity\Bandeconsultation[] $bandeconsultations
 * @property \App\Model\Entity\Fourchette[] $fourchettes
 * @property \App\Model\Entity\Lignebandeconsultation[] $lignebandeconsultations
 * @property \App\Model\Entity\Lignebonchargement[] $lignebonchargements
 * @property \App\Model\Entity\Lignebondereservation[] $lignebondereservations
 * @property \App\Model\Entity\Lignebondetransfert[] $lignebondetransferts
 * @property \App\Model\Entity\Lignebonlivraison[] $lignebonlivraisons
 * @property \App\Model\Entity\Lignebonreceptionstock[] $lignebonreceptionstocks
 * @property \App\Model\Entity\Lignebonsortiestock[] $lignebonsortiestocks
 * @property \App\Model\Entity\Lignecommandeclient[] $lignecommandeclients
 * @property \App\Model\Entity\Lignecommande[] $lignecommandes
 * @property \App\Model\Entity\Lignedemandeoffredeprix[] $lignedemandeoffredeprixes
 * @property \App\Model\Entity\Lignefactureclient[] $lignefactureclients
 * @property \App\Model\Entity\Lignefacture[] $lignefactures
 * @property \App\Model\Entity\Ligneinventaire[] $ligneinventaires
 * @property \App\Model\Entity\Lignelivraison[] $lignelivraisons
 */
class Article extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'Code_Socit' => true,
        'Code' => true,

        'codeancienne' => true,
        'prixachat' => true,



        'Dsignation' => true,
        'Description' => true,
        'famille_id' => true,
        'sousfamille1_id' => true,
        'tva_id' => true,
        'Quantit_Minimale' => true,
        'Quantit_Maximale' => true,
        'Quantit_Opt_Commande' => true,
        'Prix_Moyen_Pondr' => true,
        'Quantit_Command' => true,
        'Quantit_Reserv' => true,
        'Quantit_Disponible' => true,
        'Quantit_Inventaire' => true,
        'Date_Inventaire' => true,
        'Quantit_LastInput' => true,
        'Prix_LastInput' => true,
        'Date_LastInput' => true,
        'Stockage' => true,
        'artM' => true,
        'PrixGamme' => true,
        'AtGamme' => true,
        'PrixNom' => true,
        'QTR' => true,
        'QTRSRT' => true,
        'PXNOM2008' => true,
        'PXGAMME2008' => true,
        'QT2' => true,
        'QTLN' => true,
        'QTLR' => true,
        'NBPC' => true,
        'MD1' => true,
        'MD2' => true,
        'MD3' => true,
        'MD4' => true,
        'MD5' => true,
        'MD6' => true,
        'MD7' => true,
        'MD8' => true,
        'MD9' => true,
        'MD10' => true,
        'MD11' => true,
        'MD12' => true,
        'MA1' => true,
        'MA2' => true,
        'MA3' => true,
        'MA4' => true,
        'MA5' => true,
        'MA6' => true,
        'MA7' => true,
        'MA8' => true,
        'MA9' => true,
        'MA10' => true,
        'MA11' => true,
        'MA12' => true,
        'QT1' => true,
        'QT2M' => true,
        'QT3' => true,
        'QT4' => true,
        'QT5' => true,
        'QT6' => true,
        'QT7' => true,
        'QT8' => true,
        'QT9' => true,
        'QT10' => true,
        'QT11' => true,
        'QT12' => true,
        'cptt' => true,
        'Poid' => true,
        'Unite' => true,
        'Barre' => true,
        'PHT' => true,
        'Poids' => true,
        'LG' => true,
        'LR' => true,
        'LZ' => true,
        'GRM' => true,
        'TPP' => true,
        'FRM' => true,
        'CodeM' => true,
        'ST' => true,
        'QTMAG' => true,
        'PTTC' => true,
        'Quantit_Disponible02' => true,
        'Quantit_Disponible03' => true,
        'CodeEcolef' => true,
        'PRIXEcolef' => true,
        'POIDSECOLEF' => true,
        'CodeTPE' => true,
        'TXTPE' => true,
        'CTGPOINT' => true,
        'UserAdd' => true,
        'DateAdd' => true,
        'UserUpdate' => true,
        'DateUpdate' => true,
        'QTDISP' => true,
        'QTMAGSV' => true,
        'QTINV' => true,
        'DTINV' => true,
        'PrixMP' => true,
        'PrixMO' => true,
        'PrixMA' => true,
        'PrixEN' => true,
        'TauxCharge' => true,
        'CoutRevient' => true,
        'image' => true,
        'etat' => true,
        'famille' => true,
        'sousfamille1' => true,
        'tva' => true,
        'articlefournisseurs' => true,
        'articleunites' => true,
        'bandeconsultations' => true,
        'fourchettes' => true,
        'lignebandeconsultations' => true,
        'lignebonchargements' => true,
        'lignebondereservations' => true,
        'lignebondetransferts' => true,
        'lignebonlivraisons' => true,
        'lignebonreceptionstocks' => true,
        'lignebonsortiestocks' => true,
        'lignecommandeclients' => true,
        'lignecommandes' => true,
        'lignedemandeoffredeprixes' => true,
        'lignefactureclients' => true,
        'lignefactures' => true,
        'ligneinventaires' => true,
        'lignelivraisons' => true,
        'fodec' => true,
        'remise' => true,
        'nombrepiece' => true,
        'poidsbrut' => true,
        'prixttc' => true,
        'unite_id' => true,
        'contenance' => true,
        'nbpiecepalette' => true,
        'sousfamille2_id' => true,
        'codeabarre' => true,
        'unitearticle_id' => true,
        'famillerotation_id' => true,
        'nbjour' => true,
        'coefficient' => true,
        'nbpoint' => true,
        'vente' => true,
        'densite' => true,
        'devise_id' => true,
        'mobile' => true,
        'inserted' => true,
        'updated' => true,
        'refBureauEtude' => true,
        'ml' => true,
        'marque_id' => true,
        'marque' => true,
        'article_id' => true,
        'typearticle_id' => true,

        
        
    ];
    public $virtualFields = array(
        'nom' => 'CONCAT(Articles.Code, " ", Articles.Dsignation)');

}
