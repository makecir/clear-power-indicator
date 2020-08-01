<div class="users view content">
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="card-title mb-0"><?= __('アカウント設定') ?></h4>
        </div>
        <div class="card-body text-dark pr-4 pl-4">
            
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
                <?= $this->Form->control('password', ['required' => true]) ?>
            </fieldset>
            <?= $this->Form->button(__('Delete'),['class' => 'btn btn-danger my-auto'], ['confirm' => __('Are you sure you want to delete {0}?', $user->username)]) ?>
            <?= $this->Form->end() ?>

        </div>
    </div>

</div>
