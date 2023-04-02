// Function load lại page lên trên sau khi xử lý dữ liệu
function loadToTop() {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
}

//Function get data từ các trường input, select
function getDataInput() {
    var data = {
        'delivery_id': $('#delivery_id').val(),
        'delivery_name_1': $('#delivery_name_1').val(),
        'delivery_name_2': $('#delivery_name_2').val(),
        'furigana_1': $('#furigana_1').val(),
        'furigana_2': $('#furigana_2').val(),
        'zipcode': $('#zipcode').val(),
        'province': $('#province').val(),
        'city': $('#city').val(),
        'town': $('#town').val(),
        'address_home': $('#address_home').val(),
        'address_1': $('#address_1').val(),
        'address_2': $('#address_2').val(),
        'phone': $('#phone').val(),
        'fax_number': $('#fax_number').val(),
        'category_delivery_1': $('#category_delivery_1').val(),
        'category_delivery_2': $('#category_delivery_2').val(),
        'category_delivery_3': $('#category_delivery_3').val(),
        'note': $('#note').val()
    }
    return data;
}

//Function làm trống data ở các trường input, select,...
function doBlankInput() {
    $('input').val('');
    $('select').val('').trigger('change');
    $('textarea').val('');
}

//Function xóa data và các error ở các trường
function deleteError() {
    doBlankInput();
    $('input').removeClass('is-invalid');
    $('select').removeClass('is-invalid');
    $('textarea').removeClass('is-invalid');
    $('input').tooltip('dispose');
    $('select').tooltip('dispose');
    $('textarea').tooltip('dispose');
}

//Function lấy data từ ajax và đổ lên giao diện
function writeData(response) {
    $('#delivery_id').val(response.data.delivery_id);
    $('#delivery_name_1').val(response.data.delivery_name_1);
    $('#delivery_name_2').val(response.data.delivery_name_2);
    $('#furigana_1').val(response.data.delivery_furigana_1);
    $('#furigana_2').val(response.data.delivery_furigana_2);
    $('#zipcode').val(response.data.zipcode);
    $('#province').val(response.data.province_id);
    $('#city').val(response.data.city);
    $('#town').val(response.data.town);
    $('#address_home').val(response.data.address_home);
    $('#address_1').val(response.data.address_1);
    $('#address_2').val(response.data.address_2);
    $('#phone').val(response.data.phone);
    $('#fax_number').val(response.data.fax_number);
    $("#category_delivery_1").val(response.data.category_delivery_id_1).trigger('change');
    $("#category_delivery_2").val(response.data.category_delivery_id_2).trigger('change');
    $("#category_delivery_3").val(response.data.category_delivery_id_3).trigger('change');
    $('#note').val(response.data.note);
}

//Function đổ thông tin người tạo, update từ db lên gd
function renderDataUser(response) {
    $('#infoAuthor').remove();
    $('#nav-info').append(`<b class="info-user-time" id="infoAuthor"\n' +
                        '        >[作成者] ${response.data.author_name} ${response.data.time_created} | [更新者] ${response.data.people_update}\n
                                    ${response.data.time_updated}</b>`);
}

//Function hiển thị toastr thông báo
function printMessage(status, title) {
    if (status == 400) {
        return toastr["error"](title, "エラー");
    } else if (status == 200) {
        return toastr["success"](title, "成功");
    } else if (status == 300) {
        return toastr["warning"](title, "警告");
    }
}

