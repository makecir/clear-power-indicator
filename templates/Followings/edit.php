<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Following $following
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $following->follow_user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $following->follow_user_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Followings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="followings form content">
            <?= $this->Form->create($following) ?>
            <fieldset>
                <legend><?= __('Edit Following') ?></legend>
                <?php
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
