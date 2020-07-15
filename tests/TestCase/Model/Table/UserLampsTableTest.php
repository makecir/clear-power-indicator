<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserLampsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserLampsTable Test Case
 */
class UserLampsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserLampsTable
     */
    protected $UserLamps;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.UserLamps',
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('UserLamps') ? [] : ['className' => UserLampsTable::class];
        $this->UserLamps = TableRegistry::getTableLocator()->get('UserLamps', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserLamps);

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
