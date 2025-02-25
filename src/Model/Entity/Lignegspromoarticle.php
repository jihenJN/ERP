<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignegspromoarticle Entity
 *
 * @property int $id
 * @property int $article_id
 * @property float $qte
 * @property float $value
 * @property int $gspromoarticle_id
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Gspromoarticle $gspromoarticle
 */
class Lignegspromoarticle extends Entity
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
        'value' => true,
        'gspromoarticle_id' => true,
        'article' => true,
        'gspromoarticle' => true,
    ];
}
