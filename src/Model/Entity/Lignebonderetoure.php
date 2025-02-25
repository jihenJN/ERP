<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignebonderetoure Entity
 *
 * @property int $id
 * @property int $article_id
 * @property int $qte
 * @property int $qtestock
 * @property int $bonderetoure_id
 * @property int|null $couleur_id
 * @property int|null $dimension_id
 * @property int|null $categorie_id
 * @property int|null $famille_id
 * @property int|null $sousfamille1_id
 * @property int|null $sousfamille2_id
 * @property int|null $unite_id
 * @property int|null $tva_id
 *
 * @property \App\Model\Entity\Bonderetoure $bonderetoure
 */
class Lignebonderetoure extends Entity
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
        'qte' => true,
        'qtestock' => true,
        'bonderetoure_id' => true,
        'couleur_id' => true,
        'dimension_id' => true,
        'categorie_id' => true,
        'famille_id' => true,
        'sousfamille1_id' => true,
        'sousfamille2_id' => true,
        'unite_id' => true,
        'tva_id' => true,
        'bonderetoure' => true,
    ];
}
