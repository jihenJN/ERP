<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fichearticle Entity
 *
 * @property int $id
 * @property int|null $article_id
 * @property int|null $article_id1
 * @property int|null $article_id2
 * @property int|null $article_id3
 * @property float|null $qte
 *
 * @property \App\Model\Entity\Article $article
 */
class Fichearticle extends Entity
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
        'article_id1' => true,
        'article_id2' => true,
        'article_id3' => true,
        'qte' => true,
        'article' => true,
        'unite_id' => true,
        'coeff' => true,
    ];
}
