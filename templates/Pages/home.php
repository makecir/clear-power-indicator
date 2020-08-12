<div class="display home content">
    <div class="card border-secondary mb-3">
        <div class="card-header  padding-sm" >
            <h3 class="mb-0">
                <?= __('Clear Power Indicator') ?>
            </h3>
        </div>
        <div class="card-body text-dark">
            <h4 class="card-title">ようこそ</h4>
            <p>
                Clear Power Indicator(CPI)へようこそ！</br>
                当サイトはBeatmania IIDXのプレイデータを読み込むことで、SP☆12のクリア力や、曲やクリアオプションごとの達成確率を推定するサイトです。
            </p>
            <div class="text-danger">推定には、IIDX公式のプレミアムコース登録が必要になります。</div> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-secondary mb-3">
                <div class="card-header">
                    <h4 class="mb-0">
                        <?= __('利用する') ?>
                    </h4>
                </div>
                <div class="card-body text-dark">
                    <p>
                        ユーザ登録をすることで、推定結果を保存可能です。</br>
                        新規登録またはログインし、CPIをご利用ください。</br>
                    </p>
                    <?= $this->Html->link(
                        __('Register'),
                        ['controller' => 'Users', 'action' => 'add'],
                        ['class' => 'btn btn-info'])
                    ?>
                    <?= $this->Html->link(
                        __('Login'),
                        ['controller' => 'Users', 'action' => 'login'],
                        ['class' => 'btn btn-primary'])
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-secondary mb-3">
                <div class="card-header">
                    <h4 class="mb-0">
                        <?= __('試してみる') ?>
                    </h4>
                </div>
                <div class="card-body text-dark">
                    <p>
                        ユーザ登録が不要のベータ版でも実力を推定可能です。</br>
                        推定の手法やデータが古く、結果が最新のものと異なることがあります。</br>
                    </p>
                    <?= $this->Html->link(
                        __('beta-version'),
                        "https://cpi-beta.makecir.com/",
                        ['class' => 'btn btn-info'])
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
