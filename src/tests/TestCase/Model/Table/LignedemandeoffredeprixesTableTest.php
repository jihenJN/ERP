<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignedemandeoffredeprixesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignedemandeoffredeprixesTable Test Case
 */
class LignedemandeoffredeprixesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignedemandeoffredeprixesTable
     */
    protected $Lignedemandeoffredeprixes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignedemandeoffredeprixes',
        'app.Demandeoffredeprixes',
        'app.Articles',
        'app.Fournisseurs',
        'app.Lignebandeconsultations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lignedemandeoffredeprixes') ? [] : ['className' => LignedemandeoffredeprixesTable::class];
        $this->Lignedemandeoffredeprixes = $this->getTableLocator()->get('Lignedemandeoffredeprixes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignedemandeoffredeprixes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignedemandeoffredeprixesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignedemandeoffredeprixesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
