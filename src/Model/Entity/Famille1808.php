<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Famille Entity
 *
 * @property int $id
 * @property string|null $name
 *
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Sousfamille1[] $sousfamille1s
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
        'name' => true,
        'articles' => true,
        'sousfamille1s' => true,
    ];
}
