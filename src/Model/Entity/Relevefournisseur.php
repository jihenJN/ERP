<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Relevefournisseur Entity
 *
 * @property int $id
 * @property string|null $numclt
 * @property int|null $fournisseur_id
 * @property \Cake\I18n\FrozenTime|null $date
 * @property string|null $numero
 * @property string|null $type
 * @property string|null $typeimp
 * @property string|null $debit
 * @property string|null $credit
 * @property string|null $impaye
 * @property string|null $reglement
 * @property string|null $avoir
 * @property string|null $solde
 * @property int|null $exercice_id
 * @property string|null $typ
 * @property int|null $nbligneimp
 */
class Relevefournisseur extends Entity
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
        'numclt' => true,
        'fournisseur_id' => true,
        'date' => true,
        'numero' => true,
        'type' => true,
        'typeimp' => true,
        'debit' => true,
        'credit' => true,
        'impaye' => true,
        'reglement' => true,
        'avoir' => true,
        'solde' => true,
        'exercice_id' => true,
        'typ' => true,
        'nbligneimp' => true,
    ];
}
