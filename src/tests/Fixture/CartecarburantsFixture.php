<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CartecarburantsFixture
 */
class CartecarburantsFixture extends TestFixture
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
                'num' => 'Lorem ipsum dolor sit amet',
                'motdepasse' => 'Lorem ipsum dolor sit amet',
                'typekiosque' => 'Lorem ipsum dolor sit amet',
                'typecartecarburant_id' => 1,
            ],
        ];
        parent::init();
    }
}
