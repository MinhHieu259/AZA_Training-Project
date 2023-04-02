//Function setting select2
function select2Item() {
    $('#category_delivery_1').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    });
    $('#category_delivery_2').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    });
    $('#category_delivery_3').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    });
}

//Set csrf cho ajax
function ajaxSetting() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

//Function button trở về trang trước đó
function backToPageBefore() {
    $('#btnBackPageBefore').on('click', function () {
        $('#confirmBackModal').modal('show');
    });

    $('#btnRefuseBack').click(function () {
        $('#confirmBackModal').modal('hide');
    });

    $('#btnAgreeBack').click(function () {
        window.history.back();
        $('.spinner').addClass('spinner-hidden');
    });
}

//Function đổ dữ liệu ra giao diện
function renderItem($delivery_id_edit) {
    if (localStorage.getItem('modeDelivery') == "New") {
        $('#infoAuthor').remove();
        $('#btnDeleteDelivery').prop('disabled', true);
    } else if (localStorage.getItem('modeDelivery') == "Edit") {
        $("#delivery_id").prop('disabled', true);
        $('#btnDeleteDelivery').prop('disabled', false);
        $('#infoAuthor').remove();
        $.ajax({
            url: 'get-data-delivery-by-id/' + $delivery_id_edit,
            type: 'GET',
            success: function (response) {
                console.log(response)
                if (response.status == 400) {
                    printMessage(response.status, response.message)
                } else if (response.status == 200) {
                    $('#nav-info').append(`<b class="info-user-time" id="infoAuthor"\n' +
                        '        >[作成者] ${response.data.author_name} ${response.data.time_created} | [更新者] ${response.data.people_update}\n
                                    ${response.data.time_updated}</b>`)
                    writeData(response);
                    $('#province').html(
                        '<option selected value="' +
                        response.data.province_name + '">'
                        + response.data.province_name + "</option>"
                    );
                }
            }
        });

    }
}
$(document).ready(function () {
    ajaxSetting();
    renderItem(localStorage.getItem('deliveryIdEdit'));
    toastr.options = {
        "closeButton": true,
        "debug": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $('#searchDeliveryModal').modal({backdrop: 'static', keyboard: false});
    $('#excel-preview-modal').modal({backdrop: 'static', keyboard: false});
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    $(document).on('keydown', function(e) {
        if (e.key === '/') {
            e.preventDefault();
            $('#delivery_id').focus();
        }
    });
    select2Item();
    backToPageBefore();
});
