<!-- in /templates/Users/login.php -->
<div class="users form">
    <?= $this->Flash->render() ?>
    <div class="card border-secondary mb-3">
        <div class="card-header mb-0">
            <h4 class="card-title" style="display:inline;"><?= __('Login') ?></h4>
        </div>
        <div class="card-body text-dark">
            <h3><?= __('Login') ?></h3>
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Please enter your username and password') ?></legend>
                <?= $this->Form->control('username', ['class' => 'form-control mb-3', 'required' => true, 'placeholder'=>'User ID']) ?>
                <?= $this->Form->control('password', ['class' => 'form-control mb-3', 'required' => true, 'placeholder'=>'Password']) ?>
                <?= $this->Form->control('remember_me', ['type' => 'checkbox', 'checked' => 'checked']) ?>
            </fieldset>
            <?= $this->Form->button(__('Login'),['class' => 'btn btn-primary my-auto']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="card-title mb-0"><?= __('アカウントを持っていない場合') ?></h4>
        </div>
        <div class="card-body text-dark">
            <?= $this->Html->link(__('Register'), ['action' => 'add'], ['class' => 'btn btn-info my-auto']) ?>
        </div>
    </div>
</div>