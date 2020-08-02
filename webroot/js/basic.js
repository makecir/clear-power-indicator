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

// CSVを選択したときにファイル名を表示
$('#upload-csv').change(function (e) {
    var val = $('#upload-csv').val();
    if (val) $('#submit-csv').show();
    $('#imported-filename').text('CSV選択：' + val.substr(val.lastIndexOf("\\") + 1));
});
