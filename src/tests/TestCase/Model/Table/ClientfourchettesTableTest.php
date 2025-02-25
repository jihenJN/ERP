<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientfourchettesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientfourchettesTable Test Case
 */
class ClientfourchettesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientfourchettesTable
     */
    protected $Clientfourchettes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Clientfourchettes',
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
        $config = $this->getTableLocator()->exists('Clientfourchettes') ? [] : ['className' => ClientfourchettesTable::class];
        $this->Clientfourchettes = $this->getTableLocator()->get('Clientfourchettes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Clientfourchettes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClientfourchettesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ClientfourchettesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
