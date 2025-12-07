$(document).ready(function() {
    var table = $('#lamp-compare').DataTable({
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
            sInfoFiltered : ", 全 _MAX_ 件" 
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
                'orderDataType' : 'lamp',
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
          case 'RESIDENT':return '30';
          case 'EPOLIS': return '31';
          case 'Pinky Crush': return '32';
          case 'Sparkle Shower': return '33';

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
    'HEROIC VERSE',
    'BISTROVER',
    'CastHour',
    'RESIDENT',
    'EPOLIS',
    'Pinky Crush',
    'Sparkle Shower'
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
    'NO PLAY':0,
    'FAILED':1,
    'ASSISTED':2,
    'EASY':3,
    'CLEAR':4,
    'HARD':5,
    'EXHARD':6,
    'FULLCOMBO':7,
}

function lamp2numFunc(data){
    if(data.includes('NO PLAY'))return 10;
    if(data.includes('FAILED'))return 11;
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
        var compare_form = document.forms['compare-form'];
        if(settings.nTable.id == 'lamp-compare'){
            for(let ver of versions) if  (!compare_form.elements[ver].checked && data[0] == ver) return false;
            for(let lamp of cur_lamps) if (!compare_form.elements[("my_"+lamp)].checked && lampInclude(data[2],lamp)) return false;
            for(let lamp of cur_lamps) if (!compare_form.elements[("rival_"+lamp)].checked && lampInclude(data[3],lamp)) return false;
            if(compare_form.elements['compare_leg_only'].checked && (!data[1].includes("[L]"))) return false;
            if(compare_form.elements['compare_leg_except'].checked && data[1].includes("[L]")) return false;
            if(!compare_form.elements['compare_except_win'].checked && (lamp2numFunc(data[2]) > lamp2numFunc(data[3]) && lamp2numFunc(data[3]) != 10)) return false;
            if(!compare_form.elements['compare_except_draw'].checked && (lamp2numFunc(data[2]) == lamp2numFunc(data[3]) && lamp2numFunc(data[3]) != 10)) return false;
            if(!compare_form.elements['compare_except_lose'].checked && (lamp2numFunc(data[2]) < lamp2numFunc(data[3]) && lamp2numFunc(data[2]) != 10)) return false;
            if(!compare_form.elements['compare_except_no_match'].checked && (lamp2numFunc(data[2]) == 10 || lamp2numFunc(data[3]) == 10)) return false;
        }
        return true;
    }
);

function allCheck(form,target_op,value){
    const boxes = document.forms[form];

    if(target_op=='versions'){prefix=''; target = versions;}
    if(target_op=='my_lamps'){prefix='my_'; target = cur_lamps;}
    if(target_op=='rival_lamps'){prefix='rival_'; target = cur_lamps;}
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
