<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FourchesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FourchesTable Test Case
 */
class FourchesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FourchesTable
     */
    protected $Fourches;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Fourches',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Fourches') ? [] : ['className' => FourchesTable::class];
        $this->Fourches = $this->getTableLocator()->get('Fourches', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Fourches);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FourchesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
