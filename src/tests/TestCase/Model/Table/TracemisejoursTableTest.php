<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TracemisejoursTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TracemisejoursTable Test Case
 */
class TracemisejoursTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TracemisejoursTable
     */
    protected $Tracemisejours;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Tracemisejours',
        'app.Utilisateurs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tracemisejours') ? [] : ['className' => TracemisejoursTable::class];
        $this->Tracemisejours = $this->getTableLocator()->get('Tracemisejours', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tracemisejours);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TracemisejoursTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TracemisejoursTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
