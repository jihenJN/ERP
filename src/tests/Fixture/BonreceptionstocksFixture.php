<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BonreceptionstocksFixture
 */
class BonreceptionstocksFixture extends TestFixture
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
                'date' => '2022-07-20 14:05:27',
                'pointdevente_id' => 1,
                'depot_id' => 1,
                'materieltransport_id' => 1,
                'cartecarburant_id' => 1,
                'personnel_id' => 1,
                'kilometragedepart' => 1,
                'kilometragearrive' => 1,
            ],
        ];
        parent::init();
    }
}
