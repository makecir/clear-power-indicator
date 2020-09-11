<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Score $score
 */
?>
<div class="scores view content">
    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <div class="pc-dsp"><h3 class="mb-0" style="display:inline;"><?= h($score->title) ?></h3><h4 class="mb-0" style="display:inline;"><?= " ".$score->difficulty_info_with_color ?></h4></div>
            <div class="sp-dsp"><h4 class="mb-0" style="display:inline;"><?= h($score->title) ?></h4><h5 class="mb-0" style="display:inline;"><?= " ".$score->difficulty_info_with_color ?></h5></div>
        </div>
        <div class="card-body text-dark pr-3 pl-3">
            <div class="mb-3">
                <div class="pc-dsp"><h4><?= h($score->version_info) ?></h4></div>
                <div class="sp-dsp"><h5><?= h($score->version_info) ?></h5></div>
                <div class="pc-dsp">
                    <h4 style="display:inline;">譜面</h4>
                    <h4 style="display:inline;"><?= $this->Html->link("1P",$score->textage_url_1p,['class'=>'btn btn-info', 'target'=>"_blank"]) ?> <?= $this->Html->link("2P",$score->textage_url_2p,['class'=>'btn btn-info', 'target'=>"_blank"]) ?></h4>
                    <h6 style="display:inline;">(外部サイトTexTage) </h6>
                </div>
                <div class="sp-dsp">
                    <h5 style="display:inline;">譜面</h5>
                    <h4 style="display:inline;"><?= $this->Html->link("1P",$score->textage_url_1p,['class'=>'btn btn-info btn-sm', 'target'=>"_blank"]) ?> <?= $this->Html->link("2P",$score->textage_url_2p,['class'=>'btn btn-info btn-sm', 'target'=>"_blank"]) ?></h4>
                    <h6 style="display:inline;">(外部サイトTexTage) </h6>
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
                                <td align="center"><?= $this->Html->link($me->user_detail->dj_name,['controller'=>"Users",'action'=>'view',$me->id],) ?></td>
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
                    <div class="mb-1 pc-dsp">
                        <h4 style="display:inline;">適正CPI</h4>
                        <?php if(isset($identity)):?>
                            <h4 style="display:inline;">・クリア割合</h6>
                        <?php endif;?>
                    </div>
                    <div class="mb-1 sp-dsp">
                        <h5 style="display:inline;">適正CPI</h5>
                        <?php if(isset($identity)):?>
                            <h5 style="display:inline;">・クリア確率</h5>
                        <?php endif;?>
                        <span data-toggle="tooltip" data-html="true" title=
                            <?= "'大まかな目安です</br>詳しくは".
                                $this->Html->link(
                                    'こちら',
                                    ['controller' => 'Pages', 'action' => 'about', '#'=>'numerical-value'],
                                ).
                                "をご覧下さい'" 
                            ?> class="text-nowrap" data-trigger="click hover focus">
                            <i class="fas fa-question-circle"></i>
                        </span>
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
                                    <td align="center"><?= $score->fifty_rating_easy." (".$score->predicted_easy_rank."位)" ?></td>
                                    <td align="center"><?= $score->fifty_rating_clear." (".$score->predicted_clear_rank."位)" ?></td>
                                    <td align="center"><?= $score->fifty_rating_hard." (".$score->predicted_hard_rank."位)" ?></td>
                                    <td align="center"><?= $score->fifty_rating_exhard." (".$score->predicted_exhard_rank."位)" ?></td>
                                    <td align="center"><?= $score->fifty_rating_fc." (".$score->predicted_fc_rank."位)" ?></td>
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
                    <style id="compiled-css" type="text/css">
                        .chartWrapper {
                        position: relative;
                        }
                        .chartWrapper > canvas {
                        position: absolute;
                        left: 0;
                        top: 0;
                        pointer-events:none;
                        }
                        .chartAreaWrapper {
                        overflow-x: scroll;
                        }
                        .chartAreaWrapper2 {
                        width: 1076px;
                        }
                    </style> 
                    <div class="chartWrapper"> 
                        <div class="chartAreaWrapper" id="rew"> 
                            <div class="chartAreaWrapper2"> 
                            <canvas id="myChart" height="300" width="1076"></canvas> 
                            </div> 
                        </div> 
                        <canvas id="myChartAxis" height="300" width="0"></canvas> 
                    </div>
                    <script>
                        window.onload = function() {
                            var rectangleSet = false;
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
                                            xAxisID: 'x-axis-0',
                                            yAxisID: 'y-axis-0'
                                        },
                                        {
                                            label: 'CLEAR',
                                            data: [<?php foreach($predict_line['clear'] as $i => $predict):?><?= '{x:'.$predict_line['x'][$i].',y:'.$predict.'},' ?><?php endforeach; ?>],
                                            borderColor: 'rgba(135, 204, 255, 1)',
                                            pointRadius: 0,
                                            showLine: true,
                                            fill: false,
                                            xAxisID: 'x-axis-0',
                                            yAxisID: 'y-axis-0'
                                        },
                                        {
                                            label: 'HARD',
                                            data: [<?php foreach($predict_line['hard'] as $i => $predict):?><?= '{x:'.$predict_line['x'][$i].',y:'.$predict.'},' ?><?php endforeach; ?>],
                                            borderColor: 'rgba(255, 102, 102, 1)',
                                            pointRadius: 0,
                                            showLine: true,
                                            fill: false,
                                            xAxisID: 'x-axis-0',
                                            yAxisID: 'y-axis-0'
                                        },
                                        {
                                            label: 'EXHARD',
                                            data: [<?php foreach($predict_line['exhard'] as $i => $predict):?><?= '{x:'.$predict_line['x'][$i].',y:'.$predict.'},' ?><?php endforeach; ?>],
                                            borderColor: 'rgba(255, 255, 153, 1)',
                                            pointRadius: 0,
                                            showLine: true,
                                            fill: false,
                                            xAxisID: 'x-axis-0',
                                            yAxisID: 'y-axis-0'
                                        },
                                        {
                                            label: 'FULLCOMBO',
                                            data: [<?php foreach($predict_line['fc'] as $i => $predict):?><?= '{x:'.$predict_line['x'][$i].',y:'.$predict.'},' ?><?php endforeach; ?>],
                                            borderColor: 'rgba(255, 153, 102, 1)',
                                            pointRadius: 0,
                                            showLine: true,
                                            fill: false,
                                            xAxisID: 'x-axis-0',
                                            yAxisID: 'y-axis-0'
                                        },
                                    ]
                                },
                                options: {
                                    legend: {display: false},
                                    //responsive: true,
                                    //maintainAspectRatio: false,
                                    scales: {
                                        xAxes: [{
                                            id: 'x-axis-0',
                                            ticks: {
                                                stepSize: 50
                                            }
                                        }],
                                        yAxes: [{
                                            id: 'y-axis-0',
                                            ticks: {
                                                callback: function(value, index, values) {
                                                    return value + "%";
                                                }
                                            },
                                            gridLines: {
                                                color: ['rgba(0, 0, 0, 0.2)',
                                                'rgba(0, 0, 0, 0.1)',
                                                'rgba(0, 0, 0, 0.1)',
                                                'rgba(0, 0, 0, 0.1)',
                                                'rgba(0, 0, 0, 0.1)',
                                                'rgba(0, 0, 0, 0.2)',
                                                'rgba(0, 0, 0, 0.1)',
                                                'rgba(0, 0, 0, 0.1)',
                                                'rgba(0, 0, 0, 0.1)',
                                                'rgba(0, 0, 0, 0.1)',
                                            ]
                                            }
                                        }]
                                    },
                                    animation: {
                                        onComplete : function () {
                                            if (!rectangleSet) {
                                                var scale = window.devicePixelRatio; 
                                                var sourceCanvas = this.chart.ctx.canvas;
                                                var getParentIdName = this.chart.canvas.attributes.id.value,
                                                    targetElement = document.getElementById("myChartAxis"),
                                                    sourceElement = document.getElementById("myChart"),
                                                    copyWidth = this.scales["y-axis-0"].width - 9, // we are copying the width of actual chart
                                                    copyHeight = this.scales["y-axis-0"].height + 15, // we are copying the width of actual chart
                                                    targetElementWidth = sourceElement.getContext("2d").canvas.clientWidth,
                                                    targetElementHeight = sourceElement.getContext("2d").canvas.clientHeight,
                                                    targetCtx = targetElement.getContext("2d");
                                                targetCtx.scale(scale, scale);
                                                targetCtx.canvas.width = copyWidth * scale;
                                                targetCtx.canvas.height = copyHeight * scale;
                                                targetCtx.canvas.style.width = `${copyWidth}px`;
                                                targetCtx.canvas.style.height = `${copyHeight}px`;
                                                //targetCtx.drawImage(sourceCanvas, 0, 0, targetElementWidth, targetElementHeight);
                                                targetCtx.drawImage(sourceCanvas, 0, 0, copyWidth * scale, copyHeight * scale, 0, 0, copyWidth * scale, copyHeight * scale);

                                                var sourceCtx = sourceCanvas.getContext('2d');
                                                sourceCtx.clearRect(0, 0, copyWidth, copyHeight);
                                                rectangleSet = true;
                                            }
                                        },
                                        onProgress: function () {
                                            if (rectangleSet === true) {
                                                var copyWidth = myChart.scales["y-axis-0"].width - 9;
                                                var copyHeight = myChart.scales["y-axis-0"].height + 15;

                                                var sourceCtx = myChart.chart.canvas.getContext('2d');
                                                sourceCtx.clearRect(0, 0, copyWidth, copyHeight);
                                            }
                                        }
                                    },
                                    <?php if(isset($identity)&&isset($me->user_detail->rating_info)&& $me->user_detail->rating >= reset($predict_line['x']) && $me->user_detail->rating <= end($predict_line['x'])):?>
                                    annotation: {
                                        annotations: [
                                            {
                                                type: "line",
                                                mode: "vertical",
                                                scaleID: "x-axis-0",
                                                value: <?= $me->user_detail->rating_info ?>,
                                                borderColor: "black",
                                                // label: {
                                                //     // content: "you",
                                                //     // enabled: true,
                                                //     // position: "top"
                                                // }
                                            }
                                        ]
                                    },
                                    <?php endif; ?>
                                },
                            });
                            <?php if(isset($identity)&&isset($me->user_detail->rating_info)):?>
                            var rating_min = <?= reset($predict_line['x']) ?>;
                            var rating_max = <?= end($predict_line['x']) ?>;
                            var scrollvalue = Math.max(0,(<?= $me->user_detail->rating_info?> - rating_min)*1024/(Math.max(1,rating_max-rating_min))-(($(window).width())/2-55));
                            $('.chartAreaWrapper').scrollLeft(scrollvalue);
                            <?php endif;?>
                        }
                    </script>
                </div>
                <div class="text-muted" style="font-size: 12px;">※ 一部環境ではグラフが正常に表示されないことがあります。</div>
            <?php else:?>
                <h4>CPI算出未対応曲です。</h4>
            <?php endif;?>
        </div>
    </div>
</div>
