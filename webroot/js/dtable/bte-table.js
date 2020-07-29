$(document).ready(function() {
    var table = $('#bte-table').DataTable({
        lengthMenu: [ 20, 50, 100, 1000],
        displayLength: 20,
        order:  [ [3, "asc"] ],
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
            }
        ]
    });
    $('form').on('change', function(event) {
        table.draw();
    });
} );

$(function($){ 
    $.fn.dataTable.ext.order['dom-jp'] = function (settings, col){
      return this.api().column(col, {order:'index'}).nodes().map(function (td, i) {
        switch ($(td).html()){
          case '5th style':return '05';
          case '6th style':return '06';
          case '7th style':return '07';
          case '8th style':return '08';
          case '9th style':return '09';
          case '10th style':return '10';
          case 'IIDX RED':return '11';
          case 'HAPPY SKY':return '12';
          case 'DistorteD':return '13';
          case 'GOLD':return '14';
          case 'DJ TROOPERS':return '15';
          case 'EMPRESS':return '16';
          case 'SIRIUS':return '17';
          case 'Resort Anthem':return '18';
          case 'Lincle':return '19';
          case 'tricoro':return '20';
          case 'SPADA':return '21';
          case 'PENDUAL':return '22';
          case 'copula':return '23';
          case 'SINOBUZ':return '24';
          case 'CANNON BALLERS':return '25';
          case 'Rootage':return '26';
          case 'HEROIC VERSE':return '27';

          case 'NO PLAY':return '90';
          case 'FAILED':return '91';
          case 'ASSITED':return '92';
          case 'EASY':return '93';
          case 'CLEAR':return '94';
          case 'HARD':return '95';
          case 'EXHARD':return '96';
          case 'FULLCOMBO':return '97';

          default:
            return '00';
        }
      });
    };  
  
  }); 
