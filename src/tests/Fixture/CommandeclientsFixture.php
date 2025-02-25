<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CommandeclientsFixture
 */
class CommandeclientsFixture extends TestFixture
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
                'code' => 'Lorem ips',
                'client_id' => 1,
                'date' => '2022-08-05 11:06:10',
                'datedecreation' => '2022-08-05 11:06:10',
                'commentaire' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'pointdevente_id' => 1,
                'depot_id' => 1,
                'totalht' => 1.5,
                'totalttc' => 1.5,
                'totalremise' => 1.5,
                'totaltva' => 1.5,
                'totalfodec' => 1.5,
                'cartecarburant_id' => 1,
                'materieltransport_id' => 1,
                'bonlivraison_id' => 1,
                'etatliv' => 1,
            ],
        ];
        parent::init();
    }
}
