<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\Sousfamille2sController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Sousfamille2sController Test Case
 *
 * @uses \App\Controller\Sousfamille2sController
 */
class Sousfamille2sControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Sousfamille2s',
        'app.Sousfamille1s',
        'app.Articles',
        'app.Sousfamille3s',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\Sousfamille2sController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\Sousfamille2sController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\Sousfamille2sController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\Sousfamille2sController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\Sousfamille2sController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
