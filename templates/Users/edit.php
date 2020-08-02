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
            <h5 class="card-title" style="display:inline;">以下の2つのどちらかの方法でプレイデータを登録可能です</h5>
            <p class="card-text">
                ※ スコアを登録すると自動的にCPが更新されます</br>
                ※ 公式のプレミアムコース登録が必要です
            </p>
            <div class="row">
                <div class="card col-md-5 m-3">
                    <div class="mb-1 mt-1">
                        <p>①テキスト（スマホ向け）</p>
                        <?= $this->Form->create(null, ['style' => "display:inline-block"]); ?>
                        <div style='float:left;' class="mr-1">
                        <?= $this->Form->control('upload-text', ['type' => 'textarea','class'=>"textlines form-control mb-3",'placeholder'=>'プレイデータ貼り付け','label' => '','style' => "float:left;"]); ?>
                        </div>
                        <div style='float:left;' class="mr-1">
                        <span class="submit"><input type="submit" id="upload-playtext" class="btn btn-primary my-auto my-auto" value="テキスト読み込み"></span>
                        </div>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
                <div class="card col-md-5 m-3">
                    <div class="mb-1 mt-1">
                        <p>②CSVアップロード</p>
                        <?php echo $this->Form->create($csvform, ['type' => 'file', 'style' => "display:inline-block"]); ?>
                        <label class="btn btn-secondary my-auto" style="display:inline-block">
                        <span id="imported-filename">CSV選択</span>
                        <span style="display:none;">
                            <?php echo $this->Form->control('upload-csv', ['type' => 'file', 'accept' => '.csv', 'label' => '', 'style'=>"display:none;"]); ?>
                        </span>
                        </label>
                        <span class="submit"><input type="submit" id="submit-csv" class="btn btn-primary my-auto" value="アップロード" style="display:none;"></span>
                        <?php
                            echo $this->Form->end();
                        ?>
                    </div>
                </div>
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
                        echo $this->Form->control('user_detail.iidx_id',
                            ['class' => 'form-control mb-3', 'type' => 'text', 'placeholder'=>'XXXX-XXXX']
                        );
                        echo $this->Form->control('user_detail.dj_name',['class' => 'form-control mb-3', 'placeholder'=>'DJNAME']);
                        echo $this->Form->select('user_detail.grade_sp',$user->user_detail->grade_sp_dict,['class' => 'form-control mb-3']);
                        echo $this->Form->select('user_detail.grade_dp',$user->user_detail->grade_dp_dict,['class' => 'form-control mb-3']);
                        echo $this->Form->select('user_detail.arena_sp',$user->user_detail->arena_sp_dict,['class' => 'form-control mb-3']);
                        echo $this->Form->select('user_detail.arena_dp',$user->user_detail->arena_dp_dict,['class' => 'form-control mb-3']);
                        echo $this->Form->control('user_detail.twitter_id',
                            ['class' => 'form-control mb-3', 'type' => 'text','placeholder'=>'IIDX_CPI']
                        );
                    ?>
                </fieldset>
                <?= $this->Form->button(__('更新'),['class' => 'btn btn-primary my-auto']) ?>
                <?= $this->Form->end() ?>
            </div>

        </div>
    </div>
</div>
