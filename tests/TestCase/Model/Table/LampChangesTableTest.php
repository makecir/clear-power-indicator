<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LampChangesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LampChangesTable Test Case
 */
class LampChangesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LampChangesTable
     */
    protected $LampChanges;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.LampChanges',
        'app.UserHistories',
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
        $config = $this->getTableLocator()->exists('LampChanges') ? [] : ['className' => LampChangesTable::class];
        $this->LampChanges = $this->getTableLocator()->get('LampChanges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->LampChanges);

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