//Function xử lý sự kiện tìm kiếm (Blur ra ngoài || Nhấn nút)
function btnSearch() {
    $('#btnSearch').on('click', function () {
        $('#delivery_name_1_search_detail').val('');
        $('#furigana_1_search_detail').val('');
        $('#delivery_id_search_detail').val('');
        $('#delivery_category_1_search_detail').val('')
        $('#delivery_category_2_search_detail').val('')
        $('#delivery_category_3_search_detail').val('')
        $('#table-search-delivery-detail').DataTable().destroy();
        initTableDetail();
        initDataTableDetail();
        $('#searchDeliveryModal').modal('show');
    });

    $('#delivery_id').on('blur', function () {
        localStorage.setItem('deliveryIdEdit', $('#delivery_id').val());
        if (localStorage.getItem('deliveryIdEdit') != '' && (localStorage.getItem('modeDelivery') == 'New') || localStorage.getItem('modeDelivery') == 'Edit') {
            $.ajax({
                url: 'get-data-delivery-by-id/' + localStorage.getItem('deliveryIdEdit'),
                type: 'GET',
                success: function (response) {
                    console.log(response)
                    if (response.status == 400) {
                        $('#infoAuthor').remove();
                        $('#table-search-delivery-detail').DataTable().destroy();
                        initTableDetail()
                    } else if (response.status == 200) {
                        $('input').removeClass('is-invalid');
                        $('select').removeClass('is-invalid');
                        $('.error-message').text('');
                        $("#delivery_id").prop('disabled', true);
                        renderDataUser(response);
                        localStorage.setItem('modeDelivery', 'Edit')
                        renderItem(localStorage.getItem('deliveryIdEdit'));
                    }
                }
            });
        }
    })
}

//Function nhấn nút trở về ko tìm kiếm nữa
function btnBackSearch() {
    $('#btnBackSearch').on('click', function () {
        $('#searchDeliveryModal').modal('hide');
        $('#delivery_id_search_detail').val('');
        $('#delivery_name_1_search_detail').val('');
        $('#furigana_1_search_detail').val('');
        initDataTableDetail();
    });
}

//Function khi nhấn submit tìm kiếm
function searchSubmit() {
    $('#btnSubmitSearch').on('click', function () {
        initDataTableDetail();
    });
}

//Function delete delivery
function deleteDelivery() {
    $('#btnDeleteDelivery').on('click', function () {
        if ($('#delivery_id').val() == "") {
            printMessage(400, '納入先コードが入力されていません');
            $('#delivery_id').addClass("is-invalid")
            $('#delivery_id').focus(function () {
                $('#delivery_id').removeClass("is-invalid");
            });
            loadToTop();
        } else {
            $('#delivery_id').removeClass("is-invalid");
            $('#confirmDeleteDelivery').modal('show');
        }
    })

    $('#btnRefuseDelete').click(function () {
        $('#confirmDeleteDelivery').modal('hide');
    })
//Submit delete
    $('#btnAgreeDelete').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "DELETE",
            url: "delete-delivery-by-id/" + $('#delivery_id').val(),
            success: function (response) {
                console.log(response);
                if (response.status == 400) {
                    $('#delivery_id').addClass("is-invalid");
                    $('#delivery_id').attr('data-bs-title', response.message);
                    $('#delivery_id').tooltip();
                    loadToTop();
                } else if (response.status == 200) {
                    printMessage(response.status, response.message);
                    loadToTop();
                    $("#delivery_id").prop('disabled', false);
                    $('#infoAuthor').remove();
                    doBlankInput();
                    localStorage.setItem('modeDelivery', 'Edit');
                    $('#table-search-delivery-detail').DataTable().destroy();
                    initTableDetail();
                    initDataTableDetail();
                }
            },
        })
        $('#confirmDeleteDelivery').modal('hide');
    });
}

//Function khi nhấn vào button thêm mới
function btnNewDelivery() {
    $('#btnNewDelivery').click(function () {
        $('#confirmChangeNewMode').modal('show');
    })

    $('#btnRefuseChangeNew').click(function () {
        $('#confirmChangeNewMode').modal('hide');
    })
// Xác nhận thêm mới
    $('#btnAgreeChangeNew').click(function () {
        localStorage.setItem('modeDelivery', 'New');
        localStorage.setItem('deliveryIdEdit', '');
        renderItem(localStorage.getItem('deliveryIdEdit'));
        $("#delivery_id").prop('disabled', false);
        $('#confirmChangeNewMode').modal('hide');
        doBlankInput();
        deleteError();
        loadToTop();
        $('#btnDeleteDelivery').prop('disabled', true);
        $('#table-search-delivery-detail').DataTable().destroy();
        initTableDetail();
    });
}

