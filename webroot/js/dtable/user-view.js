$(document).ready(function() {
    var table = $('#lamp-detail').DataTable({
        lengthMenu: [ 20, 50, 100, 1000],
        displayLength: 20,
        order:  [ [1, "asc"] ],
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
            {
                'targets' :  0,
                'orderable' : true,
                'orderDataType' : 'dom-jp'
            },
            {},
            {
                'targets' :  2,
                'orderable' : true,
                'orderDataType' : 'lamp',
            },
            {
                'targets' :  3,
                'orderable' : true,
                'orderDataType' : 'fifty_cpi',
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
            sInfo : "表示中 : (_START_ ~ _END_) / _TOTAL_", // 現在の表示欄(例 = 100 件中 20件から30件 を表示しています)
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
                //"visible": ($(window).width() >= 768),
            },
            {},
            {
                'targets' :  2,
                'orderable' : true,
                'orderDataType' : 'lamp'
            },
            {
                'targets' :  3,
                'orderable' : true,
                'orderDataType' : 'lamp'
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
            sInfo : "表示中 : (_START_ ~ _END_) / _TOTAL_", // 現在の表示欄(例 = 100 件中 20件から30件 を表示しています)
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
                //"visible": ($(window).width() >= 768),
            },
            {},
            {
                'targets' :  2,
                'orderable' : true,
                'orderDataType' : 'lamp'
            },
            {},
        ]
    });
    $('form').on('change', function(event) {
        table.draw();
    });
} );

$(document).ready(function() {
    var table = $('#histories-table').DataTable({
        lengthMenu: [ 20, 50, 100, 1000],
        displayLength: 20,
        //order:  [ [1, "desc"] ],
        ordering: false,
        oLanguage: {
            /* 日本語化設定 */
            sLengthMenu : "表示　_MENU_　件", // 表示行数欄(例 = 表示 10 件)
            oPaginate : { // ページネーション欄
                sNext : "次へ",
                sPrevious : "前へ"
            },
            sInfo : "表示中 : (_START_ ~ _END_) / _TOTAL_", // 現在の表示欄(例 = 100 件中 20件から30件 を表示しています)
            sSearch : "検索 ", // 検索欄(例 = 検索 --)
            sZeroRecords : "表示するデータがありません", // 表示する行がない場合
            sInfoEmpty : "0 件中 0件 を表示しています", // 行が表示されていない場合
            sInfoFiltered : "全 _MAX_ 件から絞り込み" 
        },
        columnDefs : [
            {},
            {},
            {}
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
            sInfo : "(_START_ ~ _END_) / _TOTAL_", // 現在の表示欄(例 = 100 件中 20件から30件 を表示しています)
            sSearch : "検索 ", // 検索欄(例 = 検索 --)
            sZeroRecords : "表示するデータがありません", // 表示する行がない場合
            sInfoEmpty : "0 件中 0件 を表示しています", // 行が表示されていない場合
            sInfoFiltered : "全 _MAX_ 件から絞り込み" 
        },
        columnDefs : [
            {},
            {},
            {},
            {}
        ]
    });
    $('form').on('change', function(event) {
        table.draw();
    });
} );

