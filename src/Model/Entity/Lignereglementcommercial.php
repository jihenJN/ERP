<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignereglementcommercial Entity
 *
 * @property int $id
 * @property int $lignelivraison_id
 * @property int $lignebonusmalu_id
 * @property string $montant
 * @property int $reglementcommercial_id
 *
 * @property \App\Model\Entity\Livraison $livraison
 * @property \App\Model\Entity\Reglementcommercial $reglementcommercial
 */
class Lignereglementcommercial extends Entity
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
        'lignebonlivraison_id' => true,
        'lignebonusmalu_id' => true,
        'montant' => true,
        'reglementcommercial_id' => true,
    ];
}
