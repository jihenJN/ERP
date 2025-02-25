<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reglementclient Entity
 *
 * @property int $id
 * @property int|null $client_id
 * @property \Cake\I18n\FrozenDate|null $date
 * @property string|null $Montant
 * @property string|null $montantaffecte
 * @property int|null $pointdevente_id
 * @property string|null $numero
 * @property string|null $numeroconca
 * @property string|null $SR
 * @property string|null $NB
 * @property string|null $NumNB
 * @property string|null $client
 * @property string|null $mg
 * @property int|null $exercice_id
 * @property int|null $utilisateur_id
 * @property int|null $type
 * @property int $affectation_id
 * @property string $emi
 * @property string|null $numeropieceintegre
 * @property int|null $group_id
 * @property string|null $differance
 * @property string|null $observation
 *
 * @property \App\Model\Entity\Utilisateur $utilisateur
 * @property \App\Model\Entity\Lignereglementclient[] $lignereglementclients
 * @property \App\Model\Entity\Piecereglementclient[] $piecereglementclients
 */
class Reglementclient extends Entity
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
        'client_id' => true,
        'date' => true,
        'Montant' => true,
        'montantaffecte' => true,
        'pointdevente_id' => true,
        'numero' => true,
        'numeroconca' => true,
        'SR' => true,
        'NB' => true,
        'NumNB' => true,
        'client' => true,
        'mg' => true,
        'exercice_id' => true,
        'utilisateur_id' => true,
        'type' => true,
        'affectation_id' => true,
        'emi' => true,
        'numeropieceintegre' => true,
        'group_id' => true,
        'differance' => true,
        'observation' => true,
        'utilisateur' => true,
        'lignereglementclients' => true,
        'piecereglementclients' => true,
        'libre' => true,
        'user_id'=> true,
        'dif'=> true,
        'retenu_id'=> true,
        
        'nomprenom' => true,
        'numeroidentite'=>true,
        'adressediv'=>true,

    ];
}
