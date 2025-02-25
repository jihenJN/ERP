<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Etape Entity
 *
 * @property int $id
 * @property int|null $personnel_id
 * @property int|null $machine_id
 * @property int|null $rang
 * @property string|null $numero
 *
 * @property \App\Model\Entity\Personnel $personnel
 * @property \App\Model\Entity\Machine $machine
 */
class Etape extends Entity
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
        'personnel_id' => true,
        'machine_id' => true,
        'rang' => true,
        'personnel' => true,
        'machine' => true,
        'numero' => true,
    ];
}
