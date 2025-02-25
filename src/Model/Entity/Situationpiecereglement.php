<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Situationpiecereglement Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate|null $date
 * @property string|null $agio
 * @property int|null $etatpiecereglement_id
 * @property int|null $piecereglement_id
 * @property string|null $situation
 * @property int|null $utilisateur_id
 * @property \Cake\I18n\FrozenDate|null $datemodification
 * @property int|null $nbrjour
 * @property int|null $nbrmoins
 * @property string|null $montant
 * @property string|null $numeropieceintegre
 *
 * @property \App\Model\Entity\Etatpiecereglement $etatpiecereglement
 * @property \App\Model\Entity\Piecereglement $piecereglement
 * @property \App\Model\Entity\Utilisateur $utilisateur
 */
class Situationpiecereglement extends Entity
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
        'id' => true,
        'date' => true,
        'agio' => true,
        'etatpiecereglement_id' => true,
        'piecereglement_id' => true,
        'situation' => true,
        'utilisateur_id' => true,
        'datemodification' => true,
        'nbrjour' => true,
        'nbrmoins' => true,
        'montant' => true,
        'numeropieceintegre' => true,
        'etatpiecereglement' => true,
        'piecereglement' => true,
        'utilisateur' => true,
    ];
}
