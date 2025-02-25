<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Paiementfacture Entity
 *
 * @property int $id
 * @property int|null $facture_id
 * @property int|null $paiement_id
 *
 * @property \App\Model\Entity\Facture $facture
 * @property \App\Model\Entity\Paiement $paiement
 */
class Paiementfacture extends Entity
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
        'facture_id' => true,
        'paiement_id' => true,
        'facture' => true,
        'paiement' => true,
    ];
}
