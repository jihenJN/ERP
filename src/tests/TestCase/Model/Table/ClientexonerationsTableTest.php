<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientexonerationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientexonerationsTable Test Case
 */
class ClientexonerationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientexonerationsTable
     */
    protected $Clientexonerations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Clientexonerations',
        'app.Typeexons',
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
        $config = $this->getTableLocator()->exists('Clientexonerations') ? [] : ['className' => ClientexonerationsTable::class];
        $this->Clientexonerations = $this->getTableLocator()->get('Clientexonerations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Clientexonerations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClientexonerationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClientexonerationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
