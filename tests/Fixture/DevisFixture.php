<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DevisFixture
 */
class DevisFixture extends TestFixture
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
                'date' => '2025-03-25 10:05:23',
                'client_id' => 1,
                'total_remise' => 1,
                'total_ht' => 1,
                'total_brute' => 1,
            ],
        ];
        parent::init();
    }
}
