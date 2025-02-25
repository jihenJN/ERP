<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gouvernorat Entity
 *
 * @property int $id
 * @property string $name
 * @property int $codepostale
 * @property string $code
 */
class Gouvernorat extends Entity
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
        'name' => true,
        'codepostale' => true,
        'code' => true,
        'pay_id' => true , 
    ];
}
