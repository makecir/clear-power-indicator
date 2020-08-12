<div class="users following content">
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="mb-0">
                <?= __('Confirm') ?>
            </h4>
        </div>
        <div class="card-body text-dark">
            <?= $this->Form->create(null) ?>
            <fieldset>
                <p>
                    プライベートなアカウントです。</br>
                    フォローに必要な合言葉を本人に確認し、入力してください。
                </p>
                <?php
                    echo $this->Form->control('phrase',
                        ['label' => '合言葉', 'class' => 'form-control mb-3', 'type' => 'text', 'placeholder'=>'Follow phrase']
                    );
                ?>
            </fieldset>
            <?= $this->Form->button(__('フォローする'), ['class' => 'btn btn-primary my-auto']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
