<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientbanquesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientbanquesTable Test Case
 */
class ClientbanquesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientbanquesTable
     */
    protected $Clientbanques;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Clientbanques',
        'app.Banques',
        'app.Clients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Clientbanques') ? [] : ['className' => ClientbanquesTable::class];
        $this->Clientbanques = $this->getTableLocator()->get('Clientbanques', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Clientbanques);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClientbanquesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClientbanquesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
