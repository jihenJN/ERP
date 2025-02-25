<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lignereglementclient Entity
 *
 * @property int $id
 * @property int|null $reglementclient_id
 * @property string|null $Montant
 * @property int|null $factureclient_id
 * @property int|null $piecereglementclient_id
 * @property string|null $remise
 * @property string|null $SR_BL
 * @property string|null $NB_BL
 * @property int|null $affectation_id
 *
 * @property \App\Model\Entity\Reglementclient $reglementclient
 * @property \App\Model\Entity\Piecereglementclient $piecereglementclient
 */
class Lignereglementclient extends Entity
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
        'reglementclient_id' => true,
        'Montant' => true,
        'factureclient_id' => true,
        'bonlivraison_id' => true,
        'piecereglementclient_id' => true,
        'remise' => true,
        'SR_BL' => true,
        'NB_BL' => true,
        'affectation_id' => true,
        'reglementclient' => true,
        'piecereglementclient' => true,
        'commande_id' => true,
        'client_id' => true,
        'factureavoir_id' => true,


    ];
}
