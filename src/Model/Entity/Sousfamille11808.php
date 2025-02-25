<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sousfamille1 Entity
 *
 * @property int $id
 * @property int|null $famille_id
 * @property string|null $name
 *
 * @property \App\Model\Entity\Famille $famille
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Sousfamille2[] $sousfamille2s
 */
class Sousfamille1 extends Entity
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
        'famille_id' => true,
        'name' => true,
        'famille' => true,
        'articles' => true,
        'sousfamille2s' => true,
    ];
}
