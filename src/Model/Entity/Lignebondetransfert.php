<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignebondetransfert Entity
 *
 * @property int $id
 * @property int|null $bondetransfert_id
 * @property int|null $article_id
 * @property int|null $qte
 * @property int|null $qteliv
 * @property int $bondechargement_id
 *
 * @property \App\Model\Entity\Bondetransfert $bondetransfert
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Bondechargement $bondechargement
 */
class Lignebondetransfert extends Entity
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
        'bondetransfert_id' => true,
        'article_id' => true,
        'qte' => true,
        'qteliv' => true,
        'bondechargement_id' => true,
        'bondetransfert' => true,
        'article' => true,
        'bondechargement' => true,
    ];
}
