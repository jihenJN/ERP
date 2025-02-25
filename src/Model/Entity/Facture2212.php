<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Facture Entity
 *
 * @property int $id
 * @property int|null $livraison_id
 * @property string|null $numero
 * @property \Cake\I18n\FrozenTime|null $date
 * @property int|null $fournisseur_id
 * @property int|null $pointdevente_id
 * @property int|null $depot_id
 * @property int|null $cartecarburant_id
 * @property int|null $materieltransport_id
 * @property int|null $chauffeur
 * @property int|null $convoyeur
 * @property int $valide
 * @property string|null $remise
 * @property string|null $tva
 * @property string|null $fodec
 * @property string|null $ttc
 * @property string|null $ht
 * @property int|null $adresselivraisonfournisseur_id
 * @property int|null $kilometragedepart
 * @property int|null $kilometragearrive
 *
 * @property \App\Model\Entity\Livraison[] $livraisons
 * @property \App\Model\Entity\Fournisseur $fournisseur
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Cartecarburant $cartecarburant
 * @property \App\Model\Entity\Materieltransport $materieltransport
 * @property \App\Model\Entity\Adresselivraisonfournisseur $adresselivraisonfournisseur
 * @property \App\Model\Entity\Lignefacture[] $lignefactures
 */
class Facture extends Entity
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
        // 'livraison_id' => true,
        'numero' => true,
        'date' => true,
        'fournisseur_id' => true,
        'pointdevente_id' => true,
        'depot_id' => true,
        'cartecarburant_id' => true,
        'materieltransport_id' => true,
        'chauffeur' => true,
        'convoyeur' => true,
        'valide' => true,
        'remise' => true,
        'tva' => true,
        'fodec' => true,
        'ttc' => true,
        'punht' => true,
        'adresselivraisonfournisseur_id' => true,
        'kilometragedepart' => true,
        'kilometragearrive' => true,
        //'livraisons' => true,
        'fournisseur' => true,
        'pointdevente' => true,
        'depot' => true,
        'cartecarburant' => true,
        'materieltransport' => true,
        'adresselivraisonfournisseur' => true,
        'lignefactures' => true,
        'typefacture'=>true ,
    ];
}
