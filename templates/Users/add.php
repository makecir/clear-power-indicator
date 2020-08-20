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
            <legend><?= '入力フォーム' ?></legend>
            <div class="text-danger mb-3">※ 新規登録を行う前に<?= $this->Html->link(
                                            '利用に際しての注意・警告',
                                            ['controller' => 'Pages', 'action' => 'about', '#'=>'caution'],
                                        )?>をご確認ください。</div>
            <?= $this->Form->control('username',['class' => 'form-control mb-0', 'placeholder'=>'user_id']); ?>
            <small class="form-text text-muted mb-3">アルファベットまたはアンダーバーからなる4字以上16字以下の文字列</small>
            <?= $this->Form->control('password',['class' => 'form-control mb-0', 'type'=>'password', 'placeholder'=>'Password']); ?>
            <small class="form-text text-muted mb-3">アルファベットまたはアンダーバーからなる6字以上32字以下の文字列</small>
            <?= $this->Form->control('retype_password',['class' => 'form-control mb-0', 'type'=>'password', 'placeholder'=>'Password', 'required' => true]); ?>
            <small class="form-text text-muted mb-3"></small>
        </fieldset>
        <?= $this->Form->button(__('登録'), ['class' => 'btn btn-info my-auto']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>