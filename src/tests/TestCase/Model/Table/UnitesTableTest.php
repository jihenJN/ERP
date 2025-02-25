<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UnitesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UnitesTable Test Case
 */
class UnitesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UnitesTable
     */
    protected $Unites;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Unites',
        'app.Articles',
        'app.Articleunites',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Unites') ? [] : ['className' => UnitesTable::class];
        $this->Unites = $this->getTableLocator()->get('Unites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Unites);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UnitesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
