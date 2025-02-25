<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gouvernoratcommercial Entity
 *
 * @property int $id
 * @property int|null $commercial_id
 * @property int|null $gouvernorat_id
 *
 * @property \App\Model\Entity\Commercial $commercial
 * @property \App\Model\Entity\Gouvernorat $gouvernorat
 */
class Gouvernoratcommercial extends Entity
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
        'commercial_id' => true,
        'gouvernorat_id' => true,
        'commercial' => true,
        'gouvernorat' => true,
    ];
}
