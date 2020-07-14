<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserDetail $userDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List User Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userDetails form content">
            <?= $this->Form->create($userDetail) ?>
            <fieldset>
                <legend><?= __('Add User Detail') ?></legend>
                <?php
                    echo $this->Form->control('iidx_id');
                    echo $this->Form->control('dj_name');
                    echo $this->Form->control('class_sp');
                    echo $this->Form->control('class_dp');
                    echo $this->Form->control('arena_sp');
                    echo $this->Form->control('arena_dp');
                    echo $this->Form->control('bio');
                    echo $this->Form->control('twitter_id');
                    echo $this->Form->control('rating');
                    echo $this->Form->control('update_at');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('modified_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
