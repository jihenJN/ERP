<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DemandeoffredeprixesFixture
 */
class DemandeoffredeprixesFixture extends TestFixture
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
                'date' => '2022-07-20',
                'numero' => 'Lorem ips',
                'consultation' => 1,
                'commande' => 1,
            ],
        ];
        parent::init();
    }
}
