<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CommandeclientsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CommandeclientsController Test Case
 *
 * @uses \App\Controller\CommandeclientsController
 */
class CommandeclientsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Commandeclients',
        'app.Clients',
        'app.Pointdeventes',
        'app.Depots',
        'app.Cartecarburants',
        'app.Materieltransports',
        'app.Chauffeurs',
        'app.Convoyeurs',
        'app.Bonlivraisons',
        'app.Bondereservations',
        'app.Lignebonlivraisons',
        'app.Lignecommandeclients',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\CommandeclientsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\CommandeclientsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\CommandeclientsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\CommandeclientsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\CommandeclientsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
