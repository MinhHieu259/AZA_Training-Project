// Kiểm tra chuỗi fullsize
function isFullsizeJapanese(text) {
    return /^[\uFF01-\uFF5E\u3041-\u3096\u30A0-\u30FF\u3400-\u4DBF\u4E00-\u9FFF\uF900-\uFAFF]+$/u.test(text);
}

// Kiểm tra chuỗi katakana Fullsize
function isKatakanaFullSize(text) {
    return /^[ぁ-んァ-ン]+$/.test(text)
}

// Kiểm tra chuỗi haftSize
function isHaftsizeJapanese(text) {
    return /^[\uFF61-\uFF9F\u0020-\u007E]+$/u.test(text);
}

//Kiểm tra chuỗi mix giữa fullSize và haftsize
function isFullsizeOrHaftsizeJapanese(text) {
    return /^[\uFF01-\uFF5E\u3041-\u3096\u30A0-\u30FF\u3400-\u4DBF\u4E00-\u9FFF\uF900-\uFAFF\uFF61-\uFF9F\u0020-\u007E]+$/u.test(text);
}

// Tính số byte của chuỗi Fullsize tiếng nhật
function countFullsizeByte(str) {
    var regex = /[\u3040-\u309F\u30A0-\u30FF\u3400-\u4DBF\u4E00-\u9FFF]/g;
    var count = 0;
    var match;
    while ((match = regex.exec(str)) !== null) {
        count++;
    }
    // Tính số byte bằng cách nhân số ký tự fullsize với 2
    var byteCount = count * 2;
    return byteCount;
}

// Tính số byte của chuỗi haftsize tiếng nhật
function countHaftsizeByte(str) {
    var byteHaft = 0;
    for (var i = 0; i < str.length; i++) {
        if (isHaftsizeJapanese(str[i])) {
            byteHaft++
        }
    }
    return byteHaft
}

//Tính số byte của chuỗi mix giữa fullSize và HaftSize
function countByteMix(str) {
    var fullSize = countFullsizeByte(str)
    var haftSize = countHaftsizeByte(str);
    return fullSize + haftSize
}

// Function chung validation cho các trường mix giữa haft và full
function validationById(id, haft, full, byte) {
    $(document).on('blur keypress keyup', id, function () {
        if (isHaftsizeJapanese($(this).val())) {
            $(id).attr('maxlength', haft)
        } else if (isFullsizeJapanese($(this).val())) {
            $(id).attr('maxlength', full)
        } else if (isFullsizeOrHaftsizeJapanese($(this).val())) {
            $(id).attr('maxlength', haft)
            if (countByteMix($(this).val()) > byte) {
                $(id).addClass('is-invalid')
                $(id).attr('data-bs-title', '無効な文字数');
                $(id).tooltip()
                $(id).attr('maxlength', $(this).val().length - 1)
                // var oldVal = $(id).val()
                // $(id).val(oldVal.slice(0, -1))
            } else {
                $(id).removeClass('is-invalid')
                $(id).tooltip('dispose')
            }
        }
    })
}
//Function validation không có phép nhập chữ
function validationOnlyNumber(id, regex1, regex2){
    $(id).on('input', function () {
        if (/\D/g.test($(this).val())) {
            this.value = this.value.replace(/\D/g, '');
            $(this).addClass('is-invalid')
            $(id).tooltip('dispose')
            $(id).attr('data-bs-title', '入力できません');
            $(id).tooltip()
        } else {
            $(this).removeClass('is-invalid')
            $(id).tooltip('dispose')
        }
        $(this).val($(this).val().replace(regex1, regex2))
    })
}

