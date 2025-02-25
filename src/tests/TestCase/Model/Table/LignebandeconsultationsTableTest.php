<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignebandeconsultationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignebandeconsultationsTable Test Case
 */
class LignebandeconsultationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignebandeconsultationsTable
     */
    protected $Lignebandeconsultations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignebandeconsultations',
        'app.Demandeoffredeprixes',
        'app.Bandeconsultations',
        'app.Lignedemandeoffredeprixes',
        'app.Fournisseurs',
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
        $config = $this->getTableLocator()->exists('Lignebandeconsultations') ? [] : ['className' => LignebandeconsultationsTable::class];
        $this->Lignebandeconsultations = $this->getTableLocator()->get('Lignebandeconsultations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignebandeconsultations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignebandeconsultationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignebandeconsultationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
