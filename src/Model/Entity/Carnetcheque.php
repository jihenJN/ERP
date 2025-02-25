<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Carnetcheque Entity
 *
 * @property int $id
 * @property string|null $numero
 * @property int|null $compte_id
 * @property string|null $debut
 * @property int|null $nombre
 * @property int|null $taille
 *
 * @property \App\Model\Entity\Compte $compte
 * @property \App\Model\Entity\Piecereglement[] $piecereglements
 */
class Carnetcheque extends Entity
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
        'numero' => true,
        'compte_id' => true,
        'banque_id' => true,
        'debut' => true,
        'nombre' => true,
        'taille' => true,
        'compte' => true,
        'piecereglements' => true,
    ];
}
