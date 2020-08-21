$(document).ready(function() {
    var table = $('#users-index').DataTable({
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
            {},
            {},
            {},
            {
                'targets' :  3,
                'orderable' : true,
                'orderDataType' : 'grade-jp'
            }
        ]
    });
    $('form').on('change', function(event) {
        table.draw();
    });
} );

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex, rowData ) {
        var users_form = document.forms['users-form'];
        if(users_form.elements['cpi_is_valid'].checked && data[2]=="" )return false;
        if(parseFloat(data[2]) < parseFloat(users_form.elements['cpi_min'].value) || parseFloat(users_form.elements['cpi_max'].value) < parseFloat(data[2]))return false;
        return true;
    }
);

$(function($){ 
    $.fn.dataTable.ext.order['grade-jp'] = function (settings, col){
      return this.api().column(col, {order:'index'}).nodes().map(function (td, i) {
        switch ($(td).html()){

          case '七級':return '138';
          case '六級':return '139';
          case '五級':return '140';
          case '四級':return '141';
          case '三級':return '142';
          case '二級':return '143';
          case '一級':return '144';
          case '初段':return '145';
          case '二段':return '146';
          case '三段':return '147';
          case '四段':return '148';
          case '五段':return '149';
          case '六段':return '150';
          case '七段':return '151';
          case '八段':return '152';
          case '九段':return '153';
          case '十段':return '154';
          case '中伝':return '155';
          case '皆伝':return '156';
          
          default:
            return '00';
        }
      });
    };  
  
}); 

function setValue(form,dict){
    const forms = document.forms[form];
    for(let key in dict){
        forms[key].value=dict[key];
    }
}