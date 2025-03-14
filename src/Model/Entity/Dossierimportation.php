<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Dossierimportation Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date
 * @property string $numero
 * @property int|null $etat
 * @property int $methodecalcule_id
 * @property int|null $fournisseur_id
 * @property int|null $banque_id
 */
class Dossierimportation extends Entity
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
        'date' => true,
        'numero' => true,
        'etat' => true,
       // 'methodecalcule_id' => true,
        'fournisseur_id' => true,
        'banque_id' => true,
    ];
}
