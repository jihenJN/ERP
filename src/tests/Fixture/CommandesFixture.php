<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CommandesFixture
 */
class CommandesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'demandeoffredeprix_id' => 1,
                'numero' => 'Lorem ipsum dolor sit amet',
                'date' => '2022-07-20 10:49:25',
                'fournisseur_id' => 1,
                'pointdevente_id' => 1,
                'depot_id' => 1,
                'cartecarburant_id' => 1,
                'materieltransport_id' => 1,
                'chauffeur' => 1,
                'convoyeur' => 1,
                'valide' => 1,
                'remise' => 1.5,
                'tva' => 1.5,
                'fodec' => 1.5,
                'ttc' => 1.5,
                'ht' => 1.5,
                'livraison_id' => 1,
                'etatliv' => 1,
            ],
        ];
        parent::init();
    }
}
