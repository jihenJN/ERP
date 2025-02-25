<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Compte Entity
 *
 * @property int $id
 * @property string|null $rib
 * @property int|null $banque_id
 * @property string|null $code
 * @property int|null $typecompte_id
 * @property int|null $categoriecompte_id
 * @property string|null $solde
 * @property \Cake\I18n\FrozenDate|null $date
 * @property string|null $chiraat
 * @property string|null $notponctuelle
 * @property string|null $fc
 * @property string|null $findestock
 * @property string|null $escompte
 * @property string|null $esp
 * @property int|null $nbjrcheque
 * @property int|null $nbjrtraite
 * @property float|null $limitemontantcheque
 * @property float|null $limitemontanttraite
 * @property float|null $tauscheque
 * @property float|null $taustraite
 * @property float|null $tausdepacementcheque
 * @property float|null $tausdepacementtraite
 * @property string|null $comptecomptable
 * @property int|null $journal_id
 * @property string|null $journal_idcheque
 * @property string|null $journal_idtraite
 * @property string|null $journal_idlcfd
 * @property string|null $banque
 */
class Compte extends Entity
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
        'rib' => true,
        'banque_id' => true,
        'code' => true,
        'typecompte_id' => true,
        'categoriecompte_id' => true,
        'solde' => true,
        'date' => true,
        'chiraat' => true,
        'notponctuelle' => true,
        'fc' => true,
        'findestock' => true,
        'escompte' => true,
        'esp' => true,
        'nbjrcheque' => true,
        'nbjrtraite' => true,
        'limitemontantcheque' => true,
        'limitemontanttraite' => true,
        'tauscheque' => true,
        'taustraite' => true,
        'tausdepacementcheque' => true,
        'tausdepacementtraite' => true,
        'comptecomptable' => true,
        'journal_id' => true,
        'journal_idcheque' => true,
        'journal_idtraite' => true,
        'journal_idlcfd' => true,
        'banque' => true,
    ];
}
