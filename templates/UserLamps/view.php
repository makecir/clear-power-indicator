<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserLamp $userLamp
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User Lamp'), ['action' => 'edit', $userLamp->user_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User Lamp'), ['action' => 'delete', $userLamp->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userLamp->user_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List User Lamps'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User Lamp'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userLamps view content">
            <h3><?= h($userLamp->user_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $userLamp->has('user') ? $this->Html->link($userLamp->user->id, ['controller' => 'Users', 'action' => 'view', $userLamp->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Score') ?></th>
                    <td><?= $userLamp->has('score') ? $this->Html->link($userLamp->score->title, ['controller' => 'Scores', 'action' => 'view', $userLamp->score->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Lamp') ?></th>
                    <td><?= $this->Number->format($userLamp->lamp) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
