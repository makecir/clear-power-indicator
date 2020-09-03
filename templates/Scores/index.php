<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Score[]|\Cake\Collection\CollectionInterface $scores
 */
?>
<div class="scores index content">
    <?= $this->Html->link(__('New Score'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Scores') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('version_num') ?></th>
                    <th><?= $this->Paginator->sort('level') ?></th>
                    <th><?= $this->Paginator->sort('difficulty') ?></th>
                    <th><?= $this->Paginator->sort('notes') ?></th>
                    <th><?= $this->Paginator->sort('predicted_easy_rank') ?></th>
                    <th><?= $this->Paginator->sort('predicted_clear_rank') ?></th>
                    <th><?= $this->Paginator->sort('predicted_hard_rank') ?></th>
                    <th><?= $this->Paginator->sort('predicted_exhard_rank') ?></th>
                    <th><?= $this->Paginator->sort('predicted_fc_rank') ?></th>
                    <th><?= $this->Paginator->sort('predicted_aaa_rank') ?></th>
                    <th><?= $this->Paginator->sort('is_deleted') ?></th>
                    <th><?= $this->Paginator->sort('is_rated') ?></th>
                    <th><?= $this->Paginator->sort('easy_intercept') ?></th>
                    <th><?= $this->Paginator->sort('easy_coefficient') ?></th>
                    <th><?= $this->Paginator->sort('clear_intercept') ?></th>
                    <th><?= $this->Paginator->sort('clear_coefficient') ?></th>
                    <th><?= $this->Paginator->sort('hard_intercept') ?></th>
                    <th><?= $this->Paginator->sort('hard_coefficient') ?></th>
                    <th><?= $this->Paginator->sort('exhard_intercept') ?></th>
                    <th><?= $this->Paginator->sort('exhard_coefficient') ?></th>
                    <th><?= $this->Paginator->sort('fc_intercept') ?></th>
                    <th><?= $this->Paginator->sort('fc_coefficient') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('modified_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($scores as $score): ?>
                <tr>
                    <td><?= $this->Number->format($score->id) ?></td>
                    <td><?= h($score->title) ?></td>
                    <td><?= $this->Number->format($score->version_num) ?></td>
                    <td><?= $this->Number->format($score->level) ?></td>
                    <td><?= $this->Number->format($score->difficulty) ?></td>
                    <td><?= $this->Number->format($score->notes) ?></td>
                    <td><?= $this->Number->format($score->predicted_easy_rank) ?></td>
                    <td><?= $this->Number->format($score->predicted_clear_rank) ?></td>
                    <td><?= $this->Number->format($score->predicted_hard_rank) ?></td>
                    <td><?= $this->Number->format($score->predicted_exhard_rank) ?></td>
                    <td><?= $this->Number->format($score->predicted_fc_rank) ?></td>
                    <td><?= $this->Number->format($score->predicted_aaa_rank) ?></td>
                    <td><?= $this->Number->format($score->is_deleted) ?></td>
                    <td><?= $this->Number->format($score->is_rated) ?></td>
                    <td><?= $this->Number->format($score->easy_intercept) ?></td>
                    <td><?= $this->Number->format($score->easy_coefficient) ?></td>
                    <td><?= $this->Number->format($score->clear_intercept) ?></td>
                    <td><?= $this->Number->format($score->clear_coefficient) ?></td>
                    <td><?= $this->Number->format($score->hard_intercept) ?></td>
                    <td><?= $this->Number->format($score->hard_coefficient) ?></td>
                    <td><?= $this->Number->format($score->exhard_intercept) ?></td>
                    <td><?= $this->Number->format($score->exhard_coefficient) ?></td>
                    <td><?= $this->Number->format($score->fc_intercept) ?></td>
                    <td><?= $this->Number->format($score->fc_coefficient) ?></td>
                    <td><?= h($score->created_at) ?></td>
                    <td><?= h($score->modified_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $score->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $score->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $score->id], ['confirm' => __('Are you sure you want to delete # {0}?', $score->id)]) ?>
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
