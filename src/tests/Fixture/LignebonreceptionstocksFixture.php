<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LignebonreceptionstocksFixture
 */
class LignebonreceptionstocksFixture extends TestFixture
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
                'bonreceptionstock_id' => 1,
                'article_id' => 1,
                'qte' => 1,
                'prix' => 1.5,
                'total' => 1.5,
            ],
        ];
        parent::init();
    }
}
