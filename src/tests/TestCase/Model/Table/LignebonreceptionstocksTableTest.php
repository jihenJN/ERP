<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignebonreceptionstocksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignebonreceptionstocksTable Test Case
 */
class LignebonreceptionstocksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignebonreceptionstocksTable
     */
    protected $Lignebonreceptionstocks;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignebonreceptionstocks',
        'app.Bonreceptionstocks',
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
        $config = $this->getTableLocator()->exists('Lignebonreceptionstocks') ? [] : ['className' => LignebonreceptionstocksTable::class];
        $this->Lignebonreceptionstocks = $this->getTableLocator()->get('Lignebonreceptionstocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignebonreceptionstocks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignebonreceptionstocksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignebonreceptionstocksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
