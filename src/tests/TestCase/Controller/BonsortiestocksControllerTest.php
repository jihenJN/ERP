<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\BonsortiestocksController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\BonsortiestocksController Test Case
 *
 * @uses \App\Controller\BonsortiestocksController
 */
class BonsortiestocksControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bonsortiestocks',
        'app.Pointdeventes',
        'app.Depotarrives',
        'app.Depotdeparts',
        'app.Materieltransports',
        'app.Cartecarburants',
        'app.Conffaieurs',
        'app.Chauffeurs',
        'app.Lignebonsortiestocks',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\BonsortiestocksController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\BonsortiestocksController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\BonsortiestocksController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\BonsortiestocksController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\BonsortiestocksController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
