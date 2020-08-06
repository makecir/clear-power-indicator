<div class="users view content">
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="card-title mb-0"><?= __('アカウント設定') ?></h4>
        </div>
        <div class="card-body text-dark pr-4 pl-4">
            <div class="password change form content">
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <div class="mb-5">
                        <h4 class="card-title"><?= __('公開設定') ?></h4>
                        <p>
                            パブリック：情報の公開と被フォローを特に制限しない</br>
                            プライベート：プレイヤーの基本情報以外はフォロワーのみ閲覧可能（プライベートアカウントをフォローするには、そのユーザーが設定した合言葉が必要です）
                        </p>
                            <label for="private-level">公開範囲</label>
                            <?= $this->Form->select('private_level',$user->private_dict,['label' => '公開範囲', 'class' => 'form-control mb-3']); ?>
                            <?= $this->Form->control('follow_pass',['label' => '合言葉', 'class' => 'form-control mb-3', 'type' => 'text', 'placeholder'=>'follow', 'required' => true]); ?>
                        <small class="form-text text-muted">denied と設定すると、全てのフォローを拒否します。</small>
                    </div>
                    <div class="mb-5">
                        <h4 class="card-title"><?= __('連絡先を設定') ?></h4>
                        <p>
                            ユーザーIDまたはパスワードを忘れ、ログインが不可能になった場合、下記の情報を登録しておくことで、当サイトの運営と連絡を取ることが可能です。</br>
                            メールアドレス情報は第三者に公開されず、上記の連絡においての本人確認以外に用いられることはありません。</br>
                        </p>
                        <?php
                            echo $this->Form->control('user_detail.twitter_id',['label' => 'Twitter ID', 'class' => 'form-control mb-3', 'type' => 'text', 'placeholder'=>'IIDX_CPI']);
                            echo $this->Form->control('email',['label' => 'Eメールアドレス', 'class' => 'form-control mb-3', 'type' => 'text', 'placeholder'=>'beatmaniaiidx.cpi@gmail.com']);
                        ?>
                    </div>
                </fieldset>
                <?= $this->Form->button(__('変更'),['class' => 'btn btn-primary my-auto','id'=>'change-setting']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="card-title mb-0"><?= __('パスワード変更') ?></h4>
        </div>
        <div class="card-body text-dark pr-4 pl-4">
            <div class="password change form content">
                <p>
                    現在のパスワードを入力すると、パスワードを変更可能です。
                </p>
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <?php
                        echo $this->Form->control('old_password',['label' => '現在のパスワード', 'class' => 'form-control mb-3', 'type' => 'password', 'value'=>'', 'placeholder'=>'Current password', 'required' => true]);
                        echo $this->Form->control('new_password',['label' => '新しいパスワード', 'class' => 'form-control mb-3', 'type' => 'password', 'value'=>'', 'placeholder'=>'New password', 'required' => true]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('変更'),['class' => 'btn btn-primary my-auto','id'=>'change-pass']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="card-title text-danger mb-0"><?= __('アカウント削除') ?></h4>
        </div>
        <div class="card-body text-dark pr-4 pl-4">
            <p>
                アカウントを削除すると、登録したユーザー情報・スコア・フォロー関係は全て削除されます。</br>
                一度削除した場合、サービス側から復元することはできません。</br>
                フォームにアカウントのパスワードを正しく入力し、削除ボタンを押すと、アカウントを削除できます。</br>
            </p>

            <?= $this->Form->create(null, ['url' => ['action' => 'delete', $user->id]]) ?>
            <fieldset>
                <?= $this->Form->control('password', ['label' => 'パスワード', 'class' => 'form-control mb-3', 'placeholder'=>'Password', 'required' => true]) ?>
            </fieldset>
            <?= $this->Form->button(__('Delete'),['class' => 'btn btn-danger my-auto'], ['confirm' => __('Are you sure you want to delete {0}?', $user->username)]) ?>
            <?= $this->Form->end() ?>

        </div>
    </div>

</div>
