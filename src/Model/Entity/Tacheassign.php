<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tacheassign Entity
 *
 * @property int $id
 * @property string|null $numero
 * @property int|null $projet_id
 * @property int|null $tache_id
 * @property int|null $commercial_id
 * @property int|null $personnel_id
 * @property \Cake\I18n\FrozenTime|null $datedebut
 * @property int|null $HH
 * @property int|null $MM
 * @property string|null $note
 */
class Tacheassign extends Entity
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
        'projet_id' => true,
        'tache_id' => true,
        'commercial_id' => true,
        'personnel_id' => true,
        'datedebut' => true,
        'datefin' => true,
        'HH' => true,
        'MM' => true,
        'note' => true,
    ];
}