//Function xử lý nút copy
function copyButtonEvent() {
    $('#btnCopyDelivery').click(function () {
        if (localStorage.getItem('modeDelivery') == 'Edit') {
            $('#confirmCopyDelivery').modal('show');
        } else {
            printMessage(300, 'コピーするには編集モードに切り替えます');
        }
    });

    $('#btnRefuseCopy').click(function () {
        $('#confirmCopyDelivery').modal('hide');
    });
// Xác nhận copy và đổ data từ DB lên màn hình
    $('#btnAgreeCopy').click(function () {
        $('#confirmCopyDelivery').modal('hide');
        loadToTop()
        if ($('#delivery_id').val() != '') {
            $.ajax({
                url: 'get-data-delivery-by-id/' + $('#delivery_id').val(),
                type: 'GET',
                success: function (response) {
                    console.log(response);
                    if (response.status == 400) {
                        doBlankInput();
                        $('#delivery_id').removeClass('is-invalid');
                    } else if (response.status == 200) {
                        $('#infoAuthor').remove();
                        $('#delivery_id').val('');
                        $('#btnDeleteDelivery').prop('disabled', true);
                        localStorage.setItem('modeDelivery', 'Copy');
                        $("#delivery_id").prop('disabled', false);
                        $('#delivery_id').focus()
                    }
                }
            });
        } else {
            $('#delivery_id').removeClass('is-invalid');
            localStorage.setItem('modeDelivery', 'New');
        }
    })
}

//Function validation insert or delete delivery
function validationInsertDelivery(modal) {
    var data = getDataInput();
    console.log(data);
    $.ajax({
        type: "POST",
        url: "validation-insert-delivery",
        data: JSON.stringify(data),
        contentType: 'application/json',
        dataType: "json",
        beforeSend: function () {
            $('input').removeClass('is-invalid')
            $('select').removeClass('is-invalid')
            // $('.error-message').text('')
            $('input').tooltip('dispose')
            $('select').tooltip('dispose')
            $('textarea').tooltip('dispose')
            $('.spinner').removeClass('spinner-hidden')
        },
        success: function (response) {
            console.log(response);
            if (response.status == 400) {
                var arrayErrors = [];
                $('.spinner').addClass('spinner-hidden')
                $.each(response.errors, function (prefix, val) {
                    $('#' + prefix).addClass("is-invalid");
                    $('#' + prefix).attr('data-bs-title', val[0]);
                    $('#' + prefix).tooltip();
                    arrayErrors.push(prefix);
                })
                $('#' + arrayErrors[0]).focus();
                loadToTop();
            } else if (response.status == 200) {
                $(modal).modal('show');
                $('.spinner').addClass('spinner-hidden');
            }
        },
    });
}

function insertOrUpdate(type, url) {
    var data = getDataInput();
    $.ajax({
        type: type,
        url: url,
        data: JSON.stringify(data),
        contentType: 'application/json',
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                printMessage(response.status, response.message);
                if (type == "POST") {
                    $('#confirmAddDelivery').modal('hide');
                } else {
                    $('#confirmEditDelivery').modal('hide');
                }
                loadToTop();
                localStorage.setItem('modeDelivery', 'Edit');
                $("#delivery_id").prop('disabled', true);
                localStorage.setItem('deliveryIdEdit', response.delivery_id);
                renderItem(localStorage.getItem('deliveryIdEdit'));
                $('.spinner').addClass('spinner-hidden');
            } else if (response.status == 400) {
                printMessage(response.status, response.message);
                if (type == "POST") {
                    $('#confirmAddDelivery').modal('hide');
                } else {
                    $('#confirmEditDelivery').modal('hide');
                }
                loadToTop();
                $('#delivery_id').addClass('is-invalid');
                $('#delivery_id').attr('data-bs-title', response.message);
                $('#delivery_id').tooltip();
                $('.spinner').addClass('spinner-hidden');
            }
        },
    });
}

