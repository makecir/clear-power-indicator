<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Score $score
 */
?>
<div class="scores view content">
    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <div class="pc-dsp"><h3 class="mb-0"><?= h($score->title)." ".$score->difficulty_info_with_color ?></h3></div>
            <div class="sp-dsp"><h4 class="mb-0"><?= h($score->title)." ".$score->difficulty_info_with_color ?></h4></div>
        </div>
        <div class="card-body text-dark pr-3 pl-3">
            <div class="mb-3">
                <div><h4><?= h($score->version_info) ?></div>
                <div>
                    <h4 style="display:inline;">TexTage</h4>
                    <h6 style="display:inline;">(外部サイト) </h6>
                    <h4 style="display:inline;"><?= $this->Html->link("1P",$score->textage_url_1p,['class'=>'btn btn-info', 'target'=>"_blank"]) ?> <?= $this->Html->link("2P",$score->textage_url_2p,['class'=>'btn btn-info', 'target'=>"_blank"]) ?></h4>

                </div>
            </div>
            <?php if(isset($identity)):?>
                <div class="table-responsive table-smart-phone-sm mb-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th align="center">プレイヤー</th>
                                <th align="center">CPI</th>
                                <th align="center">ランプ</th>
                                <th align="center">BP</th>
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
            <?php if($score->is_rated==1):?>
                <div class="mb-3">
                    <div class="mb-1">
                        <h4 style="display:inline;">適正CPI</h4>
                        <h5 style="display:inline;">(クリア確率50%)</h5>
                    </div>
                    <div class="table-responsive table-smart-phone-x">
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
                                <?php if(isset($identity)):?>
                                    <tr>
                                        <td align="center"><?= sprintf("%.2f %%",100*$score->getProbabilityEasy($me->user_detail->rating)) ?></td>
                                        <td align="center"><?= sprintf("%.2f %%",100*$score->getProbabilityClear($me->user_detail->rating)) ?></td>
                                        <td align="center"><?= sprintf("%.2f %%",100*$score->getProbabilityHard($me->user_detail->rating)) ?></td>
                                        <td align="center"><?= sprintf("%.2f %%",100*$score->getProbabilityExhard($me->user_detail->rating)) ?></td>
                                        <td align="center"><?= sprintf("%.2f %%",100*$score->getProbabilityFc($me->user_detail->rating)) ?></td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mb-3">
                    <canvas id="myChart" width="400" height="300"></canvas>
                </div>
            <?php else:?>
                <h4>CPI算出未対応曲です。</h4>
            <?php endif;?>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'scatter',
        data: {
            labels: [<?php foreach($predict_line['x'] as $predict):?><?= $predict.',' ?><?php endforeach; ?>],
            datasets: [
                {
                    label: 'EASY',
                    data: [<?php foreach($predict_line['easy'] as $i => $predict):?><?= '{x:'.$predict_line['x'][$i].',y:'.$predict.'},' ?><?php endforeach; ?>],
                    borderColor: 'rgba(153, 255, 153, 1)',
                    pointRadius: 0,
                    showLine: true,
                    fill: false,
                },
                {
                    label: 'CLEAR',
                    data: [<?php foreach($predict_line['clear'] as $i => $predict):?><?= '{x:'.$predict_line['x'][$i].',y:'.$predict.'},' ?><?php endforeach; ?>],
                    borderColor: 'rgba(135, 204, 255, 1)',
                    pointRadius: 0,
                    showLine: true,
                    fill: false,
                },
                {
                    label: 'HARD',
                    data: [<?php foreach($predict_line['hard'] as $i => $predict):?><?= '{x:'.$predict_line['x'][$i].',y:'.$predict.'},' ?><?php endforeach; ?>],
                    borderColor: 'rgba(255, 102, 102, 1)',
                    pointRadius: 0,
                    showLine: true,
                    fill: false,
                },
                {
                    label: 'EXHARD',
                    data: [<?php foreach($predict_line['exhard'] as $i => $predict):?><?= '{x:'.$predict_line['x'][$i].',y:'.$predict.'},' ?><?php endforeach; ?>],
                    borderColor: 'rgba(255, 255, 153, 1)',
                    pointRadius: 0,
                    showLine: true,
                    fill: false,
                },
                {
                    label: 'FULLCOMBO',
                    data: [<?php foreach($predict_line['fc'] as $i => $predict):?><?= '{x:'.$predict_line['x'][$i].',y:'.$predict.'},' ?><?php endforeach; ?>],
                    borderColor: 'rgba(255, 153, 102, 1)',
                    pointRadius: 0,
                    showLine: true,
                    fill: false,
                },
            ]
        },
        options: {
            legend: {display: false},
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    ticks: {
                        stepSize: 50
                    }
                }],
                yAxes: [{
                    ticks: {
                        callback: function(value, index, values) {
                            return value + "%";
                        }
                    }
            }]
            },
            <?php if(isset($identity)&&isset($me->user_detail->rating_info)&& $me->user_detail->rating >= $predict_line['x'][0] && $me->user_detail->rating <= end($predict_line['x'])):?>
                annotation: {
                    annotations: [
                        {
                            type: "line",
                            mode: "vertical",
                            scaleID: "x-axis-1",
                            value: <?= $me->user_detail->rating_info ?>,
                            borderColor: "black",
                            label: {
                                // content: "you",
                                // enabled: true,
                                // position: "top"
                            }
                        }
                    ]
                }
            <?php endif; ?>
        }
    });
    }
</script>
