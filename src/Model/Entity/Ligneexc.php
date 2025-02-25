<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ligneexc Entity
 *
 * @property int $id
 * @property string $N
 * @property string $REP
 * @property string $DESIGNATION
 * @property string $TYPE
 * @property string $qte
 * @property string $Unite
 * @property string $POIDS
 * @property string $PU
 * @property string $CODE
 * @property string $ml
 */
class Ligneexc extends Entity
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
        'bonlivraison_id' => true,
        'N' => true,
        'REP' => true,
        'DESIGNATION' => true,
        'TYPE' => true,
        'qte' => true,
        'Unite' => true,
        'POIDS' => true,
        'PU' => true,
        'CODE' => true,
        'ml' => true,
    ];
}
