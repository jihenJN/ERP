<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdresselivraisonclientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdresselivraisonclientsTable Test Case
 */
class AdresselivraisonclientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AdresselivraisonclientsTable
     */
    protected $Adresselivraisonclients;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Adresselivraisonclients',
        'app.Clients',
        'app.Bonlivraisons',
        'app.Factureclients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Adresselivraisonclients') ? [] : ['className' => AdresselivraisonclientsTable::class];
        $this->Adresselivraisonclients = $this->getTableLocator()->get('Adresselivraisonclients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Adresselivraisonclients);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AdresselivraisonclientsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AdresselivraisonclientsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
