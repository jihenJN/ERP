<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TracemisejoursFixture
 */
class TracemisejoursFixture extends TestFixture
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
                'model' => 'Lorem ipsum dolor sit amet',
                'id_piece' => 'Lorem ipsum dolor sit amet',
                'operation' => 'Lorem ipsum dolor sit amet',
                'numero' => 'Lorem ipsum dolor sit amet',
                'utilisateur_id' => 1,
                'date' => '2022-07-20',
                'heure' => 'Lorem ipsum dolor sit amet',
                'poste' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
