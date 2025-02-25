<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Etatpieceregelemnt Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $date
 * @property int|null $etat_id
 * @property int|null $piecereglementachat_id
 * @property int|null $reglementachat_id
 * @property int|null $compte_id
 * @property float|null $montant
 * @property \App\Model\Entity\Etat $etat
 * @property \App\Model\Entity\Piecereglementachat $piecereglementachat
 * @property \App\Model\Entity\Reglementachat $reglementachat
 */
class Etatpieceregelemnt extends Entity
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
        'etat_id' => true,
        'piecereglement_id' => true,
        'reglement_id' => true,
        'compte_id' => true,
        'etat' => true,
        'montant' => true,
        //'piecereglementachat' => true,
        //'reglementachat' => true,
    ];
}
