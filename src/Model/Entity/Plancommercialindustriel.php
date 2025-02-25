<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plancommercialindustriel Entity
 *
 * @property int $id
 * @property string|null $numero
 * @property \Cake\I18n\FrozenTime|null $date
 * @property int|null $moisdu_id
 * @property int|null $moisau_id
 * @property float|null $marge
 * @property int|null $depot_id
 *
 * @property \App\Model\Entity\Depot $depot
 */
class Plancommercialindustriel extends Entity
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
        'moisdu_id' => true,
        'moisau_id' => true,
        'marge' => true,
        'depot_id' => true,
        'depot' => true,
    ];
}
