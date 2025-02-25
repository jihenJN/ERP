<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LignebondereservationsFixture
 */
class LignebondereservationsFixture extends TestFixture
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
                'article_id' => 1,
                'quantite' => 1,
                'bondereservation_id' => 1,
            ],
        ];
        parent::init();
    }
}
