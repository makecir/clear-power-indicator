<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Score[]|\Cake\Collection\CollectionInterface $scores
 */
?>
<div class="scores index content">
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="mb-0">
                <?= "適正CPI一覧" ?>
            </h4>
        </div>
        <div class="card-body text-dark padding-sm">
            <div class="card mb-3">
                <h5 class="card-header bg-info filter-header">
                    <a data-toggle="collapse" href="#collapse-f-scores-index" aria-expanded="false" aria-controls="collapse-f-scores-index" id="filter-scores-index" class="d-block">
                        <i class="fas fa-filter mr-2"></i>
                        <i class="fa fa-chevron-down float-right"></i>
                            絞り込み
                    </a>
                </h5>
                <div id="collapse-f-scores-index" class="collapse" aria-labelledby="filter-scores-index">
                    <div class="card-body">
                        <form action="#" name="scores-form">
                            <ul class="nav flex-column">
                                <?php for($i=3;$i<=7;$i++):?>
                                <li class="nav-item">
                                    <h5 class="card-title">
                                        <?= $display_info['cur_lamp'][$i] ?>
                                        <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="setValue('scores-form',{'<?= $display_info['cur_lamp'][$i] ?>_min':'0.01','<?= $display_info['cur_lamp'][$i] ?>_max':'5000.00',});">リセット</div>
                                    </h5>
                                    <ul>
                                        <div class="form-row">
                                            <div class="col-6">
                                                <?= $this->Form->control($display_info['cur_lamp'][$i].'_min',['label' => 'min', 'name'=>$display_info['cur_lamp'][$i].'_min', 'class' => 'form-control mb-3', 'type' => 'number', 'step' => '0.01', 'value'=>'0.01', 'placeholder'=>'0.01', 'required' => true]); ?>
                                            </div>
                                            <div class="col-6">
                                                <?= $this->Form->control($display_info['cur_lamp'][$i].'_max',['label' => 'max', 'name'=>$display_info['cur_lamp'][$i].'_max', 'class' => 'form-control mb-3', 'type' => 'number', 'step' => '0.01', 'value'=>'5000.00', 'placeholder'=>'5000.00', 'required' => true]); ?>
                                            </div>
                                        </div>
                                    </ul>
                                </li>
                                <hr>
                                <?php endfor;?>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="scores-index" class="table table-hover table-smart-phone-xx">
                    <thead>
                        <tr>
                            <th><?= __('TITLE') ?></th>
                            <?php for($i=3 ; $i<=7 ; $i++): ?>
                                <th align="center" bgcolor=<?= $display_info['color'][$i] ?>>
                                    <div class="score-index-lg-dsp"><div style="width:4.5rem;"><?= $display_info['cur_lamp'][$i] ?></div></div>
                                    <div class="score-index-md-dsp"><?= $display_info['lamp_short'][$i] ?></div>
                                </th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($scores as $score): ?>
                        <tr>
                            <td><?= $this->Html->link($score->title_info, ['action' => 'view', $score->id]) ?></td>
                            <td align="center" bgcolor=<?= $display_info['color_light'][3] ?>><?= $score->fifty_rating_easy ?></td>
                            <td align="center" bgcolor=<?= $display_info['color_light'][4] ?>><?= $score->fifty_rating_clear ?></td>
                            <td align="center" bgcolor=<?= $display_info['color_light'][5] ?>><?= $score->fifty_rating_hard ?></td>
                            <td align="center" bgcolor=<?= $display_info['color_light'][6] ?>><?= $score->fifty_rating_exhard ?></td>
                            <td align="center" bgcolor=<?= $display_info['color_light'][7] ?>><?= $score->fifty_rating_fc ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
