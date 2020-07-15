<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Following $following
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Following'), ['action' => 'edit', $following->follow_user_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Following'), ['action' => 'delete', $following->follow_user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $following->follow_user_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Followings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Following'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="followings view content">
            <h3><?= h($following->follow_user_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Follow User Id') ?></th>
                    <td><?= $this->Number->format($following->follow_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Followed User Id') ?></th>
                    <td><?= $this->Number->format($following->followed_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($following->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
