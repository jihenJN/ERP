<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FactureclientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FactureclientsTable Test Case
 */
class FactureclientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FactureclientsTable
     */
    protected $Factureclients;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Factureclients',
        'app.Clients',
        'app.Pointdeventes',
        'app.Depots',
        'app.Materieltransports',
        'app.Cartecarburants',
        'app.Adresselivraisonclients',
        'app.Bonlivraisons',
        'app.Lignefactureclients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Factureclients') ? [] : ['className' => FactureclientsTable::class];
        $this->Factureclients = $this->getTableLocator()->get('Factureclients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Factureclients);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FactureclientsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FactureclientsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
