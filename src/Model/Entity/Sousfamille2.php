<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sousfamille2 Entity
 *
 * @property int $id
 * @property int|null $sousfamille1_id
 * @property string|null $name
 *
 * @property \App\Model\Entity\Sousfamille1 $sousfamille1
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Sousfamille3[] $sousfamille3s
 */
class Sousfamille2 extends Entity
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
        'sousfamille1_id' => true,
        'name' => true,
        'sousfamille1' => true,
        'articles' => true,
        'sousfamille3s' => true,
    ];
}
