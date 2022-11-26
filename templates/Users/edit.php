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
            <?php if(false): ?>
                <div class="text-danger">
                    ※ 新作の稼働に伴う変更の調査と対応のため、10月13日から一定期間、プレイデータの登録および更新が利用できない状態になります。<br>
                    ※ 調査対応期間は数日程度を予定しております。<br>
                    ※ 再開はTwitterアカウント<a href="https://twitter.com/IIDX_CPI" target="_blank">@IIDX_CPI</a>で告知いたします。<br>
                </div>
            <?php else: ?>
                <div class="pb-3">
                    <h5 class="card-title" style="display:inline;">スコアを登録すると自動的にCPIが更新されます</h5>
                    <p class="card-text">
                        <ul class="list">
                            <li>プレイデータのテキストまたはCSVのダウンロードは<a href="https://p.eagate.573.jp/game/2dx/30/djdata/score_download.html?style=SP" target="_blank">こちら</a>から</li>
                            <li>方法の詳しい説明は
                                <?= $this->Html->link(
                                    'スコア登録方法',
                                    ['controller' => 'Pages', 'action' => 'about', '#'=>'how-to-update'],
                                )?>
                                をご覧ください</li>
                            <li><font color="#d9534f">算出に30秒程度要します</font> ゆっくりお待ちください</li>
                        </ul>
                    </p>
                </div>
                <h5 class="card-title">以下の2つのどちらかの方法でプレイデータを登録可能です</h5>
                <div class="row mb-3">
                    <div class="card col-md-5 m-3">
                        <p>①テキスト（スマホ向け）</p>
                        <div class="mb-1 mt-1 text-center">
                            <?= $this->Form->create(null, ['style' => "display:inline-block"]); ?>
                            <div style='float:left;' class="mr-1">
                                <?= $this->Form->control('upload-text', ['type' => 'textarea','class'=>"textlines form-control mb-3",'placeholder'=>'プレイデータ貼り付け','label' => '','style' => "float:left;width: 200px;"]); ?>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary my-auto" type="submit" id="upload-playtext">テキスト読み込み <i id="text-sub-icon" class="fas fa-sync"></i></button>
                            </div>
                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                    <div class="card col-md-5 m-3">
                        <div class="mb-1 mt-1">
                        <div id="drop-zone">
                            <p>②CSVアップロード</p>
                            <div class="mb-1 mt-2 text-center">
                                <?= $this->Form->create($csvform, ['type' => 'file', 'style' => "display:inline-block"]); ?>
                                <label class="btn btn-outline-secondary my-auto" style="display:inline-block">
                                    <span id="imported-filename">CSV選択またはドロップ</span>
                                    <span style="display:none;">
                                        <?= $this->Form->control('upload-csv', ['type' => 'file', 'accept' => '.csv', 'label' => '', 'style'=>"display:none;"]); ?>
                                    </span>
                                </label>
                                <div class="mb-3 mt-3">
                                    <button class="btn btn-primary my-auto" type="submit" id="submit-csv" style="display:none;">CSV読み込み <i id="csv-sub-icon" class="fas fa-sync"></i></button>
                                </div>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <?php if(isset($user->user_detail->rating) && $season != $user->user_detail->season): ?>
                    <div class="mb-3">
                        <h5 class="card-title">プレイデータに変更が無い場合、再計算ボタンからCPIを再算出することが可能です</h5>
                        <div class="text-center">
                        <a href="<?= $this->Url->build(['action'=>'recalclate',$user->id]) ?>" class="btn btn-info" id="jump-reculc">再計算 <i id="reculc-icon" class="fas fa-sync"></i></a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
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
