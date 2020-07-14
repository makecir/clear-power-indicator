<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserDetail[]|\Cake\Collection\CollectionInterface $userDetails
 */
?>
<div class="userDetails index content">
    <?= $this->Html->link(__('New User Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('User Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('iidx_id') ?></th>
                    <th><?= $this->Paginator->sort('dj_name') ?></th>
                    <th><?= $this->Paginator->sort('class_sp') ?></th>
                    <th><?= $this->Paginator->sort('class_dp') ?></th>
                    <th><?= $this->Paginator->sort('arena_sp') ?></th>
                    <th><?= $this->Paginator->sort('arena_dp') ?></th>
                    <th><?= $this->Paginator->sort('bio') ?></th>
                    <th><?= $this->Paginator->sort('twitter_id') ?></th>
                    <th><?= $this->Paginator->sort('rating') ?></th>
                    <th><?= $this->Paginator->sort('update_at') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('modified_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userDetails as $userDetail): ?>
                <tr>
                    <td><?= h($userDetail->user_id) ?></td>
                    <td><?= h($userDetail->iidx_id) ?></td>
                    <td><?= h($userDetail->dj_name) ?></td>
                    <td><?= $this->Number->format($userDetail->class_sp) ?></td>
                    <td><?= $this->Number->format($userDetail->class_dp) ?></td>
                    <td><?= $this->Number->format($userDetail->arena_sp) ?></td>
                    <td><?= $this->Number->format($userDetail->arena_dp) ?></td>
                    <td><?= h($userDetail->bio) ?></td>
                    <td><?= h($userDetail->twitter_id) ?></td>
                    <td><?= $this->Number->format($userDetail->rating) ?></td>
                    <td><?= h($userDetail->update_at) ?></td>
                    <td><?= h($userDetail->created_at) ?></td>
                    <td><?= h($userDetail->modified_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $userDetail->user_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userDetail->user_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userDetail->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userDetail->user_id)]) ?>
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
