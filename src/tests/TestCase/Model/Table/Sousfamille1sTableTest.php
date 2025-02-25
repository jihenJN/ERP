<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Sousfamille1sTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Sousfamille1sTable Test Case
 */
class Sousfamille1sTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\Sousfamille1sTable
     */
    protected $Sousfamille1s;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Sousfamille1s',
        'app.Familles',
        'app.Articles',
        'app.Sousfamille2s',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Sousfamille1s') ? [] : ['className' => Sousfamille1sTable::class];
        $this->Sousfamille1s = $this->getTableLocator()->get('Sousfamille1s', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Sousfamille1s);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\Sousfamille1sTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\Sousfamille1sTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
