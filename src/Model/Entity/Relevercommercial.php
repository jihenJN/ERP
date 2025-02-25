<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Relevercommercial Entity
 *
 * @property int $id
 * @property int $commercial_id
 * @property int $bonlivraison_id
 * @property int $lignebonlivraison_id
 * @property int $bonusmaluscommercial_id
 * @property int $lignebonusmalu_id
 * @property int $reglement_id
 * @property int $lignereglement_id
 * @property int $debit
 * @property int $credit
 * @property int $total
 *
 * @property \App\Model\Entity\Commercial $commercial
 * @property \App\Model\Entity\Bonlivraison $bonlivraison
 * @property \App\Model\Entity\Lignebonlivraison $lignebonlivraison
 * @property \App\Model\Entity\Bonusmaluscommercial $bonusmaluscommercial
 * @property \App\Model\Entity\Lignebonusmalus $lignebonusmalus
 * @property \App\Model\Entity\Reglement $reglement
 * @property \App\Model\Entity\Lignereglement $lignereglement
 */
class Relevercommercial extends Entity
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
     
    ];
}
