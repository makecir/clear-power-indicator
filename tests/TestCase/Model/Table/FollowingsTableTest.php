<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FollowingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FollowingsTable Test Case
 */
class FollowingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FollowingsTable
     */
    protected $Followings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Followings',
        'app.FollowUsers',
        'app.FollowedUsers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Followings') ? [] : ['className' => FollowingsTable::class];
        $this->Followings = TableRegistry::getTableLocator()->get('Followings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Followings);

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
