// ハッシュ付きリンクで特定のタブを開いた状態にする
$(function() {
    var hash = document.location.hash;
    if (hash) {
            $('.nav-tabs a[href="' + hash + '"]').tab('show');
        }
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        e.target // newly activated tab
        e.relatedTarget // previous active tab
        });
    });