<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BonlivraisonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BonlivraisonsTable Test Case
 */
class BonlivraisonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BonlivraisonsTable
     */
    protected $Bonlivraisons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bonlivraisons',
        'app.Clients',
        'app.Pointdeventes',
        'app.Depots',
        'app.Materieltransports',
        'app.Cartecarburants',
        'app.Factureclients',
        'app.Adresselivraisonclients',
        'app.Commandeclients',
        'app.Lignebonlivraisons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Bonlivraisons') ? [] : ['className' => BonlivraisonsTable::class];
        $this->Bonlivraisons = $this->getTableLocator()->get('Bonlivraisons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Bonlivraisons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BonlivraisonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BonlivraisonsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
