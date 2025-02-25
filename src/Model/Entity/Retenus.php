<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Retenus Entity
 *
 * @property int $id
 * @property int|null $client_id
 * @property \Cake\I18n\FrozenTime|null $date
 * @property int|null $numero
 *
 * @property \App\Model\Entity\Client $client
 */
class Retenus extends Entity
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
        'client_id' => true,
        'date' => true,
        'numero' => true,
        'client' => true,
        'total' => true,

    ];
}
