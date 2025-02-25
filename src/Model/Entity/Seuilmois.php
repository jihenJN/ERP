<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Seuilmois Entity
 *
 * @property int $id
 * @property int $article_id
 * @property string $mois
 * @property int $min
 * @property int $max
 * @property int $alert
 *
 * @property \App\Model\Entity\Article $article
 */
class Seuilmois extends Entity
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
        'article_id' => true,
        'moi_id' => true,
        'min' => true,
        'max' => true,
        'alert' => true,
        'article' => true,
    ];
}
