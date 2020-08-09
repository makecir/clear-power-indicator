$(document).ready(function() {
    var table = $('#lamp-detail').DataTable({
        lengthMenu: [ 20, 50, 100, 1000],
        displayLength: 20,
        order:  [ [1, "asc"] ],
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
                'orderDataType' : 'dom-jp',
            },
            {
                'targets' :  3,
                'orderable' : true,
                'orderDataType' : 'dom-jp',
                "visible": ($(window).width() >= 768),
            }
        ]
    });
    $('form').on('change', function(event) {
        table.draw();
    });
} );

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
                'orderDataType' : 'dom-jp',
                "visible": ($(window).width() >= 768),
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
            },
            {},

        ]
    });
    $('form').on('change', function(event) {
        table.draw();
    });
} );

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
                'orderDataType' : 'dom-jp',
                "visible": ($(window).width() >= 768),
            },
            {},
            {
                'targets' :  2,
                'orderable' : true,
                'orderDataType' : 'dom-jp'
            },
            {},
        ]
    });
    $('form').on('change', function(event) {
        table.draw();
    });
} );

$(document).ready(function() {
    var table = $('#following-table').DataTable({
        lengthMenu: [ 20, 50, 100, 1000],
        displayLength: 20,
        order:  [ [1, "desc"] ],
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

var versions = new Array('5th style',
    '6th style',
    '7th style',
    '8th style',
    '9th style',
    '10th style',
    'IIDX RED',
    'HAPPY SKY',
    'DistorteD',
    'GOLD',
    'DJ TROOPERS',
    'EMPRESS',
    'Resort Anthem',
    'SIRIUS',
    'Lincle',
    'tricoro',
    'SPADA',
    'PENDUAL',
    'copula',
    'SINOBUZ',
    'CANNON BALLERS',
    'Rootage',
    'HEROIC VERSE'
);
var cur_lamps = new Array('NO PLAY',
    'FAILED',
    'ASSISTED',
    'EASY',
    'CLEAR',
    'HARD',
    'EXHARD',
    'FULLCOMBO'
);
var tar_lamps = new Array(
    'EASY',
    'CLEAR',
    'HARD',
    'EXHARD',
    'FULLCOMBO'
);
var lamp2num = {
    'NO PLAY':2,
    'FAILED':2,
    'ASSISTED':2,
    'EASY':3,
    'CLEAR':4,
    'HARD':5,
    'EXHARD':6,
    'FULLCOMBO':7,
}

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex, rowData ) {
        //return true;
        var detail_form = document.forms['detail-form'];
        var rec_form = document.forms['rec-form'];
        var bte_form = document.forms['bte-form'];

        if(settings.nTable.id == 'lamp-detail'){
            for(let ver of versions) if  (!detail_form.elements[ver].checked && data[0] == ver) return false;
            for(let lamp of cur_lamps) if (!detail_form.elements[("cur_"+lamp)].checked && data[2] == lamp) return false;
            if(detail_form.elements['detail_leg_only'].checked && (!data[1].includes("†") || data[1].includes("ZIGOQ") || data[1].includes("paradisus") || data[1].includes("ラヴリィ～レイディオ"))) return false;
            if(detail_form.elements['detail_leg_except'].checked && data[1].includes("†") && !data[1].includes("ZIGOQ") && !data[1].includes("paradisus") && !data[1].includes("ラヴリィ～レイディオ")) return false;
        }
        if(settings.nTable.id == 'rec-table'){
            for(let ver of versions) if (!rec_form.elements[ver].checked && data[0] == ver) return false;
            for(let lamp of cur_lamps) if (!rec_form.elements[("cur_"+lamp)].checked && data[2] == lamp) return false;
            for(let lamp of tar_lamps) if (!rec_form.elements['tar_'+lamp].checked && data[3] == lamp) return false;
            if(parseFloat(data[4]) < parseFloat(rec_form.elements['rec_min'].value) || parseFloat(rec_form.elements['rec_max'].value) < parseFloat(data[4]))return false;
            if(rec_form.elements['rec_one_step'].checked && lamp2num[data[2]]+1 < lamp2num[data[3]])return false;
            if(rec_form.elements['rec_leg_only'].checked && (!data[1].includes("†") || data[1].includes("ZIGOQ") || data[1].includes("paradisus") || data[1].includes("ラヴリィ～レイディオ"))) return false;
            if(rec_form.elements['rec_leg_except'].checked && data[1].includes("†") && !data[1].includes("ZIGOQ") && !data[1].includes("paradisus") && !data[1].includes("ラヴリィ～レイディオ")) return false;

        }
        if(settings.nTable.id == 'bte-table'){
            for(let ver of versions) if (!bte_form.elements[ver].checked && data[0] == ver) return false;
            for(let lamp of cur_lamps) if (!bte_form.elements[("cur_"+lamp)].checked && data[2] == lamp) return false;
            if(parseFloat(data[3]) < parseFloat(bte_form.elements['bte_min'].value) || parseFloat(bte_form.elements['bte_max'].value) < parseFloat(data[4]))return false;
        }

        return true;
    }
);

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
