<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Factureavoirfr Entity
 *
 * @property int $id
 * @property string|null $model
 * @property int|null $fournisseur_id
 * @property int|null $importation_id
 * @property int|null $utilisateur_id
 * @property string|null $timbre_id
 * @property string|null $tauxtva
 * @property string|null $tauxfodec
 * @property int|null $facture_id
 * @property int|null $bonreceptionstock_id
 * @property \Cake\I18n\FrozenDate|null $date
 * @property string|null $remise
 * @property int|null $tva_id
 * @property string|null $fodec
 * @property string|null $totalht
 * @property string|null $totalttc
 * @property string|null $fret
 * @property string|null $avoir
 * @property string|null $mdinitial
 * @property string|null $montantdevise
 * @property string|null $numero
 * @property int|null $numeroconca
 * @property int|null $typefacture_id
 * @property int|null $etat
 * @property int|null $pointdevente_id
 * @property int|null $exercice_id
 * @property string|null $des
 * @property string|null $numeropieceintegre
 * @property string|null $numavoirfournisseur
 * @property float|null $taux
 * @property int|null $devise_id
 * @property int|null $type
 * @property int|null $totalht1
 * @property int|null $totaltva1
 * @property int|null $totalttc1
 * @property int|null $totalrem
 * @property int|null $adressecl
 * @property int|null $tva1
 * @property int|null $ttc1
 * @property int|null $fodec1
 * @property int|null $rem
 *
 * @property \App\Model\Entity\Utilisateur $utilisateur
 * @property \App\Model\Entity\Lignefactureavoirfr[] $lignefactureavoirfrs
 */
class Factureavoirfr extends Entity
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
        'model' => true,
        'fournisseur_id' => true,
        'importation_id' => true,
        'utilisateur_id' => true,
        'timbre_id' => true,
        'tauxtva' => true,
        'tauxfodec' => true,
        'facture_id' => true,
        'bonreceptionstock_id' => true,
        'date' => true,
        'remise' => true,
        //////'tva_id' => true,
        'fodec' => true,
        'totalht' => true,
        'totalttc' => true,
        'fret' => true,
        'avoir' => true,
        'mdinitial' => true,
        'montantdevise' => true,
        'numero' => true,
        'numeroconca' => true,
        'typefacture_id' => true,
        'etat' => true,
        'pointdevente_id' => true,
        'exercice_id' => true,
        'des' => true,
        'numeropieceintegre' => true,
        'numavoirfournisseur' => true,
        'taux' => true,
        'devise_id' => true,
        'type' => true,
        'totalht1' => true,
        'totaltva1' => true,
        'totalttc1' => true,
        'totalrem' => true,
        'adressecl' => true,
        'tva1' => true,
        'ttc1' => true,
        'fodec1' => true,
        'rem' => true,
        'utilisateur' => true,
        'lignefactureavoirfrs' => true,
        'Montant_Regler' => true,
    ];
}
