<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LiensFixture
 */
class LiensFixture extends TestFixture
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
                'utilisateurmenu_id' => 1,
                'lien' => 'Lorem ipsum dolor sit amet',
                'add' => 'Lorem ipsum dolor sit amet',
                'edit' => 'Lorem ipsum dolor sit amet',
                'delete' => 'Lorem ipsum dolor sit amet',
                'imprimer' => 'Lorem ipsum dolor sit amet',
                'valide' => 1,
            ],
        ];
        parent::init();
    }
}
