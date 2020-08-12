<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LampChange[]|\Cake\Collection\CollectionInterface $lampChanges
 */
?>
<div class="lampChanges index content">
    <?= $this->Html->link(__('New Lamp Change'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Lamp Changes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_history_id') ?></th>
                    <th><?= $this->Paginator->sort('score_id') ?></th>
                    <th><?= $this->Paginator->sort('before_lamp') ?></th>
                    <th><?= $this->Paginator->sort('after_lamp') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lampChanges as $lampChange): ?>
                <tr>
                    <td><?= $this->Number->format($lampChange->id) ?></td>
                    <td><?= $lampChange->has('user_history') ? $this->Html->link($lampChange->user_history->id, ['controller' => 'UserHistories', 'action' => 'view', $lampChange->user_history->id]) : '' ?></td>
                    <td><?= $lampChange->has('score') ? $this->Html->link($lampChange->score->title, ['controller' => 'Scores', 'action' => 'view', $lampChange->score->id]) : '' ?></td>
                    <td><?= $this->Number->format($lampChange->before_lamp) ?></td>
                    <td><?= $this->Number->format($lampChange->after_lamp) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $lampChange->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lampChange->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lampChange->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lampChange->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
