<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Score $score
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Score'), ['action' => 'edit', $score->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Score'), ['action' => 'delete', $score->id], ['confirm' => __('Are you sure you want to delete # {0}?', $score->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Scores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Score'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="scores view content">
            <h3><?= h($score->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($score->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($score->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Version Num') ?></th>
                    <td><?= $this->Number->format($score->version_num) ?></td>
                </tr>
                <tr>
                    <th><?= __('Level') ?></th>
                    <td><?= $this->Number->format($score->level) ?></td>
                </tr>
                <tr>
                    <th><?= __('Difficulty') ?></th>
                    <td><?= $this->Number->format($score->difficulty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Notes') ?></th>
                    <td><?= $this->Number->format($score->notes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Predicted Easy Rank') ?></th>
                    <td><?= $this->Number->format($score->predicted_easy_rank) ?></td>
                </tr>
                <tr>
                    <th><?= __('Predicted Clear Rank') ?></th>
                    <td><?= $this->Number->format($score->predicted_clear_rank) ?></td>
                </tr>
                <tr>
                    <th><?= __('Predicted Hard Rank') ?></th>
                    <td><?= $this->Number->format($score->predicted_hard_rank) ?></td>
                </tr>
                <tr>
                    <th><?= __('Predicted Exhard Rank') ?></th>
                    <td><?= $this->Number->format($score->predicted_exhard_rank) ?></td>
                </tr>
                <tr>
                    <th><?= __('Predicted Fc Rank') ?></th>
                    <td><?= $this->Number->format($score->predicted_fc_rank) ?></td>
                </tr>
                <tr>
                    <th><?= __('Predicted Aaa Rank') ?></th>
                    <td><?= $this->Number->format($score->predicted_aaa_rank) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Deleted') ?></th>
                    <td><?= $this->Number->format($score->is_deleted) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Rated') ?></th>
                    <td><?= $this->Number->format($score->is_rated) ?></td>
                </tr>
                <tr>
                    <th><?= __('Easy Intercept') ?></th>
                    <td><?= $this->Number->format($score->easy_intercept) ?></td>
                </tr>
                <tr>
                    <th><?= __('Easy Coefficient') ?></th>
                    <td><?= $this->Number->format($score->easy_coefficient) ?></td>
                </tr>
                <tr>
                    <th><?= __('Clear Intercept') ?></th>
                    <td><?= $this->Number->format($score->clear_intercept) ?></td>
                </tr>
                <tr>
                    <th><?= __('Clear Coefficient') ?></th>
                    <td><?= $this->Number->format($score->clear_coefficient) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hard Intercept') ?></th>
                    <td><?= $this->Number->format($score->hard_intercept) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hard Coefficient') ?></th>
                    <td><?= $this->Number->format($score->hard_coefficient) ?></td>
                </tr>
                <tr>
                    <th><?= __('Exhard Intercept') ?></th>
                    <td><?= $this->Number->format($score->exhard_intercept) ?></td>
                </tr>
                <tr>
                    <th><?= __('Exhard Coefficient') ?></th>
                    <td><?= $this->Number->format($score->exhard_coefficient) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fc Intercept') ?></th>
                    <td><?= $this->Number->format($score->fc_intercept) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fc Coefficient') ?></th>
                    <td><?= $this->Number->format($score->fc_coefficient) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($score->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified At') ?></th>
                    <td><?= h($score->modified_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($score->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Modified At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($score->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->username) ?></td>
                            <td><?= h($users->password) ?></td>
                            <td><?= h($users->email) ?></td>
                            <td><?= h($users->created_at) ?></td>
                            <td><?= h($users->modified_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
