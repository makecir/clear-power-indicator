<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserLamp[]|\Cake\Collection\CollectionInterface $userLamps
 */
?>
<div class="userLamps index content">
    <?= $this->Html->link(__('New User Lamp'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('User Lamps') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('score_id') ?></th>
                    <th><?= $this->Paginator->sort('lamp') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userLamps as $userLamp): ?>
                <tr>
                    <td><?= $userLamp->has('user') ? $this->Html->link($userLamp->user->id, ['controller' => 'Users', 'action' => 'view', $userLamp->user->id]) : '' ?></td>
                    <td><?= $userLamp->has('score') ? $this->Html->link($userLamp->score->title, ['controller' => 'Scores', 'action' => 'view', $userLamp->score->id]) : '' ?></td>
                    <td><?= $this->Number->format($userLamp->lamp) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $userLamp->user_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userLamp->user_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userLamp->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userLamp->user_id)]) ?>
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
