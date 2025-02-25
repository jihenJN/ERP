<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignebonchargement Entity
 *
 * @property int $id
 * @property int $bondechargement_id
 * @property int $article_id
 * @property string $prix
 * @property int $qte
 * @property string $total
 *
 * @property \App\Model\Entity\Bondechargement $bondechargement
 * @property \App\Model\Entity\Article $article
 */
class Lignebonchargement extends Entity
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
        'bondechargement_id' => true,
        'article_id' => true,
        ////'prix' => true,
        'qte' => true,
        ///'total' => true,
        'bondechargement' => true,
        'article' => true,
    ];
}
