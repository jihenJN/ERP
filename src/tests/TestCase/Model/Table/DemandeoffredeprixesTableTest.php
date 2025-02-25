<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DemandeoffredeprixesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DemandeoffredeprixesTable Test Case
 */
class DemandeoffredeprixesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DemandeoffredeprixesTable
     */
    protected $Demandeoffredeprixes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Demandeoffredeprixes',
        'app.Bandeconsultations',
        'app.Commandes',
        'app.Lignebandeconsultations',
        'app.Lignedemandeoffredeprixes',
        'app.Lignelignebandeconsultations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Demandeoffredeprixes') ? [] : ['className' => DemandeoffredeprixesTable::class];
        $this->Demandeoffredeprixes = $this->getTableLocator()->get('Demandeoffredeprixes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Demandeoffredeprixes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DemandeoffredeprixesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
