<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypecontactsFixture
 */
class TypecontactsFixture extends TestFixture
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
                'libelle' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
