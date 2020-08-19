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

$('#upload-playtext').on('click', function(){
    $('#text-sub-icon').addClass('fa-spin');
});

$('#submit-csv').on('click', function(){
    $('#csv-sub-icon').addClass('fa-spin');
});

$('#jump-reculc').on('click', function(){
    $('#reculc-icon').addClass('fa-spin');
});

$('[data-toggle="tooltip"]').tooltip();

$(function(){
    $('ul.list > li').prepend('<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>');
    $('dl.list dt').prepend('<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>');
  });
