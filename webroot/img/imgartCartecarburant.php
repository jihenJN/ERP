<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cartecarburant Entity
 *
 * @property int $id
 * @property string|null $num
 * @property string|null $motdepasse
 * @property string|null $typekiosque
 * @property int|null $typecartecarburant_id
 *
 * @property \App\Model\Entity\Typecartecarburant $typecartecarburant
 * @property \App\Model\Entity\Bondetransfert[] $bondetransferts
 * @property \App\Model\Entity\Bonlivraison[] $bonlivraisons
 * @property \App\Model\Entity\Bonreceptionstock[] $bonreceptionstocks
 * @property \App\Model\Entity\Bonsortiestock[] $bonsortiestocks
 * @property \App\Model\Entity\Commandeclient[] $commandeclients
 * @property \App\Model\Entity\Commande[] $commandes
 * @property \App\Model\Entity\Factureclient[] $factureclients
 * @property \App\Model\Entity\Facture[] $factures
 * @property \App\Model\Entity\Livraison[] $livraisons
 * @property \App\Model\Entity\Livraisonsanc[] $livraisonsanc
 */
class Cartecarburant extends Entity
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
        'num' => true,
        'motdepasse' => true,
        'typekiosque' => true,
        'typecartecarburant_id' => true,
        'typecartecarburant' => true,
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
