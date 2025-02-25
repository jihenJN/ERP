<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FournisseurresponsablesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FournisseurresponsablesTable Test Case
 */
class FournisseurresponsablesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FournisseurresponsablesTable
     */
    protected $Fournisseurresponsables;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Fournisseurresponsables',
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
        $config = $this->getTableLocator()->exists('Fournisseurresponsables') ? [] : ['className' => FournisseurresponsablesTable::class];
        $this->Fournisseurresponsables = $this->getTableLocator()->get('Fournisseurresponsables', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Fournisseurresponsables);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FournisseurresponsablesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FournisseurresponsablesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
