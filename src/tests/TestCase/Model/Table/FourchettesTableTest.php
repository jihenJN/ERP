<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FourchettesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FourchettesTable Test Case
 */
class FourchettesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FourchettesTable
     */
    protected $Fourchettes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Fourchettes',
        'app.Clients',
        'app.Fourches',
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
        $config = $this->getTableLocator()->exists('Fourchettes') ? [] : ['className' => FourchettesTable::class];
        $this->Fourchettes = $this->getTableLocator()->get('Fourchettes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Fourchettes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FourchettesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FourchettesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
