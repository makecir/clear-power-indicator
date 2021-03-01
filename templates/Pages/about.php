<div class="display about content">
    <div class="card border-secondary mb-3" id="about">
        <div class="card-header">
            <h5 class="mb-0">
                このサイトについて
            </h5>
        </div>
        <div class="card-body text-dark">
            <p>
            beatmania IIDXのプレイデータ（八段～皆伝かつ公開設定、約30,000名）を基に独自の方式でSP☆12の譜面難易度を推定しています。</br>
            スコアデータCSVを登録することで、あなたのSP☆12クリア力をレーティングし、同じくらいのクリア力のプレイヤーにおいてクリア確率の高い譜面をリコメンドします。</br>
            推定手法の詳細については<a href="https://riceplace.hatenablog.jp/entry/2020/10/03/164936" target="_blank">こちら</a>および関連記事をご覧ください。</br>
            </p>
        </div>
    </div>

    <div class="card border-secondary mb-3" id="caution">
        <div class="card-header">
            <h5 class="mb-0">
                利用に際しての注意・警告
            </h5>
        </div>
        <div class="card-body text-dark">
            <ul class="list">
                <li>
                    当サイトはbeatmania IIDX公式サービスとは一切関係のないファン有志による非公式サイトです。</br>
                </li>
                <li>
                    当サイトの提供するサービスを利用することで生じた損害に対して、当サイトの運営は責任を負いかねます。自己責任でご利用ください。</br>
                    <ul style="list-style-type:disc;font-size:small;">
                        <li>
                            登録に使用するパスワード等の個人情報は慎重に管理していますが、不測の事態により情報が流出した場合、それに伴う損害を補償することはできません。</br>
                            他サービスとのパスワードの共有はご遠慮ください。</br>
                        </li>
                        <li>
                            表示されるクリア力およびクリア確率はあくまで推定された値であり、クリア可能性を保証するものではありません。</br>
                            利用に伴うクレジット等の損害を補償することはできません。
                        </li>
                        <li>
                            推定結果やフォロー機能などにより生じたユーザ間のトラブルには対応致しかねます。
                        </li>
                    </ul>
                </li>
                <li>
                    サイトを運営する上で不適切と判断されたユーザについて、警告無くアカウントを停止するなどの対策措置を講じる可能性があります。</br>
                    <ul style="list-style-type:disc;font-size:small;">
                        <li>
                            恣意的なプレイデータの改ざん・他人へのなりすましなどはご遠慮ください。</br>
                        </li>
                        <li>
                            サービスに意図的に負荷をかける行為はご遠慮ください。
                        </li>
                        <li>
                            その他、悪意を以てサイト運営・他利用者・サービス外の第三者に不利益を及ぼす行為をしていると運営が判断した場合、アカウントの停止を含むその他の措置を行う可能性があります。
                        </li>
                    </ul>
                </li>
                <li>
                    ユーザによって本サービスに登録されたプレイデータについて、匿名化を行ったのち、推定手法の改善・新規構築に使用する可能性があります。</br>
                </li>

            </ul>
        </div>
    </div>

    <div class="card border-secondary mb-3" id="numerical-value">
        <div class="card-header">
            <h5 class="mb-0">
                表示される数値について
            </h5>
        </div>
        <div class="card-body text-dark">
            <dl class="list">
                <dt>CPI</dt>
                <dd>
                    SP☆12のクリア力を表す当サイト独自の指標です。</br>
                    数値が高いほど、推定されたクリア力が高いことを示しており、各段位ごとにおおよそ下表のような分布になっています。（IIDX27時点）</br>
                    <div class="row justify-content-around">
                        <div class="col-12">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th></th>
                                        <th>九段</th>
                                        <th>十段</th>
                                        <th>中伝</th>
                                        <th>皆伝</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th align="center">中央値</th>
                                        <td align="center">1340</th>
                                        <td align="center">1500</th>
                                        <td align="center">1620</th>
                                        <td align="center">1880</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    具体的には、データベース上の約30,000名のプレイヤーとクリアランプ勝敗を比較し、イロレーティング方式（係数400・平均1500）に変換して表示しています。</br>
                    （例：データベースのプレイヤーに19500勝9500敗1000分の場合、引き分けを0.5勝換算として勝率は約2/3なので、CPIは1620程度となります）
                </dd>
                <dt>推定順位</dt>
                <dd>
                    CPIを求める際に利用した、データベースのプレイヤーに対する勝敗数から計算します。</br>
                    よって「八段以上の段位を取得済みかつ非公開設定でないプレイヤー」の「データベース作成時のプレイデータ」との比較で求めているため、プレイデータ登録時点における“真の順位”とは異なります。
                </dd>
                <dt>クリア割合</dt>
                <dd>
                    同じくらいのCPIのプレイヤーがそのランプを達成している割合を表しており、<b>プレイ回数に対するクリア確率を表すものではありません。</b></br>
                    具体的には、データベース上のプレイヤーごとに求めたCPIを学習データとし、ロジスティック回帰分析によって算出しています。</br>
                    収録されてから日が浅い譜面についてはクリア確率が低く算出されると予想されるため、以下のような抽出補正を行っています。</br>
                    <div class="card m-2 p-3">
                        <b>今作収録された譜面で、データベース作成時に収録から約1ヶ月以上経過していた解禁不要譜面、および約2ヶ月以上経過していた要解禁譜面</b>
                            対象譜面のランプを旧曲と比較し、その差が小さいプレイヤーを半分程度抽出し、クリア確率を計算する
                    </div>
                </dd>
                <dt>適正CPI</dt>
                <dd>
                    対象のランプでクリアを達成しているプレイヤーの割合が50％になるCPIレーティングを表しています。</br>
                    例えば、「DynamiteのEASYランプの適正CPIが1561.30である」というのは、「CPIが1561.30のユーザーのうち2人に1人がDynamiteをEASYでクリアしていると推定できる」と言い換えられます。
                </dd>
            </dl>
        </div>
    </div>

    <div class="card border-secondary mb-3" id="update">
        <div class="card-header">
            <h5 class="mb-0">
                更新・対応譜面
            </h5>
        </div>
        <div class="card-body text-dark">
            <div class="mb-3">
                <h4 class="card-title">CPIサービスの更新履歴</h4>
                <p>
                    詳しくは <?= $this->Html->link(
                        '更新履歴一覧',
                        ['action' => 'update'],)
                    ?>
                    ・
                     <a href="https://twitter.com/IIDX_CPI" target="_blank">CPI公式Twitter</a>
                    をご覧ください。
                </p>
            </div>
            <div class="mb-3">
                <h4 class="card-title">対応譜面</h4>
                <div class="text-dark"><p>更新日：2020/12/25</p></div> 
                <dl class="list">
                    <dt>適正CPIおよびクリア確率算出対応譜面</dt>
                    <dd>
                    IIDX27以前の収録曲（削除曲を除く）+ IIDX28デフォルト☆12（隠しLEGGENDARIAを含む）</dd>
                    <dt>ランプ一覧のみで扱う対応譜面</dt>
                    <dd>
                    IIDX28追加☆12譜面</br>
                    （3!dolon Forc3, Fire Beat, THE PEERLESS UNDER HEAVEN, Viridian, 世界の果てに約束の凱歌を -ReUnion-, 閠槞彁の願い）
                    この項目の楽曲・譜面はプレイヤーのCPI算出には影響せず、適正CPI・クリア確率の推定は行われません。 
                    </dd>
                </dl>
            </div>
        </div>
    </div>


    <div class="card border-secondary mb-3" id="how-to-update">
        <div class="card-header">
            <h5 class="mb-0">
                スコア登録方法
            </h5>
        </div>
        <div class="card-body text-dark">
            <div class="text-danger"><p>推定には、IIDX公式のプレミアムコース登録が必要になります。</p></div> 
            <ol class="list">
                <li><a href="https://p.eagate.573.jp/game/2dx/28/djdata/score_download.html?style=SP" target="_blank">公式サイト</a>にアクセスします。</br>
                「SP」->「ダウンロード」からプレーデータのテキスト全てをコピー、または、CSVをダウンロードします。
                <li>
                    <?= $this->Html->link(
                        'CPI更新/プレイデータ登録',
                        ['controller' => 'Users', 'action' => 'edit', $identity->id??null],
                    )?>
                    (要ログイン)の「①テキスト」にコピーしたプレイデータをペーストし「テキスト読み込み」をクリック。</br>
                    または、「②CSVアップロード」の「CSV選択」で、ダウンロードしたCSVを選択し、「CSV読み込み」ボタンを押します。 
                </li>
                <li>算出に20秒程度掛かります。お待ちください。</li>
                <li>ページが更新され、ダイアログが出たら推定および更新完了です。</li>
            </ol>
        </div>
    </div>

    <div class="card border-secondary mb-3" id="another-site">
        <div class="card-header">
            <h5 class="mb-0">
                外部サイトについて
            </h5>
        </div>
        <div class="card-body text-dark">
            <div class="mb-3">
                <dl class="list">
                    <dt><?= $this->Html->link("TexTage","https://textage.cc",['target'=>"_blank"]) ?> 様</dt>
                    <dd>
                        譜面情報のリンク先として設定させていただいております。
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="card border-secondary mb-3" id="contact">
        <div class="card-header">
            <h5 class="mb-0">
                連絡先
            </h5>
        </div>
        <div class="card-body text-dark">
            <p>
                CPIは鋭意製作中のwebサイトです。</br>
                改善要望・不具合報告・感想等は下記のGoogleフォームからご回答いただき、開発を支援していただけると嬉しいです。</br>
                その他のお問合せは、下記のTwitterのDMまたはEメールからご連絡ください。
            </p>
            <dl class="list">
                <dt>Google Form : <a href="https://forms.gle/1zgkyzQq99DAHsVx7" target="_blank">要望・感想</a></dt>
                <dt>Google Form : <a href="https://forms.gle/jc96F6ry5cP4VGfz7" target="_blank">不具合報告</a></dt>
                <dt>Twitter : <a href="https://twitter.com/IIDX_CPI" target="_blank">@IIDX_CPI</a></dt>
                <dt>Email : <a href="mailto:beatmaniaiidx.cpi@gmail.com">beatmaniaiidx.cpi@gmail.com</a></dt>
            </dl>
        </div>
    </div>

    <div class="card border-secondary mb-3" id="donation">
        <div class="card-header padding-sm">
            <h5 class="mb-0">
                広告表示・開発者支援について
            </h5>
        </div>
        <div class="card-body text-dark">
            <p>
                当サイトの運営にあたり、実力の推定・コンテンツの表示・データの保管を担うサーバの契約費を自費で補っています。</br>
                可能な限り長期の運営を行うため、広告表示によってコストの補填を行うことを考えています。</br>
            </p>
            <p>
                ご寄付等の形で開発の進行・運営の維持にご協力いただける場合、
                <?= $this->Html->link(
                    '開発者支援について',
                    ['action' => 'donate'],)
                ?>をご覧ください。
            </p>
        </div>
    </div>

</div>
