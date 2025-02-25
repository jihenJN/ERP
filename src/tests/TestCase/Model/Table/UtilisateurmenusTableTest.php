<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UtilisateurmenusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UtilisateurmenusTable Test Case
 */
class UtilisateurmenusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UtilisateurmenusTable
     */
    protected $Utilisateurmenus;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Utilisateurmenus',
        'app.Utilisateurs',
        'app.Menus',
        'app.Liens',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Utilisateurmenus') ? [] : ['className' => UtilisateurmenusTable::class];
        $this->Utilisateurmenus = $this->getTableLocator()->get('Utilisateurmenus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Utilisateurmenus);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UtilisateurmenusTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\UtilisateurmenusTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
