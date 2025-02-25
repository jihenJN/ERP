<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PointdeventesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\PointdeventesController Test Case
 *
 * @uses \App\Controller\PointdeventesController
 */
class PointdeventesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Pointdeventes',
        'app.Villes',
        'app.Articles',
        'app.Bondechargements',
        'app.Bondereservations',
        'app.Bondetransferts',
        'app.Bonlivraisons',
        'app.Bonreceptionstocks',
        'app.Bonsortiestocks',
        'app.Commandeclients',
        'app.Commandes',
        'app.Depots',
        'app.Factureclients',
        'app.Factures',
        'app.Livraisons',
        'app.Livraisonsanc',
        'app.Personnels',
        'app.Users',
        'app.Utilisateurs',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\PointdeventesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\PointdeventesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\PointdeventesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\PointdeventesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\PointdeventesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
