$(document).ready(function() {
    // 行のデータは templates/Users/index.php が JSON で渡す。deferRender で表示する行だけを作る
    var escapeHtml = $.fn.dataTable.render.text().display;
    // HTML のエスケープは表示するときだけ行い、検索・並べ替えには元の値を使う
    var displayText = function (value, type) {
        if (value == null) value = '';
        return type === 'display' ? escapeHtml(value) : value;
    };
    var table = $('#users-index').DataTable({
        data: usersIndexRows,
        deferRender: true,
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
        columns : [
            {
                data: 'dj_name',
                render: function (dj_name, type, row) {
                    if (type !== 'display') return displayText(dj_name, type);
                    return '<a href="' + escapeHtml(usersIndexViewUrl + '/' + row.id) + '">' + displayText(dj_name, type) + '</a>'
                        + (row.is_private ? ' <i class="fas fa-lock"></i>' : '');
                }
            },
            { data: 'iidx_id', render: displayText },
            { data: 'cpi', render: displayText },
            // 並べ替えは段位の数値で行う (七級 < 六級 < ... < 皆伝)。表示する段位名はサーバーの固定の値
            { data: { _: 'grade_sp_info', sort: 'grade_sp', type: 'grade_sp' } },
            { data: 'updated_at', className: 'text-center' }
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

function setValue(form,dict){
    const forms = document.forms[form];
    for(let key in dict){
        forms[key].value=dict[key];
    }
    $(forms[0]).change();
}