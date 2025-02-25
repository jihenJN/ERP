<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InventairesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InventairesTable Test Case
 */
class InventairesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InventairesTable
     */
    protected $Inventaires;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Inventaires',
        'app.Depots',
        'app.Exercices',
        'app.Ligneinventaires',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Inventaires') ? [] : ['className' => InventairesTable::class];
        $this->Inventaires = $this->getTableLocator()->get('Inventaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Inventaires);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\InventairesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\InventairesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