$(document).ready(function() {
    var table = $('#follower-table').DataTable({
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
            sInfo : "(_START_ ~ _END_) / _TOTAL_", // 現在の表示欄(例 = 100 件中 20件から30件 を表示しています)
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
          case 'BISTROVER':return '28';
          case 'CastHour':return '29';

          case 'NO PLAY':return '90';
          case 'FAILED':return '91';
          case 'ASSISTED':return '92';
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
    $.fn.dataTable.ext.order['lamp'] = function (settings, col){
        return this.api().column(col, {order:'index'}).nodes().map(function (td, i) {
          if($(td).html().includes('NO PLAY'))return 10;
          if($(td).html().includes('FAILED'))return 11;
          if($(td).html().includes('ASSISTED'))return 12;
          if($(td).html().includes('EASY'))return 13;
          if($(td).html().includes('CLEAR'))return 14;
          if($(td).html().includes('EXHARD'))return 16;
          if($(td).html().includes('HARD'))return 15;
          if($(td).html().includes('FULLCOMBO'))return 17;
          else return 100;
        });
      };  
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
      $.fn.dataTable.ext.order['fifty_cpi'] = function (settings, col){
        return this.api().column(col, {order:'index'}).nodes().map(function (td, i) {
          if($(td).html()=="-")return 0;
          if($(td).html()=="未対応")return 1;
          else return $(td).html();

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
    'SIRIUS',
    'Resort Anthem',
    'Lincle',
    'tricoro',
    'SPADA',
    'PENDUAL',
    'copula',
    'SINOBUZ',
    'CANNON BALLERS',
    'Rootage',
    'HEROIC VERSE',
    'BISTROVER'
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

function lamp2numFunc(data){
    if(data.includes('NO PLAY'))return 11.5;
    if(data.includes('FAILED'))return 11.7;
    if(data.includes('ASSISTED'))return 12;
    if(data.includes('EASY'))return 13;
    if(data.includes('CLEAR'))return 14;
    if(data.includes('EXHARD'))return 16;
    if(data.includes('HARD'))return 15;
    if(data.includes('FULLCOMBO'))return 17;
    else return 0;
}

function lampInclude(data,lamp){
    if(lamp == "HARD") return data.includes("HARD") && !(data.includes("EXHARD"));
    else return data.includes(lamp);
}

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex, rowData ) {
        //return true;
        var detail_form = document.forms['detail-form'];
        var rec_form = document.forms['rec-form'];
        var bte_form = document.forms['bte-form'];
        if(settings.nTable.id == 'lamp-detail'){
            for(let ver of versions) if  (!detail_form.elements[ver].checked && data[0] == ver) return false;
            for(let lamp of cur_lamps) if (!detail_form.elements[("cur_"+lamp)].checked && lampInclude(data[2],lamp)) return false;
            if(detail_form.elements['detail_leg_only'].checked && (!data[1].includes("[L]"))) return false;
            if(detail_form.elements['detail_leg_except'].checked && data[1].includes("[L]")) return false;
        }
        if(settings.nTable.id == 'rec-table'){
            for(let ver of versions) if (!rec_form.elements[ver].checked && data[0] == ver) return false;
            for(let lamp of cur_lamps) if (!rec_form.elements[("cur_"+lamp)].checked && lampInclude(data[2],lamp)) return false;
            for(let lamp of tar_lamps) if (!rec_form.elements['tar_'+lamp].checked && lampInclude(data[3],lamp)) return false;
            if(parseFloat(data[4]) < parseFloat(rec_form.elements['rec_min'].value) || parseFloat(rec_form.elements['rec_max'].value) < parseFloat(data[4]))return false;
            if(rec_form.elements['rec_one_step'].checked && lamp2numFunc(data[2])+1.9 < lamp2numFunc(data[3]))return false;
            if(rec_form.elements['rec_leg_only'].checked && (!data[1].includes("[L]"))) return false;
            if(rec_form.elements['rec_leg_except'].checked && data[1].includes("[L]")) return false;

        }
        if(settings.nTable.id == 'bte-table'){
            for(let ver of versions) if (!bte_form.elements[ver].checked && data[0] == ver) return false;
            for(let lamp of tar_lamps) if (!bte_form.elements[("tar_"+lamp)].checked && lampInclude(data[2],lamp)) return false;
            if(parseFloat(data[3]) < parseFloat(bte_form.elements['bte_min'].value) || parseFloat(bte_form.elements['bte_max'].value) < parseFloat(data[3]))return false;
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
    $(boxes[prefix + target[0]]).change();
}

function setValue(form,dict){
    const forms = document.forms[form];
    for(let key in dict){
        forms[key].value=dict[key];
    }
    $(forms[0]).change();
}


$(function(){
    $("form").garlic();
});

$(function () {
    if(document.forms[0]!==undefined){
        $(document.forms[0][0]).change();
    }
});
