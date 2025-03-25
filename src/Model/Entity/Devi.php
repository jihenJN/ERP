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
 * @property string $total_remise
 * @property string $total_ht
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
        'client' => true,
    ];
}
