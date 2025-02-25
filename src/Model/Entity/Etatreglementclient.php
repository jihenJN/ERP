<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Etatreglementclient Entity
 *
 * @property int $id
 * @property int|null $reglementclient_id
 * @property int|null $piecereglementclient_id
 * @property \Cake\I18n\FrozenDate|null $date
 * @property int|null $etat_id
 * @property int|null $compte_id
 * @property float|null $montant
 *
 * @property \App\Model\Entity\Reglementclient $reglementclient
 * @property \App\Model\Entity\Piecereglementclient $piecereglementclient
 * @property \App\Model\Entity\Etat $etat
 */
class Etatreglementclient extends Entity
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
        'piecereglementclient_id' => true,
        'date' => true,
        'etat_id' => true,
        'compte_id' => true,
        'reglementclient' => true,
        'piecereglementclient' => true,
        'etat' => true,
        'montant' => true,
    ];
}
