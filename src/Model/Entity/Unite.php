<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Unite Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $typeU
 * @property string|null $formule
 *
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Articleunite[] $articleunites
 */
class Unite extends Entity
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
        'typeU' => true,
        'formule' => true,
        'articles' => true,
        'articleunites' => true,
        'reference' => true,

    ];
}
