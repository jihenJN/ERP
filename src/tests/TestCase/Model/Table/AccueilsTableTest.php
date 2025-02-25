<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AccueilsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AccueilsTable Test Case
 */
class AccueilsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AccueilsTable
     */
    protected $Accueils;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Accueils',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Accueils') ? [] : ['className' => AccueilsTable::class];
        $this->Accueils = $this->getTableLocator()->get('Accueils', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Accueils);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AccueilsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
