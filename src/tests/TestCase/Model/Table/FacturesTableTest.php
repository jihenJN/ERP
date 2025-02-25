<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacturesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacturesTable Test Case
 */
class FacturesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FacturesTable
     */
    protected $Factures;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Factures',
        'app.Livraisons',
        'app.Fournisseurs',
        'app.Pointdeventes',
        'app.Depots',
        'app.Cartecarburants',
        'app.Materieltransports',
        'app.Adresselivraisonfournisseurs',
        'app.Lignefactures',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Factures') ? [] : ['className' => FacturesTable::class];
        $this->Factures = $this->getTableLocator()->get('Factures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Factures);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FacturesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FacturesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
