<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeutilisateursTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeutilisateursTable Test Case
 */
class TypeutilisateursTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeutilisateursTable
     */
    protected $Typeutilisateurs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Typeutilisateurs',
        'app.Clients',
        'app.Fournisseurs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Typeutilisateurs') ? [] : ['className' => TypeutilisateursTable::class];
        $this->Typeutilisateurs = $this->getTableLocator()->get('Typeutilisateurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Typeutilisateurs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TypeutilisateursTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
