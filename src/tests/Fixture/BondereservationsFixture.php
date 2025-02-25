<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BondereservationsFixture
 */
class BondereservationsFixture extends TestFixture
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
                'date' => '2022-07-20 10:42:40',
                'client_id' => 1,
                'pointdevente_id' => 1,
                'depot_id' => 1,
                'datecreation' => '2022-07-20 10:42:40',
                'commandeclient_id' => 1,
            ],
        ];
        parent::init();
    }
}
