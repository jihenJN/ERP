<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LigneinventairesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LigneinventairesTable Test Case
 */
class LigneinventairesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LigneinventairesTable
     */
    protected $Ligneinventaires;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Ligneinventaires',
        'app.Inventaires',
        'app.Articles',
        'app.Depots',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Ligneinventaires') ? [] : ['className' => LigneinventairesTable::class];
        $this->Ligneinventaires = $this->getTableLocator()->get('Ligneinventaires', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Ligneinventaires);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LigneinventairesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LigneinventairesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
