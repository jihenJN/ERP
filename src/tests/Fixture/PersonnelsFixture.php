<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PersonnelsFixture
 */
class PersonnelsFixture extends TestFixture
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
                'fonction_id' => 1,
                'nom' => 'Lorem ipsum dolor sit amet',
                'prenom' => 'Lorem ipsum dolor sit amet',
                'code' => 'Lorem ipsum dolor sit amet',
                'sexe_id' => 1,
                'dateentre' => '2022-07-20',
                'situationfamiliale_id' => 1,
                'nombreenfant' => 1,
                'matriculecnss' => 'Lorem ipsum dolor sit amet',
                'age' => 1,
                'chefdefamille' => 'Lorem ipsum dolor sit amet',
                'typecontrat_id' => 1,
                'pointdevente_id' => 1,
            ],
        ];
        parent::init();
    }
}
