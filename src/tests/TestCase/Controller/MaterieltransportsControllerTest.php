<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\MaterieltransportsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\MaterieltransportsController Test Case
 *
 * @uses \App\Controller\MaterieltransportsController
 */
class MaterieltransportsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Materieltransports',
        'app.Bondetransferts',
        'app.Bonlivraisons',
        'app.Bonreceptionstocks',
        'app.Bonsortiestocks',
        'app.Commandeclients',
        'app.Commandes',
        'app.Factureclients',
        'app.Factures',
        'app.Livraisons',
        'app.Livraisonsanc',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\MaterieltransportsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\MaterieltransportsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\MaterieltransportsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\MaterieltransportsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\MaterieltransportsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
