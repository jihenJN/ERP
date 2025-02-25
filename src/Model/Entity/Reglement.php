<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reglement Entity
 *
 * @property int $id
 * @property string|null $numeroconca
 * @property int|null $fournisseur_id
 * @property \Cake\I18n\FrozenDate|null $Date
 * @property string|null $Montant
 * @property int|null $importation_id
 * @property string|null $montantdevise
 * @property int|null $libre
 * @property int|null $utilisateur_id
 * @property int|null $exercice_id
 * @property string|null $designation
 * @property int|null $impaye
 * @property string|null $differance
 * @property string|null $numeropieceintegre
 * @property float|null $RG_NO
 * @property int|null $devise_id
 * @property string|null $taux
 *
 * @property \App\Model\Entity\Fournisseur $fournisseur
 * @property \App\Model\Entity\Importation $importation
 * @property \App\Model\Entity\Utilisateur $utilisateur
 * @property \App\Model\Entity\Exercice $exercice
 * @property \App\Model\Entity\Devise $devise
 * @property \App\Model\Entity\Lignereglement[] $lignereglements
 * @property \App\Model\Entity\Piecereglement[] $piecereglements
 */
class Reglement extends Entity
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
        'numeroconca' => true,
        'fournisseur_id' => true,
        'Date' => true,
        'Montant' => true,
        'importation_id' => true,
        'montantdevise' => true,
        'libre' => true,
        'utilisateur_id' => true,
        'exercice_id' => true,
        'designation' => true,
        'impaye' => true,
        'differance' => true,
        'numeropieceintegre' => true,
        'RG_NO' => true,
        'devise_id' => true,
        'taux' => true,
        'fournisseur' => true,
        'importation' => true,
        'utilisateur' => true,
        'exercice' => true,
        'devise' => true,
        'lignereglements' => true,
        'piecereglements' => true,
        'pointdevente_id'=> true,
        'livraison_id'=> true,
        'commentaire'=> true,
        'dif'=> true,

        'differance'=> true,


    ];
}
