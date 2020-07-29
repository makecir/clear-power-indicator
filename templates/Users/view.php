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

    <div class="card  border-secondary mb-3 text-center">
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
                <div class="table-responsive">
                    <table id="lamp-detail" class="table table-bordered">
                        <thead>
                            <tr>
                                <th><?= __('version') ?></th>
                                <th><?= __('title') ?></th>
                                <th><?= __('lamp') ?></th>
                                <th><?= __('fifty_rating') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_table as $row): ?>
                            <tr>
                                <td><?= h($row['version']) ?></td>
                                <td><?= h($row['title']) ?></td>
                                <td bgcolor=<?= h($row['lamp_color']) ?>><?= h($row['lamp']) ?></td>
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
                            <tr>
                                <th><?= __('version') ?></th>
                                <th><?= __('title') ?></th>
                                <th><?= __('lamp_cur') ?></th>
                                <th><?= __('lamp_tar') ?></th>
                                <th><?= __('probability') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rec_table as $row): ?>
                            <tr>
                                <td><?= h($row['version']) ?></td>
                                <td><?= h($row['title']) ?></td>
                                <td bgcolor=<?= h($row['lamp_cur_color']) ?>><?= h($row['lamp_cur']) ?></td>
                                <td bgcolor=<?= h($row['lamp_tar_color']) ?>><?= h($row['lamp_tar']) ?></td>
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
                            <tr>
                                <th><?= __('version') ?></th>
                                <th><?= __('title') ?></th>
                                <th><?= __('lamp') ?></th>
                                <th><?= __('probability') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bte_table as $row): ?>
                            <tr>
                                <td><?= h($row['version']) ?></td>
                                <td><?= h($row['title']) ?></td>
                                <td bgcolor=<?= h($row['lamp_color']) ?>><?= h($row['lamp']) ?></td>
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
