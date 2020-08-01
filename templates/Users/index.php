<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index content">
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="mb-0">
                <?= __('Users') ?>
            </h4>
        </div>
        <div class="card-body text-dark">
            <div class="table-responsive">
                <table id="users-index" class="table table-hover">
                    <thead>
                        <tr>
                            <th><?= __('DJ NAME') ?></th>
                            <th><?= __('IIDX ID') ?></th>
                            <th><?= __('CP') ?></th>
                            <th><?= __('Grade Sp') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Html->link($user->user_detail->dj_name, ['action' => 'view', $user->id]) ?></td>
                            <td><?= h($user->user_detail->iidx_id) ?></td>
                            <td><?= h($user->user_detail->rating) ?></td>
                            <td><?= h($user->user_detail->grade_sp_info) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
