<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tagsarticle Entity
 *
 * @property int $id
 * @property int|null $article_id
 * @property int|null $listetag_id
 *
 * @property \App\Model\Entity\Listetag $listetag
 */
class Tagsarticle extends Entity
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
        'listetag_id' => true,
        'listetag' => true,
        'categorie_id' => true,

    ];
}
