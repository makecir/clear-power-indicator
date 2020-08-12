<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LampChange $lampChange
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Lamp Changes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="lampChanges form content">
            <?= $this->Form->create($lampChange) ?>
            <fieldset>
                <legend><?= __('Add Lamp Change') ?></legend>
                <?php
                    echo $this->Form->control('user_history_id', ['options' => $userHistories]);
                    echo $this->Form->control('score_id', ['options' => $scores]);
                    echo $this->Form->control('before_lamp');
                    echo $this->Form->control('after_lamp');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
