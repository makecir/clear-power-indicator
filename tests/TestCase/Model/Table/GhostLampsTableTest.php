<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GhostLampsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GhostLampsTable Test Case
 */
class GhostLampsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GhostLampsTable
     */
    protected $GhostLamps;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.GhostLamps',
        'app.Ghosts',
        'app.Scores',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('GhostLamps') ? [] : ['className' => GhostLampsTable::class];
        $this->GhostLamps = TableRegistry::getTableLocator()->get('GhostLamps', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->GhostLamps);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
