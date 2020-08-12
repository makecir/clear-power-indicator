<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserHistoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserHistoriesTable Test Case
 */
class UserHistoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserHistoriesTable
     */
    protected $UserHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UserHistories',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserHistories') ? [] : ['className' => UserHistoriesTable::class];
        $this->UserHistories = $this->getTableLocator()->get('UserHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserHistories);

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