//Function khi nhấn nút lưu
function SaveDeliveryEvent() {
    $('#btnSaveDelivery').on('click', function (e) {
        e.preventDefault();
        //Chế độ thêm mới
        if (localStorage.getItem('modeDelivery') == "New" || localStorage.getItem('modeDelivery') == "Copy") {
            validationInsertDelivery('#confirmAddDelivery');
        } else if (localStorage.getItem('modeDelivery') == "Edit") { // Khi đang ở mode edit
            validationInsertDelivery('#confirmEditDelivery');
        }
    });
    // Back thêm mới
    $('#btnRefuseAddDelivery').click(function () {
        $('#confirmAddDelivery').modal('hide');
    });
    //Xác nhận thêm mới
    $('#btnAgreeAddDelivery').click(function (e) {
        $('.spinner').removeClass('spinner-hidden')
        e.preventDefault();
        insertOrUpdate("POST", "insert-delivery")
    });
    //Back Edit
    $('#btnRefuseEditDelivery').click(function () {
        $('#confirmEditDelivery').modal('hide');
    });
    //Xác nhận cập nhật delivery
    $('#btnAgreeEditDelivery').click(function (e) {
        $('.spinner').removeClass('spinner-hidden');
        e.preventDefault();
        insertOrUpdate("PUT", "update-delivery/" + $('#delivery_id').val())
    })
}

//Khi nhấn vào tab DeliveryDetail chuyển qua mode thêm mới
function sideBarItemEvent() {
    $('#deliveryDetailItemSidebar').on('click', function () {
        localStorage.setItem('modeDelivery', "New");
        renderItem(localStorage.getItem('deliveryIdEdit'));
    })
}

