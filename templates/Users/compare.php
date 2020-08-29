<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users compare content">
    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <h4 class="mb-0">
                <?= __('Compare') ?>
                <div style="float:right;display:inline;">
                    <?= $this->Html->link(
                        __('User page'),
                        ['controller'=>'Users', 'action'=>'view',$rival->id],
                        ['class' => 'btn btn-info'])
                    ?>
                </div>
            </h4>
        </div>
        <div class="card-body pr-3 pl-3 text-dark">

        </div>
    </div>

    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <h4 class="mb-0">
                <?= __('Lamps Detail') ?>
            </h4>
        </div>
        <div class="card-body tab-content padding-sm">
            <div class="card mb-3">
                <h5 class="card-header bg-info filter-header">
                    <a data-toggle="collapse" href="#collapse-f-lamp-compare" aria-expanded="false" aria-controls="collapse-f-lamp-compare" id="filter-lamp-compare" class="d-block">
                        <i class="fas fa-filter mr-2"></i>
                        <i class="fa fa-chevron-down float-right"></i>
                            絞り込み
                    </a>
                </h5>
                <div id="collapse-f-lamp-compare" class="collapse" aria-labelledby="filter-lamp-compare">
                    <div class="card-body">
                        <form action="#" name="compare-form" data-persist=”garlic” >
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <h5 class="card-title">
                                        バージョン
                                        <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('compare-form','versions',true);">全てチェック</a></div>
                                        <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('compare-form','versions',false);">全て非チェック</a></div>
                                    </h5>
                                    <ul>
                                        <?php foreach ($display_info['version'] as $_ver): ?>
                                            <label class=mr-3><input type="checkbox" name="<?= $_ver ?>" checked="checked"/><?= $_ver ?></label>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <hr>
                                <li class="nav-item">
                                    <h5 class="card-title">
                                        自分
                                        <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('compare-form','my_lamps',true);">全てチェック</a></div>
                                        <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('compare-form','my_lamps',false);">全て非チェック</a></div>
                                    </h5>
                                    <ul>
                                        <?php foreach ($display_info['cur_lamp'] as $_lamp): ?>
                                            <label class=mr-3><input type="checkbox" name="<?= 'my_'.$_lamp ?>" checked="checked"/><?= $_lamp ?></label>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <hr>
                                <li class="nav-item">
                                    <h5 class="card-title">
                                        相手
                                        <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('compare-form','rival_lamps',true);">全てチェック</a></div>
                                        <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="allCheck('compare-form','rival_lamps',false);">全て非チェック</a></div>
                                    </h5>
                                    <ul>
                                        <?php foreach ($display_info['cur_lamp'] as $_lamp): ?>
                                            <label class=mr-3><input type="checkbox" name="<?= 'rival_'.$_lamp ?>" checked="checked"/><?= $_lamp ?></label>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <hr>
                                <li class="nav-item">
                                    <h5 class="card-title">
                                        その他
                                    </h5>
                                    <ul style="list-style: none;">
                                        <li><label class=mr-3><input type="checkbox" name="compare_leg_only"/> LEGGENDARIAのみ表示</label></li>
                                        <li><label class=mr-3><input type="checkbox" name="compare_leg_except"/> LEGGENDARIAを非表示</label></li>
                                        <li><label class=mr-3><input type="checkbox" name="compare_except_win"/> 勝っている曲を非表示</label></li>
                                        <li><label class=mr-3><input type="checkbox" name="compare_except_draw"/> 互角の曲を非表示</label></li>
                                        <li><label class=mr-3><input type="checkbox" name="compare_except_lose"/>  負けている曲を非表示</label></li>
                                    </ul>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-smart-phone-xx">
                <table id="lamp-compare" class="table table-bordered" >
                    <thead>
                        <tr class="text-center">
                            <th align="center"><?= __('Version') ?></th>
                            <th align="center"><?= __('Title') ?></th>
                            <th align="center"><?= __('My Lamp') ?></th>
                            <th align="center"><?= __('Rival Lamp') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compare_table as $row): ?>
                            <tr>
                                <td align="center"><?= h($row['version']) ?></td>
                                <td align="center"<?= ($row['diff']>3?" bgcolor='#CC66FF' style='color:#FFFFFF;'":"") ?>><?= h($row['title']) ?></td>
                                <td align="center" bgcolor=<?= h($row['my_lamp_color']) ?>>
                                    <div class="pc-dsp"><?= $display_info['cur_lamp'][$row['my_lamp']] ?></div>
                                    <div class="sp-dsp"><?= $display_info['lamp_short'][$row['my_lamp']] ?></div>
                                </td>
                                <td align="center" bgcolor=<?= h($row['rival_lamp_color']) ?>>
                                    <div class="pc-dsp"><?= $display_info['cur_lamp'][$row['rival_lamp']] ?></div>
                                    <div class="sp-dsp"><?= $display_info['lamp_short'][$row['rival_lamp']] ?></div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>