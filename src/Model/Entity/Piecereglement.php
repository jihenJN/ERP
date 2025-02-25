<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Piecereglement Entity
 *
 * @property int $id
 * @property int|null $paiement_id
 * @property int|null $reglement_id
 * @property string|null $montant
 * @property string|null $intericecredit
 * @property \Cake\I18n\FrozenDate|null $date
 * @property int|null $carnetcheque_id
 * @property int|null $cheque_id
 * @property string|null $num
 * @property \Cake\I18n\FrozenDate|null $echance
 * @property int|null $compte_id
 * @property string|null $montant_brut
 * @property string|null $montant_net
 * @property int|null $to_id
 * @property int|null $societe_id
 * @property string|null $situation
 * @property string|null $numeroachat
 * @property int $importation_id
 * @property string|null $montantdevise
 * @property string|null $nbrmoins
 * @property int|null $etatpiecereglement_id
 * @property int|null $traitecredit_id
 * @property int|null $reglefournisseur
 * @property int|null $credit
 * @property string|null $montantfrs
 * @property int|null $impaye_regler
 * @property string|null $numeropieceintegre
 * @property int $fournisseur_id
 * @property float|null $RG_Cours
 * @property float|null $RG_MontantDev
 * @property string|null $prop
 *
 * @property \App\Model\Entity\Paiement $paiement
 * @property \App\Model\Entity\Reglement $reglement
 * @property \App\Model\Entity\Carnetcheque $carnetcheque
 * @property \App\Model\Entity\Cheque $cheque
 * @property \App\Model\Entity\Compte $compte
 * @property \App\Model\Entity\To $to
 * @property \App\Model\Entity\Societe $societe
 * @property \App\Model\Entity\Importation $importation
 * @property \App\Model\Entity\Etatpiecereglement $etatpiecereglement
 * @property \App\Model\Entity\Traitecredit $traitecredit
 * @property \App\Model\Entity\Fournisseur $fournisseur
 * @property \App\Model\Entity\Lignereglement[] $lignereglements
 */
class Piecereglement extends Entity
{
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
        'paiement_id' => true,
        'reglement_id' => true,
        'montant' => true,
        'intericecredit' => true,
        'date' => true,

        'carnetcheque_id' => true,
        'cheque_id' => true,
        'banque_id' => true,
        'compte_id' => true,

        'num' => true,
        'echance' => true,
        'montant_brut' => true,
        'montant_net' => true,
        'to_id' => true,
        'societe_id' => true,
        'situation' => true,
        'numeroachat' => true,
        'importation_id' => true,
        'montantdevise' => true,
        'nbrmoins' => true,
        'etatpiecereglement_id' => true,
        'traitecredit_id' => true,
        'reglefournisseur' => true,
        'credit' => true,
        'montantfrs' => true,
        'impaye_regler' => true,
        'numeropieceintegre' => true,
        'fournisseur_id' => true,
        'RG_Cours' => true,
        'RG_MontantDev' => true,
        'prop' => true,
        'paiement' => true,
        'reglement' => true,
        'carnetcheque' => true,
        'cheque' => true,
        'compte' => true,
        'to' => true,
        'societe' => true,
        'importation' => true,
        'etatpiecereglement' => true,
        'traitecredit' => true,
        'fournisseur' => true,
        'lignereglements' => true,
        'caisse_id' => true,
        'piecejointe' => true,

        'etat_id' => true,


    ];
}
