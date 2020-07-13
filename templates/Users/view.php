<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= h($user->password) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($user->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified At') ?></th>
                    <td><?= h($user->modified_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related User Detail') ?></h4>
                <?php if (!empty($user->user_detail)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Iidx Id') ?></th>
                            <th><?= __('Class Sp') ?></th>
                            <th><?= __('Class Dp') ?></th>
                            <th><?= __('Arena Sp') ?></th>
                            <th><?= __('Arena Dp') ?></th>
                            <th><?= __('Bio') ?></th>
                            <th><?= __('Twitter Id') ?></th>
                            <th><?= __('Rating') ?></th>
                            <th><?= __('Update At') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Modified At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->user_detail as $userDetail) : ?>
                        <tr>
                            <td><?= h($userDetail->id) ?></td>
                            <td><?= h($userDetail->user_id) ?></td>
                            <td><?= h($userDetail->iidx_id) ?></td>
                            <td><?= h($userDetail->class_sp) ?></td>
                            <td><?= h($userDetail->class_dp) ?></td>
                            <td><?= h($userDetail->arena_sp) ?></td>
                            <td><?= h($userDetail->arena_dp) ?></td>
                            <td><?= h($userDetail->bio) ?></td>
                            <td><?= h($userDetail->twitter_id) ?></td>
                            <td><?= h($userDetail->rating) ?></td>
                            <td><?= h($userDetail->update_at) ?></td>
                            <td><?= h($userDetail->created_at) ?></td>
                            <td><?= h($userDetail->modified_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserDetail', 'action' => 'view', $userDetail->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserDetail', 'action' => 'edit', $userDetail->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserDetail', 'action' => 'delete', $userDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userDetail->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
