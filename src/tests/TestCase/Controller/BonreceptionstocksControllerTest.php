<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\BonreceptionstocksController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\BonreceptionstocksController Test Case
 *
 * @uses \App\Controller\BonreceptionstocksController
 */
class BonreceptionstocksControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bonreceptionstocks',
        'app.Pointdeventes',
        'app.Depots',
        'app.Materieltransports',
        'app.Cartecarburants',
        'app.Personnels',
        'app.Conffaieurs',
        'app.Chauffeurs',
        'app.Bondetransferts',
        'app.Lignebonreceptionstocks',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\BonreceptionstocksController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\BonreceptionstocksController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\BonreceptionstocksController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\BonreceptionstocksController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\BonreceptionstocksController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
