<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bondetransfert Entity
 *
 * @property int $id
 * @property string $numero
 * @property \Cake\I18n\FrozenTime $date
 * @property int $pointdevente_id
 * @property int $depotarrive_id
 * @property int $depotsortie_id
 * @property int $cartecarburant_id
 * @property int $materieltransport_id
 * @property int $chauffeur_id
 * @property int $conffaieur_id
 * @property int|null $bonreceptionstock_id
 * @property float $kilometragedepart
 * @property float $kilometragearrive
 *
 * @property \App\Model\Entity\Pointdevente $pointdevente
 * @property \App\Model\Entity\Depotarrife $depotarrife
 * @property \App\Model\Entity\Depotsorty $depotsorty
 * @property \App\Model\Entity\Cartecarburant $cartecarburant
 * @property \App\Model\Entity\Materieltransport $materieltransport
 * @property \App\Model\Entity\Chauffeur $chauffeur
 * @property \App\Model\Entity\Conffaieur $conffaieur
 * @property \App\Model\Entity\Bonreceptionstock $bonreceptionstock
 * @property \App\Model\Entity\Bondechargement[] $bondechargements
 * @property \App\Model\Entity\Lignebondetransfert[] $lignebondetransferts
 */
class Bondetransfert extends Entity
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
        'date' => true,
        'pointdevente_id' => true,
        'pointdeventeentree_id' => true,
        'pointdeventesortie_id' => true,
        'depotarrive_id' => true,
        'depotsortie_id' => true,
        'cartecarburant_id' => true,
        'materieltransport_id' => true,
        'chauffeur_id' => true,
        'conffaieur_id' => true,
        'bonreceptionstock_id' => true,
        'kilometragedepart' => true,
        'kilometragearrive' => true,
        'pointdevente' => true,
        'depotarrife' => true,
        'depotsorty' => true,
        'cartecarburant' => true,
        'materieltransport' => true,
        'chauffeur' => true,
        'conffaieur' => true,
        'bonreceptionstock' => true,
        'bondechargements' => true,
        'lignebondetransferts' => true,
    ];
}
