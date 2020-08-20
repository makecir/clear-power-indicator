<?php
/**
 * @var \App\View\AppView $this
 */

?>
<div style="text-align:center ; padding: 10em 1em 5em 1em">
    
    <font size="6">このURLに該当するページは存在しません。</font><br><br>
    <font size="5">Page not found.</font>

    <div style="text-align:center ; padding: 5em 1em 5em 1em">
        <?= $this->Html->link(__('ホームに戻る'), '/',['class' => 'button btn btn-info']) ?>
    </div>
</div>
