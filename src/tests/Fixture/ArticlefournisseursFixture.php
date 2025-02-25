<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArticlefournisseursFixture
 */
class ArticlefournisseursFixture extends TestFixture
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
                'fournisseur_id' => 1,
                'code' => 'Lorem ipsum dolor sit amet',
                'prix' => 1.5,
                'article_id' => 1,
            ],
        ];
        parent::init();
    }
}
