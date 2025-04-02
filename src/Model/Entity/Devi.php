<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Devi Entity
 *
 * @property int $id
 * @property string $numero
 * @property \Cake\I18n\FrozenTime $date
 * @property int $client_id
 * @property float $total_remise
 * @property float $total_ht
 * @property float $total_brute
 * @property float $total_ttc
 * @property float $total_tva
 *
 * @property \App\Model\Entity\Client $client
 */
class Devi extends Entity
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
        'numero' => true,
        'date' => true,
        'client_id' => true,
        'total_remise' => true,
        'total_ht' => true,
        'total_brute' => true,
        'total_tva' => true,
        'total_ttc' => true,
        'client' => true,
    ];
}
