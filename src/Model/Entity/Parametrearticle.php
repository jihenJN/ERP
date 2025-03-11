<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Parametrearticle Entity
 *
 * @property int $id
 * @property int|null $article_id
 * @property int|null $critere_id
 * @property int|null $lignecritere_id
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Critere $critere
 * @property \App\Model\Entity\Lignecritere $lignecritere
 */
class Parametrearticle extends Entity
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
        'lignearticle_id' => true,
        'critere_id' => true,
        'lignecritere_id' => true,
        'article' => true,
        'critere' => true,
        'lignecritere' => true,
        'famillearticle_id' => true,



    ];
}
