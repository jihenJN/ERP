<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Articlefournisseur Entity
 *
 * @property int $id
 * @property int|null $fournisseur_id
 * @property string|null $code
 * @property string|null $prix
 * @property int|null $article_id
 *
 * @property \App\Model\Entity\Fournisseur $fournisseur
 * @property \App\Model\Entity\Article $article
 */
class Articlefournisseur extends Entity
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
        'fournisseur_id' => true,
        'code' => true,
        'prix' => true,
        'article_id' => true,
        'fournisseur' => true,
        'article' => true,
    ];
}
