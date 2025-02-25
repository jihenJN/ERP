<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Piecereglementclient Entity
 *
 * @property int $id
 * @property int|null $paiement_id
 * @property int|null $reglementclient_id
 * @property string|null $montant
 * @property string|null $num
 * @property \Cake\I18n\FrozenDate|null $echance
 * @property string|null $banque
 * @property string|null $montant_brut
 * @property string|null $montant_net
 * @property int|null $to_id
 * @property int|null $compte_id
 * @property string|null $situation
 * @property \Cake\I18n\FrozenDate|null $datesituation
 * @property int|null $reglement
 * @property string|null $mantantregler
 * @property int|null $emi
 * @property int|null $envoye
 * @property int|null $valide
 * @property float|null $valeur
 * @property int|null $etat_id
 * @property string|null $numeropieceintegre
 * @property string|null $prop
 * @property string|null $commission
 * @property string|null $tvacommission
 *
 * @property \App\Model\Entity\Reglementclient $reglementclient
 * @property \App\Model\Entity\Compte $compte
 * @property \App\Model\Entity\Lignereglementclient[] $lignereglementclients
 * @property \App\Model\Entity\Situationpiecereglementclient[] $situationpiecereglementclients
 */
class Piecereglementclient extends Entity
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
        'paiement_id' => true,
        'reglementclient_id' => true,
        'montant' => true,
        'num' => true,
        'echance' => true,
        'banque_id' => true,
        'montant_brut' => true,
        'montant_net' => true,
        'to_id' => true,



      
        'banque_id' => true,
        'compte_id' => true,

        'situation' => true,
        'datesituation' => true,
        'reglement' => true,
        'mantantregler' => true,
        'emi' => true,
        'envoye' => true,
        'valide' => true,
        'valeur' => true,
        'etat_id' => true,
        'numeropieceintegre' => true,
        'prop' => true,
        'commission' => true,
        'tvacommission' => true,
        'reglementclient' => true,
        'compte' => true,
        'lignereglementclients' => true,
        'situationpiecereglementclients' => true,
        'acomptetype' => true,
        'caisse_id'=>true,
        'piecejointe'=>true,
        'rib'=>true,
        'porteurcheque'=>true,

        'endosse'=>true,
        'echance2' => true,
        'banque'=>true,
        'compte' => true,
   


    ];
}
