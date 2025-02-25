<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Objectifrepresentant Entity
 *
 * @property int $id
 * @property int $moi_id
 * @property int $commercial_id
 * @property int $objectif
 *
 * @property \App\Model\Entity\Mois $mois
 * @property \App\Model\Entity\Commercial $commercial
 */
class Objectifrepresentant extends Entity
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
        'moi_id' => true,
        'commercial_id' => true,
        'objectif' => true,
        'mois' => true,
        'commercial' => true,
        'article_id' => true,
    ];
}
