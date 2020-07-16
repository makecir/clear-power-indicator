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
            <?= $this->Html->link(__('List Scores'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="scores form content">
            <?= $this->Form->create($score) ?>
            <fieldset>
                <legend><?= __('Add Score') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('version_num');
                    echo $this->Form->control('level');
                    echo $this->Form->control('difficulty');
                    echo $this->Form->control('notes');
                    echo $this->Form->control('predicted_easy_rank');
                    echo $this->Form->control('predicted_clear_rank');
                    echo $this->Form->control('predicted_hard_rank');
                    echo $this->Form->control('predicted_exhard_rank');
                    echo $this->Form->control('predicted_fc_rank');
                    echo $this->Form->control('predicted_aaa_rank');
                    echo $this->Form->control('is_deleted');
                    echo $this->Form->control('is_rated');
                    echo $this->Form->control('easy_intercept');
                    echo $this->Form->control('easy_coefficient');
                    echo $this->Form->control('clear_intercept');
                    echo $this->Form->control('clear_coefficient');
                    echo $this->Form->control('hard_intercept');
                    echo $this->Form->control('hard_coefficient');
                    echo $this->Form->control('exhard_intercept');
                    echo $this->Form->control('exhard_coefficient');
                    echo $this->Form->control('fc_intercept');
                    echo $this->Form->control('fc_coefficient');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('modified_at');
                    echo $this->Form->control('users._ids', ['options' => $users]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
