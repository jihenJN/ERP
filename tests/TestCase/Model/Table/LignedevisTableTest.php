<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignedevisTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignedevisTable Test Case
 */
class LignedevisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignedevisTable
     */
    protected $Lignedevis;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignedevis',
        'app.Articles',
        'app.Devis',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lignedevis') ? [] : ['className' => LignedevisTable::class];
        $this->Lignedevis = $this->getTableLocator()->get('Lignedevis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignedevis);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignedevisTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignedevisTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
