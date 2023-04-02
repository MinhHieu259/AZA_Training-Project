//Function lấy data từ input
function getDataSearch() {
    return {
        'delivery_id': $('#delivery_id_search').val(),
        'delivery_name': $('#delivery_name_1_search').val(),
        'furigana': $('#furigana_search').val(),
        'address': $('#address_search').val(),
        'phone': $('#phone_search').val(),
        'delivery_category_1': $('#delivery_category_1_search').val(),
        'delivery_category_2': $('#delivery_category_2_search').val(),
        'delivery_category_3': $('#delivery_category_3_search').val()
    }
}
// Khởi tạo datatable
function initTable() {
    $('#table-search_filter').remove();
    $("#table-search").DataTable({
        processing: true,
        columns: [
            {data: "delivery_id"},
            {
                data: "delivery_name_1"
            },
            {data: "delivery_furigana_1"},
            {
                data: "province_name",
                render: function (data, type, row) {
                    return data + ', ' + row.city + ', ' + row.town + ', ' + row.address_home;
                }
            },
            {data: "phone"},
            {data: "delivery_category_1"},
            {data: "delivery_category_2"},
            {data: "delivery_category_3"}
        ],
        pagingType: 'full_numbers',
        responsive: true,
        "dom": '<"top"lp<"clear">>rt<"bottom"ip<"clear">>',
        lengthMenu: [[10, 25, 50, 100, -1], [10 + ' 件', 25 + ' 件', 50 + ' 件', 100 + ' 件', '全て']],
        language: {
            emptyTable: `<img width='300' src='/assets/images/nodata.png'><br>一致するデータがありません`
        },
        "columnDefs": [
            {
                "width": "100px",
                "targets": 0
            },
            {
                "width": "300px",
                "targets": 3
            }
        ]
    });
}
// Thêm data vào datatable
function initDataSearch() {
    var dataTableSearch = getDataSearch();
    $.ajax({
        type: "GET",
        url: "search-delivery",
        data: dataTableSearch,
        contentType: 'application/json',
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                $('#table-search').DataTable().clear();
                $('#table-search').DataTable().rows.add(response.data);
                $('#table-search').DataTable().draw();
            }
        },
    })

}
// Chuyển qua trang thêm mới
function btnChangeNewPageEvent() {
    $('#btnChangePageNew').on('click', function () {
        window.location.href = "delivery-detail";
        localStorage.setItem('modeDelivery', 'New');
    })
}
// Clear dữ liệu ở các trường input
function btnClearSearchDelivery() {
    $('#btnClearSearchDelivery').on('click', function () {
        $('#delivery_id_search').val('');
        $('#delivery_name_1_search').val('');
        $('#furigana_search').val('');
        $('#address_search').val('');
        $('#phone_search').val('');
        $('#delivery_category_1').val('');
        $('#delivery_category_2').val('');
        $('#delivery_category_3').val('');
        $('#table-search').DataTable().clear().draw();
        $("html, body").animate({
            scrollTop: 0
        }, 600);
    })
}
// Function export excel
function btnExportExcel() {
    // Preview excel
    $('#btnExportExcel').click(function () {
        $('#excel-preview-modal').modal('show');
        var dataTableSearch = getDataSearch();
        $.ajax({
            type: "GET",
            url: "search-delivery",
            data: dataTableSearch,
            dataType: "json",
            success: function (response) {
                console.log(response)
                if (response.status == 200) {
                    var table = $("#table-preview-excel");
                    // Xóa các dòng cũ
                    table.find("tbody tr").remove();
                    for (var i = 0; i < response.data.length; i++) {
                        var row = $("<tr></tr>");
                        row.append($("<td>" + response.data[i].delivery_id + "</td>"));
                        row.append($("<td>" + response.data[i].delivery_name_1 + "   " + response.data[i].delivery_name_2 + "</td>"));
                        row.append($("<td>" + response.data[i].delivery_furigana_1 + " " + response.data[i].delivery_furigana_2 + "</td>"));
                        row.append($("<td>" + response.data[i].zipcode + "</td>"));
                        row.append($("<td>" + response.data[i].province_name + ", " + response.data[i].city + ", " + response.data[i].town + ", " + response.data[i].address_home + "</td>"));
                        row.append($("<td>" + response.data[i].phone + "</td>"));
                        row.append($("<td>" + response.data[i].fax_number + "</td>"));
                        row.append($("<td>" + response.data[i].delivery_category_1 + "</td>"));
                        row.append($("<td>" + response.data[i].delivery_category_2 + "</td>"));
                        row.append($("<td>" + response.data[i].delivery_category_3 + "</td>"));
                        row.append($("<td>" + response.data[i].note + "</td>"));
                        row.append($("<td>" + response.data[i].time_created + "</td>"));
                        row.append($("<td>" + response.data[i].author_name + "</td>"));
                        table.find("tbody").append(row);
                    }
                }
            },
        })
    })
    // Back export excel
    $('#btnBackExport').on('click', function () {
        $('#excel-preview-modal').modal('hide');
    })
    //Export Excel
    $('#btnAcceptExportExcel').on('click', function () {
        let dataExport = getDataSearch();
        $.ajax({
            type: "GET",
            url: "export-delivery-excel",
            data: dataExport,
            success: function (response) {
                window.location.href = this.url;
                $('.spinner').addClass('spinner-hidden');
            },
        })
        $('#excel-preview-modal').modal('hide');
    })
}
// Nhấn button tìm kiếm
function btnSearchDelivery() {
    $('#btnSearchDelivery').click(function (e) {
        e.preventDefault();
        initDataSearch();
    })
}
// Click vào row table
function clickRowDataTable() {
    $('#table-search tbody').on('dblclick', 'tr', function () {
        if ($('#table-search').DataTable().data().count() != 0) {
            var delivery_id = $(this).find('td:first').text();
            window.location.href = "delivery-detail";
            localStorage.setItem('deliveryIdEdit', delivery_id);
            localStorage.setItem('modeDelivery', 'Edit');
        } else {
            return false;
        }
    });
}

function focusItem(){
    $('input').focus(function () {
        $(this).removeClass('is-invalid');
        $(this).tooltip('dispose');
    })
    $('select').focus(function () {
        $(this).removeClass('is-invalid')
        $(this).tooltip('dispose');
    });
}

$(document).ready(function () {
    btnExportExcel();
    initTable();
    initDataSearch();
    btnChangeNewPageEvent();
    btnClearSearchDelivery();
    btnSearchDelivery();
    clickRowDataTable();
    focusItem();
})
