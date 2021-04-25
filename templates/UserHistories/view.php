<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserHistory $userHistory
 */

$tweet_text = $userHistory->user->user_detail->dj_name.'さんがCPIを更新しました：CPI'.$userHistory->rating_cur_info.' ('.$userHistory->rating_diff_info.") ".$userHistory->standing_cur_info."位程度(".$userHistory->standing_diff_info.")\n";
if($top_change['cpi']!=0)$tweet_text = $tweet_text."更新TOP：".($top_change['title']).' 【'.($lamp_info[$top_change['lamp']]).'】 (適正CPI'.$top_change['cpi'].")\n";

?>
<div class="users view content">
    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <h4 class="mb-0">
                <?= __('Update detail') ?>
                <div style="float:right;display:inline;">
                    <?= $this->Html->link(
                        __('User page'),
                        ['controller'=>'Users', 'action'=>'view',$userHistory->user_id],
                        ['class' => 'btn btn-info'])
                    ?>
                </div>
            </h4>
        </div>
        <div class="card-body pr-3 pl-3">
            <?php if(!$is_permitted):?>
                <div class="text-center pt-5 pb-5"><i class="fas fa-lock fa-3x"></i></div>
            <?php else:?>
                <div class="text-dark">
                    <div class="row">
                        <div class="col-md-5 col-lg-4">
                            <div class="mb-2">
                                <h4 class="card-text" style="display:inline;"><?= $userHistory->user->user_detail->dj_name ?></h4>
                                <h5 class="card-subtitle mb-2 text-muted" style="display:inline;">(<?= $userHistory->user->user_detail->iidx_id ?>)</h5>
                            </div>
                            <div class="mb-2">
                                <h4 class="card-text" style="display:inline;"><?= __('CPI')." : ".$userHistory->rating_cur_info ?></h4>
                                <h5 class="card-subtitle mb-2" style="display:inline;">(<?= $userHistory->rating_diff_info ?>)</h5>
                            </div>
                            <div class="mb-2">
                                <h4 class="card-text" style="display:inline;"><?= __('推定順位')." : ".$userHistory->standing_cur_info ?></h4>
                                <h5 class="card-subtitle mb-2" style="display:inline;">(<?= $userHistory->standing_diff_info ?>)</h5>
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
                            <?php if($userHistory->is_season_change!=0):?>
                                <div class="mb-2">
                                    <h6 class="card-subtitle mb-2" style="display:inline;">
                                        <div class="text-danger">※算出用のアルゴリズムまたは元データに変更があったため、CPIと順位の差分を記録しません。</div>
                                    </h6>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-7 col-lg-8 p-3">
                            <div class="table-responsive table-smart-phone-sm">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <?php foreach(array_reverse([1,2,3,4,5,6,7]) as $i): ?>
                                                <th scope="col" bgcolor=<?= $change_counts_color[$i] ?>><?= $change_counts_label[$i] ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php foreach(array_reverse([1,2,3,4,5,6,7]) as $i): ?>
                                                <td scope="col">+<?= $change_counts[$i] ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class='text-center'>
                        <?php if($mypage):?>
                            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text='<?= $tweet_text ?>' data-url="<?= $this->Url->build(NULL,['fullBase' => true,])?>" data-hashtags="CPI_IIDX" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <?php endif;?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
    <?php if(!$is_permitted):?>
        <div class="card border-secondary mb-3"><div class="text-center pt-5 pb-5"><i class="fas fa-lock fa-3x"></i></div></div>
    <?php else:?>
        <div class="card border-secondary mb-3">
            <div class="card-header padding-sm">
                <h4 class="mb-0">
                    <?= __('Lamp changes') ?>
                </h4>
            </div>
            <div class="card-body tab-content padding-sm">
                <div class="table-responsive table-smart-phone-xx">
                    <table id="lamp-changes" class="table table-bordered" >
                        <thead>
                            <tr class="text-center">
                                <th align="center"><?= __('Title') ?></th>
                                <th align="center"><?= __('Lamp before') ?></th>
                                <th align="center"><?= __('Lamp cur') ?></th>
                                <th align="center"><?= __('Fifty CPI') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($changes_table as $row): ?>
                                <tr>
                                <td align="center"><?= $this->Html->link($row['title'], ['controller'=>'Scores','action' => 'view', $row['id']]) ?></td>
                                <td align="center" bgcolor=<?= $change_counts_color[$row['before_lamp']] ?>>
                                    <div class="pc-dsp"><?= $lamp_info[$row['before_lamp']] ?></div>
                                    <div class="sp-dsp"><?= $change_counts_label[$row['before_lamp']] ?></div>
                                </td>
                                <td align="center" bgcolor=<?= $change_counts_color[$row['after_lamp']] ?>>
                                    <div class="pc-dsp"><?= $lamp_info[$row['after_lamp']] ?></div>
                                    <div class="sp-dsp"><?= $change_counts_label[$row['after_lamp']] ?></div>
                                </td>
                                <td align="right"><?= $row['fifty_rating'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif;?>
    <?php if($mypage):?>
        <div class="card border-secondary mb-3">
            <div class="card-header padding-sm">
                <h4 class="mb-0">
                    <div class="text-danger">更新の削除</div>
                </h4>
            </div>
            <div class="card-body tab-content padding-sm">
                <p>
                    ※誤ったプレイデータを登録した場合を想定した機能です</br>
                    更新の削除を行うと、更新履歴からこの更新が削除され、全ての曲のランプがNO PLAYに戻り、CPIはデフォルト値にリセットされます。</br>
                </p>
                <div class="text-center">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userHistory->id], ['class'=>'btn btn-danger', 'confirm' => __('Are you sure you want to delete?', $userHistory->id)]) ?>
                </div>
            </div>
        </div>
    <?php endif;?>
</div>
