$(document).ready(function() {
    var table = $('#rec-table').DataTable({
        lengthMenu: [ 20, 50, 100, 1000],
        displayLength: 20,
        order:  [ [4, "desc"] ],
        oLanguage: {
            /* 日本語化設定 */
            sLengthMenu : "表示　_MENU_　件", // 表示行数欄(例 = 表示 10 件)
            oPaginate : { // ページネーション欄
                sNext : "次へ",
                sPrevious : "前へ"
            },
            sInfo : "_TOTAL_ 件中 _START_件から_END_件 を表示しています", // 現在の表示欄(例 = 100 件中 20件から30件 を表示しています)
            sSearch : "検索 ", // 検索欄(例 = 検索 --)
            sZeroRecords : "表示するデータがありません", // 表示する行がない場合
            sInfoEmpty : "0 件中 0件 を表示しています", // 行が表示されていない場合
            sInfoFiltered : "全 _MAX_ 件から絞り込み" 
        },
        columnDefs : [
            {
                'targets' :  0,
                'orderable' : true,
                'orderDataType' : 'dom-jp'
            },
            {},
            {
                'targets' :  2,
                'orderable' : true,
                'orderDataType' : 'dom-jp'
            },
            {
                'targets' :  3,
                'orderable' : true,
                'orderDataType' : 'dom-jp'
            }
        ]
    });
    $('form').on('change', function(event) {
        table.draw();
    });
} );
