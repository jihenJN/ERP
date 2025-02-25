<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignepromoarticle Entity
 *
 * @property int $id
 * @property int $promoarticle_id
 * @property float $min
 * @property float $max
 * @property int $article_id
 * @property float $value
 *
 * @property \App\Model\Entity\Promoarticle $promoarticle
 * @property \App\Model\Entity\Article $article
 */
class Lignepromoarticle extends Entity
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
        'promoarticle_id' => true,
        'min' => true,
        'max' => true,
        'article_id' => true,
        'value' => true,
        'promoarticle' => true,
        'article' => true,
    ];
}
