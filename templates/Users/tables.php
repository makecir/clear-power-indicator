<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
$color_info=[
    0 => "#FFFFFF",
    1 => "#CCCCCC",
    2 => "#FF66CC",
    3 => "#99FF99",
    4 => "#99CCFF",
    5 => "#FF6666",
    6 => "#FFFF99",
    7 => "#FF9966",
];
$tables_id=["easy","clear","hard","exh","fc"];
?>
<style type="text/css">
    td a:link,td a:visited,td a:hover,td a:active      {display:block;width:100%;height:100%;color: inherit;}
</style>
<div class="users tables content">

    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <h4 class="card-title" style="display:inline;"><?= $user->user_detail->dj_name ?></h4>
            <h6 class="card-subtitle mb-2 text-muted" style="display:inline;"><?= $user->user_detail->iidx_id ?></h6>
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
            <div class="row mb-3">
                <div class="col-md-5 col-lg-4">
                    <div class="mb-4">
                        <div class="mb-1"><h3 class="card-text" style="display:inline;"><?= __('CPI')." : ".($user->user_detail->rating?sprintf('%.2f',$user->user_detail->rating):'') ?></h3></div>
                        <h6 class="card-text" style="display:inline;"><?= __('(推定 : ')?></h6>
                        <h5 class="card-text" style="display:inline;"><?= $user->user_detail->standing_info ?></h5>
                        <h6 class="card-text" style="display:inline;"><?= __('位程度)') ?></h6>
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
                                        <th scope="col" bgcolor=<?= $checkbox['color'][$i] ?>><?= $checkbox['lamp_short'][$i] ?></th>
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
            <div class='text-center'>
                <?= $this->Html->link(
                    __('User page'),
                    ['controller'=>'Users', 'action'=>'view', $user->id],
                    ['class' => 'btn btn-info'])
                ?>
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
            <div class="card-header">
                <h4 class="mb-2">
                    <?= "CPI難易度表" ?>
                </h4>
                <ul class="nav nav-tabs card-header-tabs">
                    <?php foreach ($tables_id as $i => $table_id): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $i==0?"active":""?>" href="#<?= $table_id ?>" data-toggle="tab"><?= strtoupper($table_id) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-body text-dark tab-content padding-sm">
                <?php foreach ($tables_id as $i => $table_id): ?>
                    <div id="<?= $table_id ?>" class="tab-pane fade <?= $i==0?"show active":""?>">
                        <h3>達成済 <?= $archive_counts[$i][0]."/".$archive_counts[$i][1]." ( 残り".($archive_counts[$i][1]-$archive_counts[$i][0])."譜面 )" ?></h3>
                        <h6>※ 各項目内の譜面は曲名順です </h6>
                        <h6>※ ごく最近の一部譜面については集計の対象外です 詳しくは<?= $this->Html->link(
                                        'こちら',
                                        ['controller' => 'Pages', 'action' => 'about', '#'=>'update'],
                                    ) ?></h6>
                        <div class="table table-responsive table-smart-phone-xx mb-3" style="table-layout: fixed;">
                            <table id="<?= $table_id."_table" ?>" class="table table-bordered">
                                <tbody>
                                    <?php if(count($difficulty_tables[$i]['infinity']??[])!=0): ?>
                                        <tr class="text-center" bgcolor=#444444>
                                            <td colspan="3" align="center" class="text-white"  style="width: 100%;">適正CPI Infinity</td>
                                        </tr>
                                        <?php $col=0;?>
                                        <?php foreach ($difficulty_tables[$i]['infinity'] as $row): ?>
                                            <?php if($col==0): ?><tr><?php endif; ?>
                                                <td align="center" bgcolor=<?= $color_info[$row['lamp']] ?>><?= $this->Html->link($row['title'], ['controller'=>'Scores','action' => 'view', $row['id']]) ?></td>
                                            <?php $col++;?>
                                            <?php if($col==3): $col=0?></tr><?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php if($col!==0): $col=0?></tr><?php endif; ?>
                                        <tr class="blank_row">
                                        <td colspan="1" style="border: 0px none;">&nbsp;</td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php foreach ($difficulty_tables[$i]['rated']??[] as $section_key => $section): ?>
                                        <tr class="text-center" bgcolor=#444444>
                                            <td colspan="3" align="center" class="text-white"  style="width: 100%;">適正CPI <?= (intval($section_key))." ~ ".(intval($section_key)+50) ?></td>
                                        </tr>
                                        <?php $col=0;?>
                                        <?php foreach ($section as $row): ?>
                                            <?php if($col==0): ?><tr><?php endif; ?>
                                                <td align="center" bgcolor=<?= $color_info[$row['lamp']] ?>><?= $this->Html->link($row['title'], ['controller'=>'Scores','action' => 'view', $row['id']]) ?></td>
                                            <?php $col++;?>
                                            <?php if($col==3): $col=0?></tr><?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php if($col!==0): $col=0?></tr><?php endif; ?>
                                    <?php endforeach; ?>
                                    <tr class="blank_row">
                                        <td colspan="1" style="border: 0px none;">&nbsp;</td>
                                    </tr>
                                    <tr class="text-center" bgcolor=#444444>
                                        <td colspan="3" align="center" class="text-white"  style="width: 100%;">適正CPI 算出対象外</td>
                                    </tr>
                                    <?php $col=0;?>
                                    <?php foreach ($difficulty_tables[$i]['unrated']??[] as $row): ?>
                                        <?php if($col==0): ?><tr><?php endif; ?>
                                            <td align="center" bgcolor=<?= $color_info[$row['lamp']] ?>><?= $this->Html->link($row['title'], ['controller'=>'Scores','action' => 'view', $row['id']]) ?></td>
                                        <?php $col++;?>
                                        <?php if($col==3): $col=0?></tr><?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if($col!==0): $col=0?></tr><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif;?>
</div>
