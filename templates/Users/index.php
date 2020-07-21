<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index content">
    <div class="card border-secondary mb-3">
        <div class="card-header" role="tab" id="headingOne">
            <h5 class="mb-0">
                <?= __('Users') ?>
            </h5>
        </div>
        <div class="card-body text-dark">
            <div class="table-responsive">
                <table id="users-index" class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?= __('id') ?></th>
                            <th><?= __('username') ?></th>
                            <th><?= __('IIDX ID') ?></th>
                            <th><?= __('DJ NAME') ?></th>
                            <th><?= __('Class Sp') ?></th>
                            <th><?= __('created_at') ?></th>
                            <th><?= __('modified_at') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Number->format($user->id) ?></td>
                            <td><?= h($user->username) ?></td>
                            <td><?= h($user->user_detail->iidx_id) ?></td>
                            <td><?= h($user->user_detail->dj_name) ?></td>
                            <td><?= h($user->user_detail->sp_class_info) ?></td>
                            <td><?= h($user->created_at) ?></td>
                            <td><?= h($user->modified_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