//Function validation fullsize haftsize
function validationFullSizeHaftSize() {
    //Xử lý delivery_id haftsize
    $('#delivery_id').attr('maxlength', '6')
    $('#delivery_id').on('input', function () {
        if (!isHaftsizeJapanese($('#delivery_id').val()) && $('#delivery_id').val() != '') {
            oldValue = $(this).val();
            $(this).val(oldValue.slice(0, -1));
            $('#delivery_id').addClass('is-invalid')
            // $('#delivery_id_error').text('全角文字を含めることはできません')
            $('#delivery_id').attr('data-bs-title', '全角文字を含めることはできません');
            $('#delivery_id').tooltip()
        } else {
            $('#delivery_id').removeClass('is-invalid')
            $('#delivery_id').tooltip('dispose')
        }
        $('#delivery_id').attr('maxlength', '6')
    })

    $('#delivery_name_1').attr('maxlength', '50')
    validationById('#delivery_name_1', '50', '25', '100')

    $('#delivery_name_2').attr('maxlength', '40')
    validationById('#delivery_name_2', '40', '20', '80')

    $('#furigana_1').attr('maxlength', '80')
    $('#furigana_2').attr('maxlength', '60')
    $('#city').attr('maxlength', '24')

    validationById('#city', '24', '12', '24')
    validationById('#town', '32', '16', '32')
    validationById('#address_home', '32', '16', '32')
    //Định dạng số điện thoại theo format xxx-xxxx-xxxx và chỉ được nhập số
    $('#phone').attr('maxlength', '13')
    //Validation không cho nhập chữ
    validationOnlyNumber('#phone', /(\d{3})\-?(\d{4})\-?(\d{4})/, '$1-$2-$3')
    //Định dạng số fax theo format xxx-xxxx-xxxx và chỉ được nhập số
    $('#fax_number').attr('maxlength', '12')
    validationOnlyNumber('#fax_number', /(\d{3})\-?(\d{4})\-?(\d{4})/, '$1-$2-$3')
    //Định dạng zipcode theo định dạng xxx-xxxx và chỉ được nhập số
    $('#zipcode').attr('maxlength', '8')
    validationOnlyNumber('#zipcode', /(\d{3})\-?(\d{4})/, '$1-$2')
    $('#note').attr('maxlength', '200')
    //Validation in delivery search
    //kiểm tra delivery_id_search là haftsize
    $('#delivery_id_search').on('input', function () {
        if (!isHaftsizeJapanese($('#delivery_id_search').val()) && $('#delivery_id_search').val() != '') {
            oldValue = $(this).val();
            $(this).val(oldValue.slice(0, -1));
            $('#delivery_id_search').addClass('is-invalid')
            // $('#delivery_id_search_error').text('納入先コード全角文字を含めることはできません')
            $('#delivery_id_search').attr('data-bs-title', '納入先コード全角文字を含めることはできません');
            $('#delivery_id_search').tooltip()
        } else {
            $('#delivery_id_search').removeClass('is-invalid')
            $('#delivery_id_search').tooltip('dispose')
        }
        $('#delivery_id').attr('maxlength', '6')
    })
    $('#delivery_id_search').attr('maxlength', '6')
    validationById('#delivery_name_1_search', '180', '90', '360')
    $('#address_search').attr('maxlength', '400')
    $('#phone_search').attr('maxlength', '20')
    // Kiểm tra furigana_search là KataKana FullSize
    $('#furigana_search').attr('maxlength', '140')
    $('#furigana_search').on('input', function () {
        if (!isKatakanaFullSize(this.value) && $('#furigana_search').val() != '') {
            var oldValue = $(this).val();
            $(this).val(oldValue.slice(0, -1));
            $('#furigana_search').addClass('is-invalid')
            $('#furigana_search').attr('data-bs-title', '無効な形式');
            $('#furigana_search').tooltip()
        } else {
            $('#furigana_search').removeClass('is-invalid')
        }
    })
}

//Function validation zipcode đúng định dạng xxx-xxxx
function validationFormatZipcode() {
    var pattern = /^\d{3}-\d{4}$/;
    $('#zipcode').on('blur', function () {
        if ($('#zipcode').val() != '') {
            if (pattern.test($('#zipcode').val())) {
                console.log("Chuỗi hợp lệ");
            } else {
                $('#zipcode').addClass('is-invalid')
                // $('#zipcode_error').text('不正な形式');
                $('#zipcode').attr('data-bs-title', '不正な形式');
                $('#zipcode').tooltip()
            }
        }
    })
}

$(document).ready(function () {
    validationFullSizeHaftSize();
    validationFormatZipcode();
})
