<div class="display home content">

    <div class="card border-info mb-3" id="about">
        <div class="card-header text-white bg-info">
            <h5 class="mb-0">
                アンケートのお願い
            </h5>
        </div>
        <div class="card-body text-dark">
            CPIは鋭意製作中のwebサイトです。</br>
            <a href="https://forms.gle/1zgkyzQq99DAHsVx7">改善要望・感想</a>または<a href="https://forms.gle/jc96F6ry5cP4VGfz7">不具合報告</a>をご回答いただき、開発を支援していただけると嬉しいです。</br>
            今までに頂いたご要望とご質問の一部に<?= $this->Html->link(
                'こちら',
                ['action' => 'faq'],)
            ?>で回答しています。
        </div>
    </div>

    <div class="card border-secondary mb-3">
        <div class="card-header  padding-sm" >
            <h3 class="mb-0">
                <?= __('ようこそ') ?>
            </h3>
        </div>
        <div class="card-body text-dark">
            <div class="mb-3">
                <h4 class="card-title">CPIとは？</h4>
                <p>
                    Clear Power Indicator(CPI)へようこそ！</br>
                    当サイトはBeatmania IIDXのプレイデータを読み込むことで、SP☆12のクリア力や、曲やクリアオプションごとの達成確率を推定する非公式ファンサイトです。
                </p>
                <div class="text-danger">推定には、IIDX公式のプレミアムコース登録が必要になります。</div>
            </div>
            <div class="mb-3">
                <h4 class="card-title">利用できる機能</h4>
                <ul class="list">
                    <li>☆12のクリア力を算出</li>
                    <li>リコメンド・逆リコメンドを表示</li>
                    <li>フォローしたユーザーとの比較</li>
                </ul>
            </div>
            <div class="mb-3">
                <h4 class="card-title">ベータ版をご利用戴いた皆様へ</h4>
                <p>
                    ベータ版をご利用いただいた方、SNSにて共有していただいた方、アンケートでフィードバックをくださった方、開発者支援をして下さった方に感謝を申し上げます。</br>
                    アンケートにてたくさんのご要望を頂きましたが、技術的に困難なものも含め、一部対応できていないものがあります。</br>
                    いただいたご意見は、今後の機能の向上に役立てさせていただきます。</br>
                </p>
            </div>
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
                        新規登録またはログインし、CPIの機能をご利用ください。</br>
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
                        推定の手法やデータが古く、結果が最新のものと異なります。</br>
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
