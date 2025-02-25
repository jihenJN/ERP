<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Baseposte Entity
 *
 * @property int $id
 * @property string $codepostale
 * @property int $id_gouv
 * @property int $id_deleg
 * @property int $id_loc
 */
class Baseposte extends Entity
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
        'codepostale' => true,
        'id_gouv' => true,
        'id_deleg' => true,
        'id_loc' => true,
    ];
}
