<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Sousfamille3sTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Sousfamille3sTable Test Case
 */
class Sousfamille3sTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\Sousfamille3sTable
     */
    protected $Sousfamille3s;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Sousfamille3s',
        'app.Sousfamille2s',
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
        $config = $this->getTableLocator()->exists('Sousfamille3s') ? [] : ['className' => Sousfamille3sTable::class];
        $this->Sousfamille3s = $this->getTableLocator()->get('Sousfamille3s', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Sousfamille3s);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\Sousfamille3sTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\Sousfamille3sTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
