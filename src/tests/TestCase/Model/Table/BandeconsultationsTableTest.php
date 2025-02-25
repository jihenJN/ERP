<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BandeconsultationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BandeconsultationsTable Test Case
 */
class BandeconsultationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BandeconsultationsTable
     */
    protected $Bandeconsultations;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bandeconsultations',
        'app.Demandeoffredeprixes',
        'app.Fournisseurs',
        'app.Articles',
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
        $config = $this->getTableLocator()->exists('Bandeconsultations') ? [] : ['className' => BandeconsultationsTable::class];
        $this->Bandeconsultations = $this->getTableLocator()->get('Bandeconsultations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Bandeconsultations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BandeconsultationsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BandeconsultationsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
