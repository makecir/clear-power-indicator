<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users view content">
    <div class="card border-secondary mb-3">
        <div class="card-header">
            <h5 class="mb-0">
                <?= __('Player') ?>
            </h5>
        </div>
        <div class="card-body text-dark">


        </div>
    </div>

    <div class="card  border-secondary mb-3 text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#lamps" data-toggle="tab"> <?= __('Lamps Detail') ?></a>
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
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div id="recommended" class="tab-pane fade">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-info">Go somewhere</a>
            </div>
            <div id="better-than-expected" class="tab-pane fade">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-success">Go somewhere</a>
            </div>
        </div>
    </div>

</div>
