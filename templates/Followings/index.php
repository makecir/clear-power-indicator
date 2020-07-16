<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Following[]|\Cake\Collection\CollectionInterface $followings
 */
?>
<div class="followings index content">
    <?= $this->Html->link(__('New Following'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Followings') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('follow_user_id') ?></th>
                    <th><?= $this->Paginator->sort('followed_user_id') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($followings as $following): ?>
                <tr>
                    <td><?= $this->Number->format($following->follow_user_id) ?></td>
                    <td><?= $this->Number->format($following->followed_user_id) ?></td>
                    <td><?= h($following->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $following->follow_user_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $following->follow_user_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $following->follow_user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $following->follow_user_id)]) ?>
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
