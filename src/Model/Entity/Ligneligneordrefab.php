<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ligneligneordrefab Entity
 *
 * @property int $id
 * @property int|null $ligneordrefabrications_id
 * @property int|null $article_id
 * @property string|null $qte
 *
 * @property \App\Model\Entity\Ligneordrefabrication $ligneordrefabrication
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Ligneligneligneordrefab[] $ligneligneligneordrefabs
 */
class Ligneligneordrefab extends Entity
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
        'ligneordrefabrications_id' => true,
        'article_id' => true,
        'qte' => true,
        'ligneordrefabrication' => true,
        'article' => true,
        'ligneligneligneordrefabs' => true,
    ];
}
