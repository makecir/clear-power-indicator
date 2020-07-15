<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserLamp $userLamp
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List User Lamps'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userLamps form content">
            <?= $this->Form->create($userLamp) ?>
            <fieldset>
                <legend><?= __('Add User Lamp') ?></legend>
                <?php
                    echo $this->Form->control('lamp');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
