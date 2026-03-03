var SearchStr = "";

function Search(str) {
    SearchStr = str;
    ajaxAction('Search', str);
    origin = [];
}
Search("");

function Delete(thisCol) {
    var value = $(thisCol).closest('tr').find('td').eq(3).text();
    ajaxAction('Delete', value);
}
var origin = [];

function Update(thisCol) {
    $("input[name='update']").attr('disabled', 'disabled');
    $("input[name='delete']").attr('disabled', 'disabled');

    thisCol = $(thisCol).closest('tr');
    UpHtml = "";
    for (var i = 0; i < 5; i++) {
        var value = thisCol.find('td').eq(i).text();
        origin.push(value);
        if (i != 3 && i != 4)
            UpHtml += "<td><input class='UpdateSet' id='Update_" + i + "' value='" + value + "'></td>";
        else if (i == 4)
            UpHtml += "<td><input class='UpdateSet' id='Update_" + i + "' value='" + value + "' type='date'></td>";
        else
            UpHtml += "<td>" + value + "</td>";
    }
    UpHtml += "<td><input class='btn btn-dark' type='button' value='確認' onclick='ConfirmUpdate(this)'></td>";
    UpHtml += "<td><input class='btn btn-dark' type='button' value='取消' onclick='Search(SearchStr)'></td>";
    thisCol.html(UpHtml);
    var date_now = new Date();
    document.getElementById("Update_4").max = date_now.toLocaleDateString('en-ca');
}

function ConfirmUpdate(thisCol) {
    thisCol = $(thisCol).closest('tr');
    var Data = {};
    for (var i = 0; i < 5; i++) {
        var value = $("#Update_" + i).val();
        if (value != origin[i] && i != 3)
            Data[i] = value;
    }
    ajaxAction('Update', [Data, origin[3]]);
}

function ajaxAction(Action, Data) {
    $.ajax({
        type: 'POST',
        url: './GotoDB.php',
        data: {
            Action: Action,
            Data: Data,
        },
        success: function(msg) {
            switch (Action) {
                case 'Search':
                    $('#Infomation').html(msg);
                    break;
                case 'Delete':
                    alert('成功刪除資料');
                    Search(SearchStr);
                    break;
                case 'Update':
                    Search(SearchStr);
                    break
            }
        },
        error: function() {
            switch (Action) {
                case 'Search':
                    alert("Search error");
                    break;
                case 'Delete':
                    alert('Delete error!');
                    break;
                case 'Update':
                    alert('Update error!');
                    break
            }
        }
    });
}