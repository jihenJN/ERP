<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ordrefabrication Entity
 *
 * @property int $id
 * @property string|null $numero
 * @property \Cake\I18n\FrozenDate|null $date
 * @property int|null $depot_id
 * @property int|null $pointdevente_id
 * @property int|null $article_id
 *
 * @property \App\Model\Entity\Depot $depot
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Article $article
 */
class Ordrefabrication extends Entity
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
        'numero' => true,
        'date' => true,
        'depot_id' => true,
        'pointdevente_id' => true,
        'article_id' => true,
        'depot' => true,
        'pointdevente' => true,
        'article' => true,
    ];
}
