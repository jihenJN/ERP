<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Remiseqte Entity
 *
 * @property int $id
 * @property int $pourcentage
 * @property string $code
 * @property string|null $qtemin
 * @property string|null $qtemax
 */
class Remiseqte extends Entity
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
        'pourcentage' => true,
        'code' => true,
        'qtemin' => true,
        'qtemax' => true,
    ];
}
