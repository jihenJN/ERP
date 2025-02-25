<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArticleunitesFixture
 */
class ArticleunitesFixture extends TestFixture
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
                'unite_id' => 1,
                'formule' => 'Lorem ipsum dolor sit amet',
                'poids' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
