<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FourchesFixture
 */
class FourchesFixture extends TestFixture
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
                'min' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'max' => 1,
            ],
        ];
        parent::init();
    }
}
