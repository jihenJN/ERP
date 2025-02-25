<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClientexonerationsFixture
 */
class ClientexonerationsFixture extends TestFixture
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
                'typeexon_id' => 1,
                'num_att_taxes' => 1,
                'date_debut' => '2022-07-20',
                'date_fin' => '2022-07-20',
                'document' => 'Lorem ipsum dolor sit amet',
                'client_id' => 1,
            ],
        ];
        parent::init();
    }
}
