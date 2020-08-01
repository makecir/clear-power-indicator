<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="card border-secondary mb-3">
    <div class="card-header mb-0">
        <h4 class="card-title" style="display:inline;"><?= __('Register') ?></h4>
    </div>
    <div class="card-body text-dark">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= __('Register') ?></legend>
            <?php
                echo $this->Form->control('username',['class' => 'form-control mb-3', 'placeholder'=>'User ID']);
                echo $this->Form->control('password',['class' => 'form-control mb-3', 'placeholder'=>'Password']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary my-auto']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>