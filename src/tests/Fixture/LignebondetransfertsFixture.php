<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LignebondetransfertsFixture
 */
class LignebondetransfertsFixture extends TestFixture
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
                'bondetransfert_id' => 1,
                'article_id' => 1,
                'qte' => 1,
                'qteliv' => 1,
                'bondechargement_id' => 1,
            ],
        ];
        parent::init();
    }
}
