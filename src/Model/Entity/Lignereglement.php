<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignereglement Entity
 *
 * @property int $id
 * @property int|null $reglement_id
 * @property string|null $Montant
 * @property int|null $facture_id
 * @property float|null $tauxchange
 * @property int|null $piecereglement_id
 *
 * @property \App\Model\Entity\Reglement $reglement
 * @property \App\Model\Entity\Facture $facture
 * @property \App\Model\Entity\Piecereglement $piecereglement
 */
class Lignereglement extends Entity
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
        'reglement_id' => true,
        'Montant' => true,
        'facture_id' => true,
        'tauxchange' => true,
        'piecereglement_id' => true,
        'reglement' => true,
        'facture' => true,
        'piecereglement' => true,
        'livraison_id' => true,
        'fournisseur_id' => true,
        'factureavoirfr_id' => true,

    ];
}
