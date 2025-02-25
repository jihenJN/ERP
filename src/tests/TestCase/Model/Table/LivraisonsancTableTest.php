<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LivraisonsancTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LivraisonsancTable Test Case
 */
class LivraisonsancTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LivraisonsancTable
     */
    protected $Livraisonsanc;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Livraisonsanc',
        'app.Commandes',
        'app.Fournisseurs',
        'app.Pointdeventes',
        'app.Depots',
        'app.Cartecarburants',
        'app.Materieltransports',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Livraisonsanc') ? [] : ['className' => LivraisonsancTable::class];
        $this->Livraisonsanc = $this->getTableLocator()->get('Livraisonsanc', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Livraisonsanc);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LivraisonsancTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LivraisonsancTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
