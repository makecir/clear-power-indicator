<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users view content">
    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <h3 class="card-title" style="display:inline;"><?= $user->user_detail->dj_name ?></h3>
            <h5 class="card-subtitle mb-2 text-muted" style="display:inline;"><?= $user->user_detail->iidx_id ?></h5>
            <?php if(!$isLoggedIn):?>
            <?php elseif($mypage):?>
                <?= $this->Html->link(
                    __('更新'),
                    ['action' => 'edit', $user->id],
                    ['class' => 'btn btn-primary my-auto', 'style' => "float:right;display:inline;"])
                ?>
            <?php else: ?>
                <?= $this->Html->link(
                    __($follow_flag?'フォロー解除':'フォロー'),
                    ['action' => 'following', $identity->id, $user->id],
                    ['class' => 'btn btn'.($follow_flag?'':'-outline').'-success my-auto', 'style' => "float:right;display:inline;"])
                ?>
            <?php endif; ?>
        </div>
        <div class="card-body text-dark pr-3 pl-3">
            <div class="row">
                <div class="col-md-5 col-lg-4">
                    <div class="mb-4">
                        <div class="mb-1"><h3 class="card-text" style="display:inline;"><?= __('CPI')." : ".($user->user_detail->rating?sprintf('%.2f',$user->user_detail->rating):'') ?></h3></div>
                        <h6 class="card-text" style="display:inline;"><?= __('(推定 : ')?></h6>
                        <h5 class="card-text" style="display:inline;"><?= $user->user_detail->rating_info ?></h5>
                        <h6 class="card-text" style="display:inline;"><?= __('位程度)') ?></h6>
                        <span data-toggle="tooltip" data-html="true" title=
                            <?= "'大まかな目安です</br>詳しくは".
                                $this->Html->link(
                                    'こちら',
                                    ['controller' => 'Pages', 'action' => 'about', '#'=>'numerical-value'],
                                ).
                                "をご覧下さい'" 
                            ?> class="text-nowrap" data-trigger="click">
                            <i class="fas fa-question-circle"></i>
                        </span>
                    </div>
                    <div class="mb-2">
                        <h5 class="card-title" style="display:inline;">段位</h5>
                        <h5 class="card-text" style="display:inline;">
                            <?= $user->user_detail->grade_sp!=0?"SP":"" ?><?= $user->user_detail->grade_sp_info ?> /
                            <?= $user->user_detail->grade_dp!=0?"DP":"" ?><?= $user->user_detail->grade_dp_info ?>
                        </h5>
                    </div>
                    <div class="mb-2">
                        <h5 class="card-title" style="display:inline;">アリーナ</h5>
                        <h5 class="card-text" style="display:inline;">
                            <?= $user->user_detail->arena_sp!=0?"SP ":"" ?><?= $user->user_detail->arena_sp_info ?> /
                            <?= $user->user_detail->arena_dp!=0?"DP ":"" ?><?= $user->user_detail->arena_dp_info ?>
                        </h5>
                    </div>
                    <div class="mb-0">
                        <p class="card-text">Twitter : 
                            <?php if(isset($user->user_detail->twitter_id) && ($user->user_detail->twitter_id !== "")): ?>
                                <a href="https://twitter.com/<?= $user->user_detail->twitter_id ?>" class="card-link" style="display:inline;" target="_blank">
                                    <?= "@".$user->user_detail->twitter_id ?>
                                </a>
                            <?php endif; ?>
                            </br>
                            <?= __('Created at')." : ".($is_permitted ? $user->user_detail->created_at->format('Y/m/d'):'<i class="fas fa-lock"></i>') ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-7 col-lg-8 p-3">
                    <div class="table-responsive table-smart-phone-sm">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <?php foreach(array_reverse([0,1,2,3,4,5,6,7]) as $i): ?>
                                        <th scope="col"  bgcolor=<?= $checkbox['color'][$i] ?>><?= $checkbox['lamp_short'][$i] ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach(array_reverse([0,1,2,3,4,5,6,7]) as $i): ?>
                                        <td scope="col"><?= $lamp_counts[$i] ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="progress mb-3">
                        <?php foreach(array_reverse([0,1,2,3,4,5,6,7]) as $i): ?>
                            <div class="progress-bar progress-bar-<?= $checkbox['lamp_class'][$i] ?>" role="progressbar" style="width: <?= $lamp_counts[$i] ?>%" aria-valuenow="<?= $lamp_counts[$i] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            <?= __('Updated at')." : ".($is_permitted ? $user->user_detail->modified_at->format('Y/m/d'):'<i class="fas fa-lock"></i>') ?>
        </div>
    </div>
    <?php if(!$is_permitted):?>
        <div class="card border-secondary mb-3"><div class="text-center pt-5 pb-5"><i class="fas fa-lock fa-3x"></i></div></div>
    <?php else:?>
        <div class="card border-secondary mb-3">
            <div class="card-header padding-sm">
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
                    <li class="nav-item">
                        <a class="nav-link" href="#histories" data-toggle="tab"><?= __('Histories') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#followings" data-toggle="tab"><?= __('Followings') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#followers" data-toggle="tab"><?= __('Followers') ?></a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content padding-sm">
                <div id="lamps" class="tab-pane fade show active">
                    <div class="card mb-3">
                        <h5 class="card-header bg-info filter-header">
                            <a data-toggle="collapse" href="#collapse-f-lamp-detail" aria-expanded="false" aria-controls="collapse-f-lamp-detail" id="filter-lamp-detail" class="d-block">
                                <i class="fas fa-filter mr-2"></i>
                                <i class="fa fa-chevron-down float-right"></i>
                                    絞り込み
                            </a>
                        </h5>
                        <div id="collapse-f-lamp-detail" class="collapse" aria-labelledby="filter-lamp-detail">
                            <div class="card-body">
                                <form action="#" name="detail-form" data-persist=”garlic” >
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                バージョン
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('detail-form','versions',true);">全てチェック</a></div>
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('detail-form','versions',false);">全て非チェック</a></div>
                                            </h5>
                                            <ul>
                                                <?php foreach ($checkbox['version'] as $_ver): ?>
                                                    <label class=mr-3><input type="checkbox" name="<?= $_ver ?>" checked="checked"/><?= $_ver ?></label>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <hr>
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                現ランプ
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('detail-form','cur_lamps',true);">全てチェック</a></div>
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('detail-form','cur_lamps',false);">全て非チェック</a></div>
                                            </h5>
                                            <ul>
                                                <?php foreach ($checkbox['cur_lamp'] as $_lamp): ?>
                                                    <label class=mr-3><input type="checkbox" name="<?= 'cur_'.$_lamp ?>" checked="checked"/><?= $_lamp ?></label>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <hr>
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                その他
                                            </h5>
                                            <ul style="list-style: none;">
                                                <li><label class=mr-3><input type="checkbox" name="detail_leg_only"/> LEGGENDARIAのみ表示</label></li>
                                                <li><label class=mr-3><input type="checkbox" name="detail_leg_except"/> LEGGENDARIAを非表示</label></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive  table-smart-phone-x">
                        <table  id="lamp-detail" class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th align="center"><?= __('Version') ?></th>
                                    <th align="center"><?= __('Title') ?></th>
                                    <th align="center"><?= __('Lamp') ?></th>
                                    <th><?= __('Fifty CPI') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail_table as $row): ?>
                                <tr>
                                    <td align="center"><?= h($row['version']) ?></td>
                                    <td align="center"<?= ($row['diff']>3?" bgcolor='#CC66FF' style='color:#FFFFFF;'":"") ?>><?= h($row['title']) ?></td>
                                    <td align="center" bgcolor=<?= h($row['lamp_color']) ?>><?= h($row['lamp']) ?></td>
                                    <td align="right"><?php echo $row['fifty_rating']!=-1?(sprintf('%.2f',$row['fifty_rating'])):("-"); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="recommended" class="tab-pane fade">
                    <div class="card mb-3">
                        <h5 class="card-header bg-info filter-header">
                            <a data-toggle="collapse" href="#collapse-f-lamp-detail" aria-expanded="false" aria-controls="collapse-f-lamp-detail" id="filter-lamp-detail" class="d-block">
                                <i class="fas fa-filter mr-2"></i>
                                <i class="fa fa-chevron-down float-right"></i>
                                    絞り込み
                            </a>
                        </h5>
                        <div id="collapse-f-lamp-detail" class="collapse" aria-labelledby="filter-lamp-detail">
                            <div class="card-body">
                                <form action="#" name="rec-form" data-persist=”garlic” >
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                バージョン
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('rec-form','versions',true);">全てチェック</a></div>
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('rec-form','versions',false);">全て非チェック</a></div>
                                            </h5>
                                            <ul>
                                                <?php foreach ($checkbox['version'] as $_ver): ?>
                                                    <label class=mr-3><input type="checkbox" name="<?= $_ver ?>" checked="checked"/><?= $_ver ?></label>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <hr>
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                現ランプ
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('rec-form','cur_lamps',true);">全てチェック</a></div>
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('rec-form','cur_lamps',false);">全て非チェック</a></div>
                                            </h5>
                                            <ul>
                                                <?php foreach ($checkbox['cur_lamp'] as $_lamp): ?>
                                                    <label class=mr-3><input type="checkbox" name="<?= 'cur_'.$_lamp ?>" checked="checked"/><?= $_lamp ?></label>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <hr>
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                目標ランプ
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('rec-form','tar_lamps',true);">全てチェック</a></div>
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('rec-form','tar_lamps',false);">全て非チェック</a></div>
                                            </h5>
                                            <ul>
                                                <?php foreach ($checkbox['tar_lamp'] as $_lamp): ?>
                                                    <label class=mr-3><input type="checkbox" name="<?= 'tar_'.$_lamp ?>" checked="checked"/><?= $_lamp ?></label>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <hr>
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                クリア確率
                                            </h5>
                                            <ul>
                                                <div class="form-row">
                                                    <div class="col-6">
                                                        <?= $this->Form->control('rec_min',['label' => 'min', 'name'=>'rec_min', 'class' => 'form-control mb-3', 'type' => 'number', 'step' => '0.01', 'value'=>'0.00', 'placeholder'=>'0.00', 'required' => true]); ?>
                                                    </div>
                                                    <div class="col-6">
                                                        <?= $this->Form->control('rec_max',['label' => 'max', 'name'=>'rec_max', 'class' => 'form-control mb-3', 'type' => 'number', 'step' => '0.01', 'value'=>'100.00', 'placeholder'=>'100.00', 'required' => true]); ?>
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                        <hr>
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                その他
                                            </h5>
                                            <ul style="list-style: none;">
                                                <li><label class=mr-3><input type="checkbox" name="rec_one_step"/> 現ランプの次のランプのみ表示</label></li>
                                                <li><label class=mr-3><input type="checkbox" name="rec_leg_only"/> LEGGENDARIAのみ表示</label></li>
                                                <li><label class=mr-3><input type="checkbox" name="rec_leg_except"/> LEGGENDARIAを非表示</label></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-smart-phone-xx">
                        <table id="rec-table" class="table table-bordered" >
                            <thead>
                                <tr class="text-center">
                                    <th align="center"><?= __('Version') ?></th>
                                    <th align="center"><?= __('Title') ?></th>
                                    <th align="center"><?= __('Lamp cur') ?></th>
                                    <th align="center"><?= __('Lamp tar') ?></th>
                                    <th><?= __('Clear Prob') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rec_table as $row): ?>
                                    <tr>
                                    <td align="center"><?= h($row['version']) ?></td>
                                    <td align="center"<?= ($row['diff']>3?" bgcolor='#CC66FF' style='color:#FFFFFF;'":"") ?>><?= h($row['title']) ?></td>
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
                    <div class="card mb-3">
                        <h5 class="card-header bg-info filter-header">
                            <a data-toggle="collapse" href="#collapse-f-lamp-detail" aria-expanded="false" aria-controls="collapse-f-lamp-detail" id="filter-lamp-detail" class="d-block">
                                <i class="fas fa-filter mr-2"></i>
                                <i class="fa fa-chevron-down float-right"></i>
                                    絞り込み
                            </a>
                        </h5>
                        <div id="collapse-f-lamp-detail" class="collapse" aria-labelledby="filter-lamp-detail">
                            <div class="card-body">
                                <form action="#" name="bte-form" data-persist=”garlic” >
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                バージョン
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('bte-form','versions',true);">全てチェック</a></div>
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('bte-form','versions',false);">全て非チェック</a></div>
                                            </h5>
                                            <ul>
                                                <?php foreach ($checkbox['version'] as $_ver): ?>
                                                    <label class=mr-3><input type="checkbox" name="<?= $_ver ?>" checked="checked"/><?= $_ver ?></label>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <hr>
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                現ランプ
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('bte-form','cur_lamps',true);">全てチェック</a></div>
                                                <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('bte-form','cur_lamps',false);">全て非チェック</a></div>
                                            </h5>
                                            <ul>
                                                <?php foreach ($checkbox['tar_lamp'] as $_lamp): ?>
                                                    <label class=mr-3><input type="checkbox" name="<?= 'cur_'.$_lamp ?>" checked="checked"/><?= $_lamp ?></label>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <hr>
                                        <li class="nav-item">
                                            <h5 class="card-title">
                                                クリア確率
                                            </h5>
                                            <ul>
                                                <div class="form-row">
                                                    <div class="col-3">
                                                        <?= $this->Form->control('bte_min',['label' => 'min', 'name'=>'bte_min', 'class' => 'form-control mb-3', 'type' => 'number', 'step' => '0.01', 'value'=>'0.00', 'placeholder'=>'0.00', 'required' => true]); ?>
                                                    </div>
                                                    <div class="col-3">
                                                        <?= $this->Form->control('bte_max',['label' => 'max', 'name'=>'bte_max', 'class' => 'form-control mb-3', 'type' => 'number', 'step' => '0.01', 'value'=>'50.00', 'placeholder'=>'50.00', 'required' => true]); ?>
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-smart-phone-xx">
                        <table id="bte-table" class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th align="center"><?= __('Version') ?></th>
                                    <th align="center"><?= __('Title') ?></th>
                                    <th align="center"><?= __('Lamp') ?></th>
                                    <th><?= __('Clear Prob') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bte_table as $row): ?>
                                <tr>
                                    <td align="center"><?= h($row['version']) ?></td>
                                    <td align="center"<?= ($row['diff']>3?" bgcolor='#CC66FF' style='color:#FFFFFF;'":"") ?>><?= h($row['title']) ?></td>
                                    <td align="center" bgcolor=<?= h($row['lamp_color']) ?>><?= h($row['lamp']) ?></td>
                                    <td align="right"><?php echo sprintf('%.2f %%',$row['probability']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="histories" class="tab-pane fade">
                    <?php if(!($mypage || $follow_flag)):?>
                        <div class="card border-secondary mb-3"><div class="text-center pt-5 pb-5"><i class="fas fa-lock"> 本人かフォロワーのみ閲覧可能です</i></div></div>
                    <?php else:?>
                        <div class="table-responsive table-smart-phone-sm">
                            <table id="histories-table" class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th align="center"><?= __('Date') ?></th>
                                        <th align="center"><?= __('CPI') ?></th>
                                        <th align="center"><?= __('Diff') ?></th>
                                        <th align="center"><?= __('#') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_reverse($user->user_histories) as $row): ?>
                                        <tr>
                                            <td align="center"><?= h($row->created_at->format('Y/m/d')) ?></td>
                                            <td align="center"><?= h($row->rating_cur_info) ?></td>
                                            <td align="center"><?= h($row->rating_diff_info) ?></td>
                                            <td align="center">
                                                <?= $this->Html->link(
                                                    __('Detail'),
                                                    ['controller' => 'UserHistories','action' => 'view', $row->id],
                                                    ['class' => 'btn btn-sm btn-info my-auto'])
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif;?>
                </div>

                <div id="followings" class="tab-pane fade">
                    <?php if(!$mypage):?>
                        <div class="card border-secondary mb-3"><div class="text-center pt-5 pb-5"><i class="fas fa-lock"> 本人のみ閲覧可能です</i></div></div>
                    <?php else:?>
                        <div class="table-responsive table-smart-phone-x">
                            <table id="following-table" class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th align="center"><?= __('DJname') ?></th>
                                        <th align="center"><?= __('CPI') ?></th>
                                        <th align="center"><?= __('Lamp') ?></th>
                                        <th align="center"><?= __('Updated at') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($follow_compare_table as $row): ?>
                                        <tr>
                                            <td align="center"><?= $this->Html->link($row['dj_name'], ['action' => 'view', $row['id']]) ?></td>
                                            <td align="center"><?= h(($row['rating']?sprintf('%.2f',$row['rating']):'')) ?></td>
                                            <td align="center">
                                                <div class="progress mb-3">
                                                    <?php foreach(array_reverse([0,1,2,3,4,5,6,7]) as $i): ?>
                                                        <div class="progress-bar progress-bar-<?= $checkbox['lamp_class'][$i] ?>" role="progressbar" style="width: <?= $row['lamp_counts'][$i] ?>%" aria-valuenow="<?= $row['lamp_counts'][$i] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </td>
                                            <td align="center"><?= h($row['update']->format('Y/m/d')) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif;?>
                </div>
                
                <div id="followers" class="tab-pane fade">
                    <?php if(!$mypage):?>
                        <div class="card border-secondary mb-3"><div class="text-center pt-5 pb-5"><i class="fas fa-lock"> 本人のみ閲覧可能です</i></div></div>
                    <?php else:?>
                        <div class="table-responsive table-smart-phone-x">
                            <table id="follower-table" class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th align="center"><?= __('DJ NAME') ?></th>
                                        <th align="center"><?= __('IIDX ID') ?></th>
                                        <th align="center"><?= __('CPI') ?></th>
                                        <th align="center"><?= __('SP Grade') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user->followed_users as $row): ?>
                                        <tr>
                                            <td align="center"><?= $this->Html->link($row->user_detail->dj_name, ['action' => 'view', $row->id]) ?></td>
                                            <td align="center"><?= h($row->user_detail->iidx_id) ?></td>
                                            <td align="center"><?= h(($user->user_detail->rating?sprintf('%.2f',$user->user_detail->rating):'')) ?></td>
                                            <td align="center"><?= h($row->user_detail->grade_sp_info) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php endif;?>
</div>
