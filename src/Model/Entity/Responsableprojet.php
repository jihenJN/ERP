<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Responsableprojet Entity
 *
 * @property int $id
 * @property int|null $personnel_id
 * @property int|null $projet_id
 *
 * @property \App\Model\Entity\Personnel $personnel
 */
class Responsableprojet extends Entity
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
        'projet_id' => true,
        'personnel' => true,
    ];
}
