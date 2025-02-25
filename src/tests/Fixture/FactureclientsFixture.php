<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FactureclientsFixture
 */
class FactureclientsFixture extends TestFixture
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
                'numero' => 'Lorem ipsum dolor sit amet',
                'date' => '2022-08-04 13:05:16',
                'client_id' => 1,
                'pointdevente_id' => 1,
                'depot_id' => 1,
                'materieltransport_id' => 1,
                'cartecarburant_id' => 1,
                'totalht' => 1.5,
                'totalremise' => 1.5,
                'totalfodec' => 1.5,
                'totaltva' => 1.5,
                'totalttc' => 1.5,
                'kilometragearrive' => 1,
                'kilometragedepart' => 1,
                'adresselivraisonclient_id' => 1,
            ],
        ];
        parent::init();
    }
}
