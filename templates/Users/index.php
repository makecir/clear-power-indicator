<?php
/**
 * @var \App\View\AppView $this
 * @var array $rows
 */
?>
<div class="users index content">
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h4 class="mb-0">
                <?= __('Users') ?>
            </h4>
        </div>
        <div class="card-body text-dark">
            <div class="table-responsive">
                <div class="card mb-3">
                    <h5 class="card-header bg-info filter-header">
                        <a data-toggle="collapse" href="#collapse-f-users-index" aria-expanded="false" aria-controls="collapse-f-users-index" id="filter-users-index" class="d-block">
                            <i class="fas fa-filter mr-2"></i>
                            <i class="fa fa-chevron-down float-right"></i>
                                絞り込み
                        </a>
                    </h5>
                    <div id="collapse-f-users-index" class="collapse" aria-labelledby="filter-users-index">
                        <div class="card-body">
                            <form action="#" name="users-form">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <h5 class="card-title">
                                            CPI
                                            <div class="btn btn-sm btn-outline-secondary my-auto ml-2" onclick="setValue('users-form',{'cpi_min':'-1000.00','cpi_max':'4000.00',});">リセット</div>
                                        </h5>
                                        <ul　style="list-style: none;">
                                            <div class="form-row">
                                                <div class="col-6">
                                                    <?= $this->Form->control('cpi_min',['label' => 'min', 'name'=>'cpi_min', 'class' => 'form-control mb-3', 'type' => 'number', 'step' => '0.01', 'value'=>'-1000.00', 'placeholder'=>'-1000.00', 'required' => true]); ?>
                                                </div>
                                                <div class="col-6">
                                                    <?= $this->Form->control('cpi_max',['label' => 'max', 'name'=>'cpi_max', 'class' => 'form-control mb-3', 'type' => 'number', 'step' => '0.01', 'value'=>'4000.00', 'placeholder'=>'4000.00', 'required' => true]); ?>
                                                </div>
                                            </div>
                                            <li><label class=mr-3><input type="checkbox" name="cpi_is_valid" checked="checked"/> レーティングの無いユーザーを非表示</label></li>
                                        </ul>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
                <table id="users-index" class="table table-hover table-smart-phone-xx">
                    <thead>
                        <tr>
                            <th><?= __('DJ NAME') ?></th>
                            <th><?= __('IIDX ID') ?></th>
                            <th><?= __('CPI') ?></th>
                            <th><?= __('SP Grade') ?></th>
                            <th align="center"><?= __('Updated at') ?></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <?php // 行は user-index.js が JSON から作る ?>
                <script>
                    var usersIndexRows = <?= json_encode($rows, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_INVALID_UTF8_SUBSTITUTE) ?>;
                    var usersIndexViewUrl = <?= json_encode($this->Url->build(['action' => 'view']), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
                </script>
            </div>
        </div>
    </div>
</div>
