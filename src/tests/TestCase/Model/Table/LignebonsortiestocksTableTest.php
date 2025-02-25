<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignebonsortiestocksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignebonsortiestocksTable Test Case
 */
class LignebonsortiestocksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignebonsortiestocksTable
     */
    protected $Lignebonsortiestocks;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignebonsortiestocks',
        'app.Bonsortiestocks',
        'app.Articles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lignebonsortiestocks') ? [] : ['className' => LignebonsortiestocksTable::class];
        $this->Lignebonsortiestocks = $this->getTableLocator()->get('Lignebonsortiestocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignebonsortiestocks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignebonsortiestocksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignebonsortiestocksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
