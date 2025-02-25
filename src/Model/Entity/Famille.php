<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Famille Entity
 *
 * @property float $id
 * @property string|null $Nom
 * @property int|null $etat
 *
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Articlesold[] $articlesold
 * @property \App\Model\Entity\Sousfamille1[] $sousfamille1s
 * @property \App\Model\Entity\Sousfamille1sold[] $sousfamille1sold
 */
class Famille extends Entity
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
        'Nom' => true,
        'etat' => true,
        'vente' => true,
        'articles' => true,
        'articlesold' => true,
        'sousfamille1s' => true,
        'sousfamille1sold' => true,
        'obligatoire' => true,
        'marque_id' => true,


    ];
}
