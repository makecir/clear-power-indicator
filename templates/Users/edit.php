<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="users view content">
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="card-title" style="display:inline;"><?= __('CP update') ?> / <?= __('Record Playdaya') ?></h4>
        </div>
        <div class="card-body text-dark">
            
        </div>
    </div>
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="card-title" style="display:inline;"><?= __('Player edit') ?></h4>
        </div>
        <div class="card-body text-dark">
            
            <div class="userDetails form content">
                <?= $this->Form->create($user->user_detail) ?>
                <fieldset>
                    <?php
                        echo $this->Form->control('iidx_id');
                        echo $this->Form->control('dj_name');
                        echo $this->Form->control('grade_sp');
                        echo $this->Form->control('grade_dp');
                        echo $this->Form->control('arena_sp');
                        echo $this->Form->control('arena_dp');
                        echo $this->Form->control('twitter_id');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('更新'),['class' => 'btn btn-primary my-auto']) ?>
                <?= $this->Form->end() ?>
            </div>

        </div>
    </div>
</div>
