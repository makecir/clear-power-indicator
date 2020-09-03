<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Score $score
 */
?>
<div class="scores view content">
    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <div class="pc-dsp"><h3 class="mb-0"><?= h($score->title_info) ?></h3></div>
            <div class="sp-dsp"><h4 class="mb-0"><?= h($score->title_info) ?></h4></div>
        </div>
        <div class="card-body text-dark pr-3 pl-3">
            <div class="mb-3">
                <h4><?= h($score->version_info) ?>, <?= $score->difficulty_info_with_color ?></h4>
                <h4 style="display:inline;">TexTage</h4>
                <h4 style="display:inline;"> : <?= $this->Html->link("1P",$score->textage_url_1p,['class'=>'btn btn-info']) ?> / <?= $this->Html->link("2P",$score->textage_url_2p,['class'=>'btn btn-info']) ?></h4>
            </div>
            <?php if(isset($identity)):?>
                <div class="table-responsive table-smart-phone-sm mb-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th align="center">プレイヤー</th>
                                <th align="center">CPI</th>
                                <th align="center">ランプ</th>
                                <th align="center">ミスカウント</th>
                            </tr>
                            <tr>
                                <td align="center"><?= $this->Html->link($me->user_detail->dj_name,['action'=>'view',$me->id],) ?></td>
                                <td align="center"><?= $me->user_detail->rating_info ?></td>
                                <td align="center" bgcolor=<?= $display_info['color'][$my_data->lamp] ?>><?= $display_info['cur_lamp'][$my_data->lamp] ?></td>
                                <td align="center"><?= $my_data->miss_count??"---" ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif;?>
            <div class="mb-3">
                <div class="mb-1">
                    <h4 style="display:inline;">適正CPI</h4>
                    <h5 style="display:inline;">(クリア確率50%)</h5>
                </div>
                <div class="table-responsive table-smart-phone-sm">
                    <table class="table table-bordered padding-sm">
                        <tbody>
                            <tr>
                                <?php for($i=3 ; $i<=7 ; $i++): ?>
                                    <th align="center" bgcolor=<?= $display_info['color'][$i] ?>>
                                        <div class="pc-dsp"><?= $display_info['cur_lamp'][$i] ?></div>
                                        <div class="sp-dsp"><?= $display_info['lamp_short'][$i] ?></div>
                                    </th>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td align="center"><?= $score->fifty_rating_easy ?></td>
                                <td align="center"><?= $score->fifty_rating_clear ?></td>
                                <td align="center"><?= $score->fifty_rating_hard ?></td>
                                <td align="center"><?= $score->fifty_rating_exhard ?></td>
                                <td align="center"><?= $score->fifty_rating_fc ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
