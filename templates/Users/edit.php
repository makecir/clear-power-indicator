<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="users view content">
    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <h4 class="card-title" style="display:inline;"><?= __('CPI update') ?>/<?= __('Record Playdaya') ?></h4>
        </div>
        <div class="card-body text-dark">
            <div class="text-danger">
                ※ 新作の稼働に伴う変更の調査と対応のため、10月28日から一定期間、プレイデータの登録および更新が利用できない状態になります。<br>
                ※ 調査対応期間は数日程度を予定しております。<br>
                ※ 再開はTwitterアカウント<a href="https://twitter.com/IIDX_CPI" target="_blank">@IIDX_CPI</a>で告知いたします。<br>
            </div>
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
                        echo $this->Form->control('user_detail.dj_name',['label' => 'DJ NAME', 'class' => 'form-control mb-3', 'placeholder'=>'DJNAME']);
                        echo $this->Form->control('user_detail.iidx_id',
                            ['label' => 'IIDX ID', 'class' => 'form-control mb-3', 'type' => 'text', 'placeholder'=>'XXXX-XXXX']
                        );
                    ?>
                    <div class="form-row">
                        <div class="col">
                            <label for="private-level">SP段位</label>
                            <?= $this->Form->select('user_detail.grade_sp',$user->user_detail->grade_sp_dict,['class' => 'form-control mb-3']); ?>
                        </div>
                        <div class="col">
                            <label for="private-level">DP段位</label>
                            <?= $this->Form->select('user_detail.grade_dp',$user->user_detail->grade_dp_dict,['class' => 'form-control mb-3']); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="private-level">SPアリーナ</label>
                            <?= $this->Form->select('user_detail.arena_sp',$user->user_detail->arena_sp_dict,['class' => 'form-control mb-3']); ?>
                        </div>
                        <div class="col">
                            <label for="private-level">DPアリーナ</label>
                            <?= $this->Form->select('user_detail.arena_dp',$user->user_detail->arena_dp_dict,['class' => 'form-control mb-3']); ?>
                        </div>
                    </div>
                    <?php
                        echo $this->Form->control('user_detail.twitter_id',
                            ['label' => 'Twitter ID', 'class' => 'form-control mb-3', 'type' => 'text','placeholder'=>'IIDX_CPI']
                        );
                    ?>
                </fieldset>
                <?= $this->Form->button(__('更新'),['class' => 'btn btn-primary my-auto']) ?>
                <?= $this->Form->end() ?>
            </div>

        </div>
    </div>
</div>
