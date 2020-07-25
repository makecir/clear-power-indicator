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
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <?php
                        echo $this->Form->control('user_detail.iidx_id',
                            ['type' => 'text']
                        );
                        echo $this->Form->control('user_detail.dj_name');
                        echo $this->Form->select('user_detail.grade_sp',$user->user_detail->grade_sp_dict);
                        echo $this->Form->select('user_detail.grade_dp',$user->user_detail->grade_dp_dict);
                        echo $this->Form->select('user_detail.arena_sp',$user->user_detail->arena_sp_dict);
                        echo $this->Form->select('user_detail.arena_dp',$user->user_detail->arena_dp_dict);
                        echo $this->Form->control('user_detail.twitter_id',
                            ['type' => 'text']
                        );
                    ?>
                </fieldset>
                <?= $this->Form->button(__('更新'),['class' => 'btn btn-primary my-auto']) ?>
                <?= $this->Form->end() ?>
            </div>

        </div>
    </div>
</div>
