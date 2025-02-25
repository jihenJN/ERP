<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Historiquecompte Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $date
 * @property string|null $type
 * @property string|null $mode
 * @property int|null $indice
 * @property float|null $montant
 * @property float|null $credit
 * @property float|null $debit
 * @property string|null $numero
 */
class Historiquecompte extends Entity
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
        'type' => true,
        'mode' => true,
        'indice' => true,
        'montant' => true,
        'credit' => true,
        'debit' => true,
        'numero' => true,
    ];
}
