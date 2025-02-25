<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ligneinventaire Entity
 *
 * @property int $id
 * @property int|null $inventaire_id
 * @property int|null $article_id
 * @property float|null $qteTheorique
 * @property float|null $qteStock
 *
 * @property \App\Model\Entity\Inventaire $inventaire
 * @property \App\Model\Entity\Article $article
 */
class Ligneinventaire extends Entity
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
        'inventaire_id' => true,
        'article_id' => true,
        'qteTheorique' => true,
        'qteStock' => true,
        'inventaire' => true,
        'article' => true,
    ];
}
