<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Uaprincipal Entity
 *
 * @property int $id
 * @property int $unite_id
 * @property float $Correspand
 *
 * @property \App\Model\Entity\Unite $unite
 */
class Uaprincipal extends Entity
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
        'unitearticle_id' => true,
        'article_id' => true,
        'Correspand' => true,
        'unite' => true,
    ];
}
