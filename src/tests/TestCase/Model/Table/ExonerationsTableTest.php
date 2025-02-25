<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExonerationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExonerationsTable Test Case
 */
class ExonerationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExonerationsTable
     */
    protected $Exonerations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Exonerations',
        'app.Typeexons',
        'app.Fournisseurs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Exonerations') ? [] : ['className' => ExonerationsTable::class];
        $this->Exonerations = $this->getTableLocator()->get('Exonerations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Exonerations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ExonerationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ExonerationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
