<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InventairesFixture
 */
class InventairesFixture extends TestFixture
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
                'depot_id' => 1,
                'date' => '2022-07-20 11:02:28',
                'numero' => 'Lorem ipsum dolor sit amet',
                'exercice_id' => 1,
                'valide' => 1,
                'type' => 1,
                'tournant' => 1,
            ],
        ];
        parent::init();
    }
}
