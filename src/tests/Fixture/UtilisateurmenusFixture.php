<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UtilisateurmenusFixture
 */
class UtilisateurmenusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'utilisateurmenus';
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
                'utilisateur_id' => 1,
                'menu_id' => 1,
            ],
        ];
        parent::init();
    }
}
