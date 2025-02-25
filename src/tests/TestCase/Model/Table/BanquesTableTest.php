<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BanquesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BanquesTable Test Case
 */
class BanquesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BanquesTable
     */
    protected $Banques;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Banques',
        'app.Clientbanques',
        'app.Fournisseurbanques',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Banques') ? [] : ['className' => BanquesTable::class];
        $this->Banques = $this->getTableLocator()->get('Banques', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Banques);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BanquesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
