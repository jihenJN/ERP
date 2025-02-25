<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Historiquearticle Entity
 *
 * @property int $id
 * @property string|null $client
 * @property string|null $fournisseur
 * @property string|null $utilisateur
 * @property \Cake\I18n\FrozenDate|null $date
 * @property string|null $type
 * @property string|null $numero
 * @property string|null $article
 * @property float|null $qte
 * @property string|null $pu
 * @property string|null $ptot
 * @property float|null $remise
 * @property float|null $tva
 * @property string|null $mode
 * @property int|null $indice
 * @property string|null $depot
 * @property int|null $personnel_id
 */
class Historiquearticle extends Entity
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
        'client' => true,
        'fournisseur' => true,
        'utilisateur' => true,
        'date' => true,
        'type' => true,
        'numero' => true,
        'article' => true,
        'qte' => true,
        'pu' => true,
        'ptot' => true,
        'remise' => true,
        'tva' => true,
        'mode' => true,
        'indice' => true,
        'depot' => true,
        'personnel_id' => true,
    ];
}
