<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PersonnelsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\PersonnelsController Test Case
 *
 * @uses \App\Controller\PersonnelsController
 */
class PersonnelsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Personnels',
        'app.Fonctions',
        'app.Sexes',
        'app.Situationfamiliales',
        'app.Typecontrats',
        'app.Pointdeventes',
        'app.Bonreceptionstocks',
        'app.Users',
        'app.Utilisateurs',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\PersonnelsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\PersonnelsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\PersonnelsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\PersonnelsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\PersonnelsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
