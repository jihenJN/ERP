<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LivraisonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LivraisonsTable Test Case
 */
class LivraisonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LivraisonsTable
     */
    protected $Livraisons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Livraisons',
        'app.Commandes',
        'app.Fournisseurs',
        'app.Adresselivraisonfournisseurs',
        'app.Pointdeventes',
        'app.Depots',
        'app.Cartecarburants',
        'app.Materieltransports',
        'app.Factures',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Livraisons') ? [] : ['className' => LivraisonsTable::class];
        $this->Livraisons = $this->getTableLocator()->get('Livraisons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Livraisons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LivraisonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LivraisonsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
