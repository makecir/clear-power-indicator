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
    $('#imported-filename').text('CSV選択中：' + val.substr(val.lastIndexOf("\\") + 1));
});

$("#drop-zone").on("drop",function(e){
    e.preventDefault();
    $(this).removeClass("dragover");
    console.log(e.originalEvent.dataTransfer.files);
});
$("#drop-zone").on("dragover",function(e){
    e.preventDefault();
    $(this).addClass("dragover");
});
$("#drop-zone").on("drop", function(e){
    e.preventDefault();
    document.getElementById("upload-csv").files = e.originalEvent.dataTransfer.files;
    $("#upload-csv").change();
});
$("#drop-zone").on("dragleave",function(e){
    e.preventDefault();
    $(this).removeClass("dragover");
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

function copyToClipboard(str) {
    var range = document.createRange();
    var element = document.getElementById(str);
    var selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);
    element.select();
    document.execCommand("Copy");
    selection.removeAllRanges();
}
function appear(str) {
    document.getElementById(str).style.display ="";
}
