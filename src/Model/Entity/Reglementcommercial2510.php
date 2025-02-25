<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reglementcommercial Entity
 *
 * @property int $id
 * @property int $commercial_id
 * @property int $paiement_id
 * @property \Cake\I18n\FrozenDate $date
 *
 * @property \App\Model\Entity\Commercial $commercial
 * @property \App\Model\Entity\Paiement $paiement
 * @property \App\Model\Entity\Lignereglementcommercial[] $lignereglementcommercials
 */
class Reglementcommercial extends Entity
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
        'commercial_id' => true,
        'paiement_id' => true,
        'numero' => true,
        'date' => true,
        'numero' => true,
        'commercial' => true,
        'montantpaye' => true,
          'montant' => true,
        'commission'=>true,
        'paiement' => true,
        'lignereglementcommercials' => true,
    ];
}
