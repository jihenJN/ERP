<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ligneprevisionachat Entity
 *
 * @property int $id
 * @property int $moi_id
 * @property int $article_id
 *
 * @property \App\Model\Entity\Article $article
 */
class Ligneprevisionachat extends Entity
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
        'moi_id' => true,
        'qte' => true , 
        'article_id' => true,
        'article' => true,
        'previsionachat_id' => true,

    ];
}
