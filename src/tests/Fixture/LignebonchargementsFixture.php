<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LignebonchargementsFixture
 */
class LignebonchargementsFixture extends TestFixture
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
                'bondechargement_id' => 1,
                'article_id' => 1,
                'prix' => 1.5,
                'qte' => 1,
                'total' => 1.5,
            ],
        ];
        parent::init();
    }
}
