<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserHistory $userHistory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User History'), ['action' => 'edit', $userHistory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User History'), ['action' => 'delete', $userHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userHistory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User Histories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User History'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userHistories view content">
            <h3><?= h($userHistory->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $userHistory->has('user') ? $this->Html->link($userHistory->user->id, ['controller' => 'Users', 'action' => 'view', $userHistory->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($userHistory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rating Cur') ?></th>
                    <td><?= $this->Number->format($userHistory->rating_cur) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rating Diff') ?></th>
                    <td><?= $this->Number->format($userHistory->rating_diff) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($userHistory->created_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Lamps Diff') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($userHistory->lamps_diff)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
