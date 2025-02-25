<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UtilisateursFixture
 */
class UtilisateursFixture extends TestFixture
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
                'personnel_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'login' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'pointdevente_id' => 1,
                'depot_id' => 1,
                'stocknegatif' => 1,
                'notifdevis' => 1,
                'notifcaisse' => 1,
                'notifbsstock' => 1,
                'notifaffaire' => 1,
                'notifvisite' => 1,
                'modifpmp' => 1,
                'notifartdevis' => 1,
                'imp_val_inventaire' => 1,
                'imp_val_bonecart' => 1,
                'trans_vers_prod' => 1,
                'factureclient' => 1,
                'notifcommandeclient' => 1,
                'MajNumero' => 1,
            ],
        ];
        parent::init();
    }
}
