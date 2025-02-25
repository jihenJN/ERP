<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivitesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivitesTable Test Case
 */
class ActivitesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivitesTable
     */
    protected $Activites;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Activites',
        'app.Clients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Activites') ? [] : ['className' => ActivitesTable::class];
        $this->Activites = $this->getTableLocator()->get('Activites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Activites);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ActivitesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
