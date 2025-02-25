<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bonusmaluscommercial Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $datedebut
 * @property \Cake\I18n\FrozenDate $datefin
 * @property int $commercial_id
 * @property float $total
 *
 * @property \App\Model\Entity\Commercial $commercial
 * @property \App\Model\Entity\Lignebonusmalus[] $lignebonusmalus
 */
class Bonusmaluscommercial extends Entity
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
        'datedebut' => true,
        'datefin' => true,
        'commercial_id' => true,
        'total' => true,
        'commercial' => true,
        'lignebonusmalus' => true,
        'dateoperation' => true,
        'numero'=>true
    ];
}
