<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BondetransfertsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BondetransfertsTable Test Case
 */
class BondetransfertsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BondetransfertsTable
     */
    protected $Bondetransferts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Bondetransferts',
        'app.Pointdeventes',
        'app.Depotarrives',
        'app.Depotsorties',
        'app.Cartecarburants',
        'app.Materieltransports',
        'app.Chauffeurs',
        'app.Conffaieurs',
        'app.Bonreceptionstocks',
        'app.Bondechargements',
        'app.Lignebondetransferts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Bondetransferts') ? [] : ['className' => BondetransfertsTable::class];
        $this->Bondetransferts = $this->getTableLocator()->get('Bondetransferts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Bondetransferts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BondetransfertsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BondetransfertsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
