<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LampChange $lampChange
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lamp Change'), ['action' => 'edit', $lampChange->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lamp Change'), ['action' => 'delete', $lampChange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lampChange->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lamp Changes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lamp Change'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lampChanges view content">
            <h3><?= h($lampChange->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User History') ?></th>
                    <td><?= $lampChange->has('user_history') ? $this->Html->link($lampChange->user_history->id, ['controller' => 'UserHistories', 'action' => 'view', $lampChange->user_history->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Score') ?></th>
                    <td><?= $lampChange->has('score') ? $this->Html->link($lampChange->score->title, ['controller' => 'Scores', 'action' => 'view', $lampChange->score->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($lampChange->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Before Lamp') ?></th>
                    <td><?= $this->Number->format($lampChange->before_lamp) ?></td>
                </tr>
                <tr>
                    <th><?= __('After Lamp') ?></th>
                    <td><?= $this->Number->format($lampChange->after_lamp) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
