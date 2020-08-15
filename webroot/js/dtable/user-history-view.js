$(document).ready(function() {
    var table = $('#lamp-changes').DataTable({
        lengthMenu: [ 20, 50, 100, 1000],
        displayLength: 20,
        order:  [ [3, "desc"] ],
        oLanguage: {
            /* 日本語化設定 */
            sLengthMenu : "表示　_MENU_　件", // 表示行数欄(例 = 表示 10 件)
            oPaginate : { // ページネーション欄
                sFirst : "最初",
                sLast : "最後",
                sNext : "次",
                sPrevious : "前"
            },
            sInfo : "表示中 : (_START_ ~ _END_) / _TOTAL_", // 現在の表示欄(例 = 100 件中 20件から30件 を表示しています)
            sSearch : "検索 ", // 検索欄(例 = 検索 --)
            sZeroRecords : "表示するデータがありません", // 表示する行がない場合
            sInfoEmpty : "0 件中 0件 を表示しています", // 行が表示されていない場合
            sInfoFiltered : "全 _MAX_ 件から絞り込み" 
        },
        columnDefs : [
            {},
            {
                'targets' : 1,
                'orderable' : true,
                'orderDataType' : 'dom-jp'
            },
            {
                'targets' : 2,
                'orderable' : true,
                'orderDataType' : 'lamp',
            },
            {}
        ]
    });
    $('form').on('change', function(event) {
        table.draw();
    });
} );


$(function($){ 
    $.fn.dataTable.ext.order['lamp'] = function (settings, col){
        return this.api().column(col, {order:'index'}).nodes().map(function (td, i) {
          if($(td).html().includes('NO PLAY'))return 10;
          if($(td).html().includes('FAILED'))return 11;
          if($(td).html().includes('ASSITED'))return 12;
          if($(td).html().includes('EASY'))return 13;
          if($(td).html().includes('CLEAR'))return 14;
          if($(td).html().includes('HARD'))return 15;
          if($(td).html().includes('EXHARD'))return 16;
          if($(td).html().includes('FULLCOMBO'))return 17;
          else return 0;
        });
    };
});

function allCheck(form,target_op,value){
    const boxes = document.forms[form];

    if(target_op=='versions'){prefix=''; target = versions;}
    if(target_op=='cur_lamps'){prefix='cur_'; target = cur_lamps;}
    if(target_op=='tar_lamps'){prefix='tar_'; target = tar_lamps;}
    for(let tar of target) {
        boxes[prefix + tar].checked = value;
    }
    $(boxes[target[0]]).change();
}

$(function(){
    $("form").garlic();
});

$(function () {
    $(document.forms[0][0]).change();
});
