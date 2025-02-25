<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Previsionachat Entity
 *
 * @property int $id
 * @property int $numero
 * @property int $depot_id
 * @property \Cake\I18n\FrozenDate $date
 */
class Previsionachat extends Entity
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
        // 'depot_id' => true,
        'date' => true,
    ];
}
