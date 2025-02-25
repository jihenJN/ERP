<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BondechargementsFixture
 */
class BondechargementsFixture extends TestFixture
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
                'date' => '2022-07-20 10:42:05',
                'pointdevente_id' => 1,
                'depot_id' => 1,
                'bondetransfert_id' => 1,
                'etatliv' => 1,
            ],
        ];
        parent::init();
    }
}
