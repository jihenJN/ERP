<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LignedevisFixture
 */
class LignedevisFixture extends TestFixture
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
                'prix' => 1.5,
                'remise' => 1,
                'ht' => 1.5,
                'article_id' => 1,
                'devis_id' => 1,
                'qte' => 1,
            ],
        ];
        parent::init();
    }
}
