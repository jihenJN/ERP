<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BonsortiestocksFixture
 */
class BonsortiestocksFixture extends TestFixture
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
                'date' => '2022-07-20 14:04:51',
                'pointdevente_id' => 1,
                'materieltransport_id' => 1,
                'cartecarburant_id' => 1,
                'kilometragedepart' => 1,
                'kilometragearrive' => 1,
            ],
        ];
        parent::init();
    }
}
