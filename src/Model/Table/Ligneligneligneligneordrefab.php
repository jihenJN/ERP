<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ligneligneligneligneordrefab Entity
 *
 * @property int $id
 * @property int|null $ligneligneligneordrefab_id
 * @property int|null $article_id
 * @property string|null $qte
 *
 * @property \App\Model\Entity\Ligneligneligneordrefab $ligneligneligneordrefab
 * @property \App\Model\Entity\Article $article
 */
class Ligneligneligneligneordrefab extends Entity
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
        'ligneligneligneordrefab_id' => true,
        'article_id' => true,
        'qte' => true,
        'ligneligneligneordrefab' => true,
        'article' => true,
    ];
}
