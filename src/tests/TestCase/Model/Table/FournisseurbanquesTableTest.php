<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FournisseurbanquesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FournisseurbanquesTable Test Case
 */
class FournisseurbanquesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FournisseurbanquesTable
     */
    protected $Fournisseurbanques;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Fournisseurbanques',
        'app.Banques',
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
        $config = $this->getTableLocator()->exists('Fournisseurbanques') ? [] : ['className' => FournisseurbanquesTable::class];
        $this->Fournisseurbanques = $this->getTableLocator()->get('Fournisseurbanques', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Fournisseurbanques);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FournisseurbanquesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FournisseurbanquesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
