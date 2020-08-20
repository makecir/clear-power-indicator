<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserHistory[]|\Cake\Collection\CollectionInterface $userHistories
 */
?>
<div class="userHistories index content">
    <?= $this->Html->link(__('New User History'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('User Histories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('rating_cur') ?></th>
                    <th><?= $this->Paginator->sort('rating_diff') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userHistories as $userHistory): ?>
                <tr>
                    <td><?= $this->Number->format($userHistory->id) ?></td>
                    <td><?= $userHistory->has('user') ? $this->Html->link($userHistory->user->id, ['controller' => 'Users', 'action' => 'view', $userHistory->user->id]) : '' ?></td>
                    <td><?= $this->Number->format($userHistory->rating_cur) ?></td>
                    <td><?= $this->Number->format($userHistory->rating_diff) ?></td>
                    <td><?= h($userHistory->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $userHistory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userHistory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userHistory->id)]) ?>
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
