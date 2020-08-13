<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserHistory $userHistory
 */
?>
<div class="users view content">
    <div class="card border-secondary mb-3">
        <div class="card-header padding-sm">
            <h4 class="mb-0">
                <?= __('Update detail') ?>
            </h4>
        </div>
        <div class="card-body pr-3 pl-3">
            <?php if(!$is_permitted):?>
                <div class="text-center pt-5 pb-5"><i class="fas fa-lock fa-3x"></i></div>
            <?php else:?>
                <div class="row text-dark">
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
                        </div>
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
                
            </div>
        </div>
    <?php endif;?>
</div>
