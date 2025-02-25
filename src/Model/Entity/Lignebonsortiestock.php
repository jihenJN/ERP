<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignebonsortiestock Entity
 *
 * @property int $id
 * @property int $bonsortiestock_id
 * @property int $article_id
 * @property int $qtestock
 * @property int $qte
 * @property string $prix
 * @property string $total
 *
 * @property \App\Model\Entity\Bonsortiestock $bonsortiestock
 * @property \App\Model\Entity\Article $article
 */
class Lignebonsortiestock extends Entity
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
        'bonsortiestock_id' => true,
        'article_id' => true,
        'qtestock' => true,
        'qte' => true,
        'prix' => true,
        'total' => true,
        'bonsortiestock' => true,
        'article' => true,
    ];
}
