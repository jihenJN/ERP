<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\BondetransfertsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\BondetransfertsController Test Case
 *
 * @uses \App\Controller\BondetransfertsController
 */
class BondetransfertsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bondetransferts',
        'app.Pointdeventes',
        'app.Depotarrives',
        'app.Depotsorties',
        'app.Cartecarburants',
        'app.Materieltransports',
        'app.Chauffeurs',
        'app.Conffaieurs',
        'app.Bonreceptionstocks',
        'app.Bondechargements',
        'app.Lignebondetransferts',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\BondetransfertsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\BondetransfertsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\BondetransfertsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\BondetransfertsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\BondetransfertsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
