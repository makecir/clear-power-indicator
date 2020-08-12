<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserHistory $userHistory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userHistory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userHistory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List User Histories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userHistories form content">
            <?= $this->Form->create($userHistory) ?>
            <fieldset>
                <legend><?= __('Edit User History') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('rating_cur');
                    echo $this->Form->control('rating_diff');
                    echo $this->Form->control('lamps_diff');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
