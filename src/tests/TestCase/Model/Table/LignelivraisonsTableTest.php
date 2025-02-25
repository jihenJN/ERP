<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LignelivraisonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LignelivraisonsTable Test Case
 */
class LignelivraisonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LignelivraisonsTable
     */
    protected $Lignelivraisons;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Lignelivraisons',
        'app.Livraisons',
        'app.Commandes',
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
        $config = $this->getTableLocator()->exists('Lignelivraisons') ? [] : ['className' => LignelivraisonsTable::class];
        $this->Lignelivraisons = $this->getTableLocator()->get('Lignelivraisons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lignelivraisons);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LignelivraisonsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LignelivraisonsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
