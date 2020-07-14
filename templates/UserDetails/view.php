<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserDetail $userDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User Detail'), ['action' => 'edit', $userDetail->user_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User Detail'), ['action' => 'delete', $userDetail->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userDetail->user_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userDetails view content">
            <h3><?= h($userDetail->user_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= h($userDetail->user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Iidx Id') ?></th>
                    <td><?= h($userDetail->iidx_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dj Name') ?></th>
                    <td><?= h($userDetail->dj_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bio') ?></th>
                    <td><?= h($userDetail->bio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Twitter Id') ?></th>
                    <td><?= h($userDetail->twitter_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Class Sp') ?></th>
                    <td><?= $this->Number->format($userDetail->class_sp) ?></td>
                </tr>
                <tr>
                    <th><?= __('Class Dp') ?></th>
                    <td><?= $this->Number->format($userDetail->class_dp) ?></td>
                </tr>
                <tr>
                    <th><?= __('Arena Sp') ?></th>
                    <td><?= $this->Number->format($userDetail->arena_sp) ?></td>
                </tr>
                <tr>
                    <th><?= __('Arena Dp') ?></th>
                    <td><?= $this->Number->format($userDetail->arena_dp) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rating') ?></th>
                    <td><?= $this->Number->format($userDetail->rating) ?></td>
                </tr>
                <tr>
                    <th><?= __('Update At') ?></th>
                    <td><?= h($userDetail->update_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($userDetail->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified At') ?></th>
                    <td><?= h($userDetail->modified_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
