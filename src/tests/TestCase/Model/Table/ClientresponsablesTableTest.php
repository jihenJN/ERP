<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientresponsablesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientresponsablesTable Test Case
 */
class ClientresponsablesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientresponsablesTable
     */
    protected $Clientresponsables;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Clientresponsables',
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
        $config = $this->getTableLocator()->exists('Clientresponsables') ? [] : ['className' => ClientresponsablesTable::class];
        $this->Clientresponsables = $this->getTableLocator()->get('Clientresponsables', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Clientresponsables);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClientresponsablesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClientresponsablesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
