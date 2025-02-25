<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdresselivraisonfournisseursTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdresselivraisonfournisseursTable Test Case
 */
class AdresselivraisonfournisseursTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AdresselivraisonfournisseursTable
     */
    protected $Adresselivraisonfournisseurs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Adresselivraisonfournisseurs',
        'app.Fournisseurs',
        'app.Factures',
        'app.Livraisons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Adresselivraisonfournisseurs') ? [] : ['className' => AdresselivraisonfournisseursTable::class];
        $this->Adresselivraisonfournisseurs = $this->getTableLocator()->get('Adresselivraisonfournisseurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Adresselivraisonfournisseurs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AdresselivraisonfournisseursTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AdresselivraisonfournisseursTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
