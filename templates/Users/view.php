<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users view content">
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h3 class="card-title" style="display:inline;"><?= $user->user_detail->dj_name ?></h3>
            <h5 class="card-subtitle mb-2 text-muted" style="display:inline;"><?= $user->user_detail->iidx_id ?></h5>
            <h4 class="card-title" style="display:inline;">　</h4>
            <?= $this->Html->link(
                __('更新'),
                ['action' => 'edit', $user->id],
                ['class' => 'btn btn-outline-primary my-auto', 'style' => "float:right;display:inline;"])
            ?>
        </div>
        <div class="card-body text-dark">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-4">
                        <h3 class="card-text" style="display:inline;"><?= __('CP')." : ".$user->user_detail->rating ?></h3>
                    </div>
                    <div class="mb-2">
                        <h5 class="card-title" style="display:inline;">段位</h5>
                        <h6 class="card-subtitle mb-2 text-muted" style="display:inline;">SP/DP</h6>
                        <h5 class="card-text" style="display:inline;">
                            <?= $user->user_detail->grade_sp_info ?> /
                            <?= $user->user_detail->grade_dp_info ?>
                        </h5>
                    </div>
                    <div class="mb-2">
                        <h5 class="card-title" style="display:inline;">アリーナ</h5>
                        <h6 class="card-subtitle mb-2 text-muted" style="display:inline;">SP/DP</h6>
                        <h5 class="card-text" style="display:inline;">
                            <?= $user->user_detail->arena_sp_info ?> /
                            <?= $user->user_detail->arena_dp_info ?>
                        </h5>
                    </div>
                    <div class="mb-0">
                        <p class="card-text">Twitter : 
                            <?php if(isset($user->user_detail->twitter_id)): ?>
                                <a href="https://twitter.com/<?= $user->user_detail->twitter_id ?>" class="card-link" style="display:inline;" target="_blank">
                                    <?= "@".$user->user_detail->twitter_id ?>
                                </a>
                            <?php endif; ?>
                            </br>
                            <?= __('Created at')." : ".$user->user_detail->created_at->format('Y/m/d') ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                </div>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            <?= __('Updated at')." : ".$user->user_detail->modified_at->format('Y/m/d') ?>
        </div>
    </div>

    <div class="card border-secondary mb-3">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#lamps" data-toggle="tab">SP☆12<?= __('Lamps Detail') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#recommended" data-toggle="tab"><?= __('Recommended') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#better-than-expected" data-toggle="tab"><?= __('Better than expected') ?></a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div id="lamps" class="tab-pane fade show active">

                <div class="card mb-3">
                    <h5 class="card-header bg-info filter-header">
                        <a data-toggle="collapse" href="#collapse-f-lamp-detail" aria-expanded="true" aria-controls="collapse-f-lamp-detail" id="filter-lamp-detail" class="d-block">
                            <i class="fas fa-filter mr-2"></i>
                            <i class="fa fa-chevron-down float-right"></i>
                                絞り込み
                        </a>
                    </h5>
                    <div id="collapse-f-lamp-detail" class="collapse show" aria-labelledby="filter-lamp-detail">
                        <div class="card-body">
                            <form action="#" data-persist=”garlic” >
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <h5 class="card-title">
                                            バージョン
                                            <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="checkTrue(0,21)">全てチェック</a></div>
                                            <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="checkFalse(0,21)">全て非チェック</a></div>
                                        </h5>
                                        <ul>
                                        <label class=mr-3><input type="checkbox" name="5th style" checked="checked"/>5th style</label>
                                        <label class=mr-3><input type="checkbox" name="6th style" checked="checked"/>6th style</label>
                                        <label class=mr-3><input type="checkbox" name="7th style" checked="checked"/>7th style</label>
                                        <label class=mr-3><input type="checkbox" name="8th style" checked="checked"/>8th style</label>
                                        <label class=mr-3><input type="checkbox" name="9th style" checked="checked"/>9th style</label>
                                        <label class=mr-3><input type="checkbox" name="10th style" checked="checked"/>10th style</label>
                                        <label class=mr-3><input type="checkbox" name="IIDX RED" checked="checked"/>IIDX RED</label>
                                        <label class=mr-3><input type="checkbox" name="HAPPY SKY" checked="checked"/>HAPPY SKY</label>
                                        <label class=mr-3><input type="checkbox" name="DistorteD" checked="checked"/>DistorteD</label>
                                        <label class=mr-3><input type="checkbox" name="GOLD" checked="checked"/>GOLD</label>
                                        <label class=mr-3><input type="checkbox" name="DJ TROOPERS" checked="checked"/>DJ TROOPERS</label>
                                        <label class=mr-3><input type="checkbox" name="EMPRESS" checked="checked"/>EMPRESS</label>
                                        <label class=mr-3><input type="checkbox" name="SIRIUS" checked="checked"/>SIRIUS</label>
                                        <label class=mr-3><input type="checkbox" name="Resort Anthem" checked="checked"/>Resort Anthem</label>
                                        <label class=mr-3><input type="checkbox" name="Lincle" checked="checked"/>Lincle</label>
                                        <label class=mr-3><input type="checkbox" name="tricoro" checked="checked"/>tricoro</label>
                                        <label class=mr-3><input type="checkbox" name="SPADA" checked="checked"/>SPADA</label>
                                        <label class=mr-3><input type="checkbox" name="PENDUAL" checked="checked"/>PENDUAL</label>
                                        <label class=mr-3><input type="checkbox" name="copula" checked="checked"/>copula</label>
                                        <label class=mr-3><input type="checkbox" name="SINOBUZ" checked="checked"/>SINOBUZ</label>
                                        <label class=mr-3><input type="checkbox" name="CANNON BALLERS" checked="checked"/>CANNON BALLERS</label>
                                        <label class=mr-3><input type="checkbox" name="Rootage" checked="checked"/>Rootage</label>
                                        </ul>
                                    </li>
                                    <hr>
                                    <li class="nav-item">
                                        <h5 class="card-title">
                                            現ランプ
                                            <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="checkTrue(22,29)">全てチェック</a></div>
                                            <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="checkFalse(22,29)">全て非チェック</a></div>
                                        </h5>
                                        <ul>
                                        <label class=mr-3><input type="checkbox" name="mynp" checked="checked"/>NOPLAY</label>
                                        <label class=mr-3><input type="checkbox" name="myfa" checked="checked"/>FAILED</label>
                                        <label class=mr-3><input type="checkbox" name="myae" checked="checked"/>ASSITED</label>
                                        <label class=mr-3><input type="checkbox" name="myes" checked="checked"/>EASY</label>
                                        <label class=mr-3><input type="checkbox" name="mycl" checked="checked"/>CLEAR</label>
                                        <label class=mr-3><input type="checkbox" name="myhd" checked="checked"/>HARD</label>
                                        <label class=mr-3><input type="checkbox" name="myex" checked="checked"/>EXHARD</label>
                                        <label class=mr-3><input type="checkbox" name="myfc" checked="checked"/>FC</label>
                                        </ul>
                                    </li>
                                    <hr>
                                    <li class="nav-item">
                                        <h5 class="card-title">
                                            目標ランプ
                                            <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="checkTrue(30,34)">全てチェック</a></div>
                                            <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="checkFalse(30,34)">全て非チェック</a></div>
                                        </h5>
                                        <ul>
                                        <label class=mr-3><input type="checkbox" name="tares" checked="checked"/>EASY</label>
                                        <label class=mr-3><input type="checkbox" name="tarcl" checked="checked"/>CLEAR</label>
                                        <label class=mr-3><input type="checkbox" name="tarhd" checked="checked"/>HARD</label>
                                        <label class=mr-3><input type="checkbox" name="tarex" checked="checked"/>EXHARD</label>
                                        <label class=mr-3><input type="checkbox" name="tarfc" checked="checked"/>FC</label>
                                        <ul>
                                    </li>
                                </ul>
                                <input type="checkbox" id="dummycheck" checked="checked" style="display:none;" disabled="disabled" >
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="lamp-detail" class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th align="center"><?= __('version') ?></th>
                                <th align="center"><?= __('title') ?></th>
                                <th align="center"><?= __('lamp') ?></th>
                                <th><?= __('fifty_rating') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_table as $row): ?>
                            <tr>
                                <td align="center"><?= h($row['version']) ?></td>
                                <td align="center"><?= h($row['title']) ?></td>
                                <td align="center" bgcolor=<?= h($row['lamp_color']) ?>><?= h($row['lamp']) ?></td>
                                <td align="right"><?php echo $row['fifty_rating']!=-1?(sprintf('%.2f',$row['fifty_rating'])):("-"); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="recommended" class="tab-pane fade">
                <div class="table-responsive">
                    <table id="rec-table" class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th align="center" ><?= __('version') ?></th>
                                <th align="center" ><?= __('title') ?></th>
                                <th align="center" ><?= __('lamp_cur') ?></th>
                                <th align="center" ><?= __('lamp_tar') ?></th>
                                <th><?= __('probability') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rec_table as $row): ?>
                            <tr>
                                <td align="center"><?= h($row['version']) ?></td>
                                <td align="center"><?= h($row['title']) ?></td>
                                <td align="center" bgcolor=<?= h($row['lamp_cur_color']) ?>><?= h($row['lamp_cur']) ?></td>
                                <td align="center" bgcolor=<?= h($row['lamp_tar_color']) ?>><?= h($row['lamp_tar']) ?></td>
                                <td align="right"><?php echo sprintf('%.2f %%',$row['probability']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="better-than-expected" class="tab-pane fade">
                <div class="table-responsive">
                    <table id="bte-table" class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th align="center"><?= __('version') ?></th>
                                <th align="center"><?= __('title') ?></th>
                                <th align="center"><?= __('lamp') ?></th>
                                <th><?= __('probability') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bte_table as $row): ?>
                            <tr>
                                <td align="center"><?= h($row['version']) ?></td>
                                <td align="center"><?= h($row['title']) ?></td>
                                <td align="center" bgcolor=<?= h($row['lamp_color']) ?>><?= h($row['lamp']) ?></td>
                                <td align="right"><?php echo sprintf('%.2f %%',$row['probability']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
