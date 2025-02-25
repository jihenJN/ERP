<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaterieltransportsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaterieltransportsTable Test Case
 */
class MaterieltransportsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MaterieltransportsTable
     */
    protected $Materieltransports;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Materieltransports',
        'app.Bondetransferts',
        'app.Bonlivraisons',
        'app.Bonreceptionstocks',
        'app.Bonsortiestocks',
        'app.Commandeclients',
        'app.Commandes',
        'app.Factureclients',
        'app.Factures',
        'app.Livraisons',
        'app.Livraisonsanc',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Materieltransports') ? [] : ['className' => MaterieltransportsTable::class];
        $this->Materieltransports = $this->getTableLocator()->get('Materieltransports', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Materieltransports);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MaterieltransportsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
