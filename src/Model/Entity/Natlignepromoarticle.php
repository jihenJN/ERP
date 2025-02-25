<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Natlignepromoarticle Entity
 *
 * @property int $id
 * @property int $article_id
 * @property float $qte
 * @property float $value
 * @property int $promoarticle_id
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Promoarticle $promoarticle
 */
class Natlignepromoarticle extends Entity
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
        'qte' => true,
        'value' => true,
        'promoarticle_id' => true,
        'article' => true,
        'promoarticle' => true,
    ];
}