//Function kiểm tra thông tin zipcode và đổ ra màn hình
function zipcodeChangeEvent() {
    var address1 = '';
    var address2 = '';
    $('#zipcode').on('change', function () {
        //888-8888
        var zipBefore = $('#zipcode').val().slice(0, 3);
        var zipAfter = $('#zipcode').val().slice(4, 8);
        if (zipBefore.length == 3 && zipAfter.length == 4) {
            fetch(`https://madefor.github.io/postal-code-api/api/v1/${zipBefore}/${zipAfter}.json`)
                .then(response => {
                    if (response.status == 404) {
                        printMessage(400, "郵便番号が存在しません")
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log(data);
                    results = data.data[0].ja;
                    $('#city').val(results.address1);
                    $('#town').val(results.address2);
                    $('#province').html(
                        '<option value="' +
                        results.prefecture + '">'
                        + results.prefecture + "</option>"
                    );
                    $('#province').val(results.prefecture);
                    $('#address_home').focus();
                    address1 = $('#province').find(":selected").text() + ', ' + $('#city').val();
                    address2 = $('#town').val() + ', ' + $('#address_home').val();
                    $('#address_1').val(address1);
                    $('#address_2').val(address2);
                    if ($('#province').val() != "") {
                        $('#province').removeClass('is-invalid');
                        $('#province').tooltip('dispose');
                    }
                    if ($('#city').val() != "") {
                        $('#city').removeClass('is-invalid');
                        $('#city').tooltip('dispose');
                    }
                    if ($('#town').val() != "") {
                        $('#town').removeClass('is-invalid');
                        $('#town').tooltip('dispose');
                    }
                })
                .catch((error) => {
                    console.error("error : ", error);
                });
        }
    })
// Xử lý khi thay đổi tỉnh thành phố thì đổ data ra address
    $('#province').on('change', function () {
        address1 = $('#province').find(":selected").text() + ', ' + $('#city').val();
        $('#address_1').val(address1);
    });
    $('#city').on('keyup', function () {
        address1 = $('#province').find(":selected").text() + ', ' + $('#city').val();
        $('#address_1').val(address1);
    });
    $('#town').on('keyup', function () {
        address2 = $('#town').val() + ', ' + $('#address_home').val();
        $('#address_2').val(address2);
    });
    $('#address_home').on('keyup', function () {
        address2 = $('#town').val() + ', ' + $('#address_home').val();
        $('#address_2').val(address2);
    });
}

// Function khởi tạo Datatable
function initTableDetail() {
    $('#table-search_filter').remove();
    $("#table-search-delivery-detail").DataTable({
        processing: true,
        columns: [
            {data: "delivery_id"},
            {data: "delivery_name_1"},
            {data: "delivery_furigana_1"},
            {data: "delivery_category_1"},
            {data: "delivery_category_2"},
            {data: "delivery_category_3"}
        ],
        pagingType: 'full_numbers',
        responsive: true,
        "dom": '<"top"lp<"clear">>rt<"bottom"ip<"clear">>',
        lengthMenu: [[10, 25, 50, 100, -1], [10 + ' 件', 25 + ' 件', 50 + ' 件', 100 + ' 件', '全て']],
    });
}

// Đổ dữ liệu từ DB lên Datatable
function initDataTableDetail() {
    var dataTableSearch = {
        'delivery_id': $('#delivery_id_search_detail').val(),
        'delivery_name': $('#delivery_name_1_search_detail').val(),
        'furigana': $('#furigana_1_search_detail').val(),
        'delivery_category_1': $('#delivery_category_1_search_detail').val(),
        'delivery_category_2': $('#delivery_category_2_search_detail').val(),
        'delivery_category_3': $('#delivery_category_3_search_detail').val()
    }
    $.ajax({
        type: "GET",
        url: "search-in-delivery",
        data: dataTableSearch,
        dataType: "json",
        success: function (response) {
            console.log(response);
            $('#table-search-delivery-detail').DataTable().clear();
            $('#table-search-delivery-detail').DataTable().rows.add(response);
            $('#table-search-delivery-detail').DataTable().draw();
        },
    });
}

// Xử lý khi double click vào 1 row của table
function clickRowDataTableDetail() {
    $('#table-search-delivery-detail tbody').on('dblclick', 'tr', function () {
        if ($('#table-search-delivery-detail').DataTable().data().count() != 0) {
            var delivery_id = $(this).find('td:first').text();
            localStorage.setItem('deliveryIdEdit', delivery_id);
            localStorage.setItem('modeDelivery', 'Edit');
            renderItem(localStorage.getItem('deliveryIdEdit'));
            $('#searchDeliveryModal').modal('hide');
            $('input').removeClass('is-invalid');
            $('select').removeClass('is-invalid');
            $('textarea').removeClass('is-invalid');
            $('input').tooltip('dispose');
            $('select').tooltip('dispose');
            $('textarea').tooltip('dispose');
        } else {
            return false;
        }
    });
}

function requiredValidation() {
    $('input').on('keyup', function () {
        if ($(this).val() != '') {
            $(this).removeClass('is-invalid');
            $(this).tooltip('dispose');
        }
    });
    $('select').on('change', function () {
        if ($(this).val() != '') {
            $(this).removeClass('is-invalid');
            $(this).tooltip('dispose');
        }
    });
    $('textarea').on('keyup', function () {
        if ($(this).val() != '') {
            $(this).removeClass('is-invalid');
            $(this).tooltip('dispose');
        }
    });
}

$(document).ready(function () {
    $(window).on('beforeunload', function () {
        $('.spinner').removeClass('spinner-hidden');
        localStorage.setItem('deliveryIdEdit', '');
        localStorage.setItem('modeDelivery', 'New');
    });
    $('.spinner').addClass('spinner-hidden');
    initTableDetail();
    initDataTableDetail();
    clickRowDataTableDetail();
    btnSearch();
    btnBackSearch();
    searchSubmit();
    deleteDelivery();
    btnNewDelivery();
    copyButtonEvent();
    SaveDeliveryEvent();
    sideBarItemEvent();
    zipcodeChangeEvent();
    requiredValidation();
});
