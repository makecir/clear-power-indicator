<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
$tables_id=["easy","clear","hard","exh","fc"];
$tweet_text_tables = 'CPI難易度表はこちら';
?>
<style type="text/css">
    td a:link,td a:visited,td a:hover,td a:active      {display:block;width:100%;height:100%;color: inherit;}
</style>
<div class="scoress tables content">
        <div class="card border-secondary mb-3">
            <div class="card-header">
                <div class="mb-2" >
                    <h4 class="mb-2" style="display:inline;">
                        <?= "CPI難易度表" ?>
                    </h4>
                    <div class='text-right mb-1' id="lamp-tweet"  style="float:right;display:inline;">
                        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text='<?= $tweet_text_tables ?>' data-url="<?= $this->Url->build(NULL,['fullBase' => true,])?>" data-hashtags="CPI_IIDX" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
                <ul class="nav nav-tabs card-header-tabs">
                    <?php foreach ($tables_id as $i => $table_id): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $i==0?"active":""?>" href="#<?= $table_id ?>" data-toggle="tab"><?= strtoupper($table_id) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-body text-dark tab-content padding-sm">
            <?php if($isLoggedIn):?>
                <?= $this->Html->link(
                    __('マイ難易度表'),
                    ['controller' => 'Users', 'action' => 'tables', $identity->id],
                    ['class' => 'btn btn-success my-auto', 'style' => "float:right;display:inline;"])
                ?>
            <?php endif; ?>
                <?php foreach ($tables_id as $i => $table_id): ?>
                    <div id="<?= $table_id ?>" class="tab-pane fade <?= $i==0?"show active":""?>">
                        <div class="mb-3">
                            <h3>全 <?= $archive_counts[$i]['sum'][1]." 譜面" ?></h3>
                        </div>
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
                                                <td align="center"?><?= $this->Html->link($row['title'], ['controller'=>'Scores','action' => 'view', $row['id']]) ?></td>
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
                                                <td align="center"?><?= $this->Html->link($row['title'], ['controller'=>'Scores','action' => 'view', $row['id']]) ?></td>
                                            <?php $col++;?>
                                            <?php if($col==3): $col=0?></tr><?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php if($col!==0): $col=0?></tr><?php endif; ?>
                                    <?php endforeach; ?>
                                    <tr class="blank_row">
                                        <td colspan="1" style="border: 0px none;">&nbsp;</td>
                                    </tr>
                                    <tr class="text-center" bgcolor=#444444>
                                        <td colspan="3" align="center" class="text-white" style="width: 100%;">適正CPI 算出対象外</td>
                                    </tr>
                                    <?php $col=0;?>
                                    <?php foreach ($difficulty_tables[$i]['unrated']??[] as $row): ?>
                                        <?php if($col==0): ?><tr><?php endif; ?>
                                            <td align="center"?><?= $this->Html->link($row['title'], ['controller'=>'Scores','action' => 'view', $row['id']]) ?></td>
                                        <?php $col++;?>
                                        <?php if($col==3): $col=0?></tr><?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if($col!==0): $col=0?></tr><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <h6>※ 各項目内の譜面は曲名順です </h6>
                            <h6>※ ごく最近の一部譜面については集計の対象外です 詳しくは<?= $this->Html->link(
                                            'こちら',
                                            ['controller' => 'Pages', 'action' => 'about', '#'=>'update'],
                                        ) ?></h6>
                        </div>
                        <div class="mb-3">
                            <label>
                                <h5 style="display:inline;">共有用URL</h5>
                                <h6 style="display:inline;">(デフォルトでこのタブを開くURL)</h6>
                                <button class="btn btn-sm btn-outline-info" onclick="copyToClipboard('url_<?= $table_id ?>');appear('copy_success_<?= $table_id ?>');">copy</button>
                            </label>
                            <input id="url_<?= $table_id ?>" class="form-control" type="text" value="<?= $this->Url->build(NULL,['fullBase' => true,])."#".$table_id?>" readonly>
                            <div id="copy_success_<?= $table_id ?>" style="display:none;">
                                <small class="form-text text-muted mb-3">コピーしました！</small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
</div>
