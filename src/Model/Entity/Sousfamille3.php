<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sousfamille3 Entity
 *
 * @property int $id
 * @property int|null $sousfamille2_id
 * @property string|null $name
 *
 * @property \App\Model\Entity\Sousfamille2 $sousfamille2
 * @property \App\Model\Entity\Article[] $articles
 */
class Sousfamille3 extends Entity
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
        'sousfamille2_id' => true,
        'name' => true,
        'sousfamille2' => true,
        'articles' => true,
    ];
}
