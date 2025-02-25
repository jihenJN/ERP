<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Materieltransport Entity
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $matricule
 * @property string|null $designation
 * @property float|null $kilometragedepart
 * @property float|null $kilometragearrive
 * @property string|null $numero
 * @property string|null $poids
 *
 * @property \App\Model\Entity\Bondetransfert[] $bondetransferts
 * @property \App\Model\Entity\Bonlivraison[] $bonlivraisons
 * @property \App\Model\Entity\Bonreceptionstock[] $bonreceptionstocks
 * @property \App\Model\Entity\BonSortieStock[] $bonsortiestocks
 * @property \App\Model\Entity\Commandeclient[] $commandeclients
 * @property \App\Model\Entity\Commande[] $commandes
 * @property \App\Model\Entity\Factureclient[] $factureclients
 * @property \App\Model\Entity\Facture[] $factures
 * @property \App\Model\Entity\Livraison[] $livraisons
 * @property \App\Model\Entity\Livraisonsanc[] $livraisonsanc
 */
class Materieltransport extends Entity
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
        'code' => true,
        'matricule' => true,
        'designation' => true,
        'kilometragedepart' => true,
        'kilometragearrive' => true,
        'numero' => true,
        'poids' => true,
        'bondetransferts' => true,
        'bonlivraisons' => true,
        'bonreceptionstocks' => true,
        'bonsortiestocks' => true,
        'commandeclients' => true,
        'commandes' => true,
        'factureclients' => true,
        'factures' => true,
        'livraisons' => true,
        'livraisonsanc' => true,
    ];
}
