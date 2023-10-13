$(document).ready(function() {
    $(".form-bottom").on('click', '.button_delete', function(){
        if (confirm('Bạn có muốn xóa')) {
            $(this).parent().remove();
            $("#drinking_select option[value="+$(this).data('id')+"]").attr("disabled", false);
            let price = $(this).data('price');
            let amount = $(this).parent().find('.drinking_amount').val();
            var regexNumber = /\D/gm;
            let total = $('.total-drink').text();
            let totalNew = parseInt(total.replace(regexNumber, "")) - (parseInt(price) * parseInt(amount));
            $('.total-drink').html(totalNew.toLocaleString('vi', {style : 'currency', currency : 'VND'}));
        }
    });

    $('body').on('keyup', '.drinking_amount', function() {
        let drinking_tow = $(this).data('id-amount');
        let value_input = $(this).val();

        var total = 0;
        $('#form-submit-drinking .render-form').each(function() {
            let price = $(this).find('.drinking_amount').data('price');
            let amount = $(this).find('.drinking_amount').val();
            total += parseInt(price) * parseInt(amount);
        });
        $('.total-drink').html(total.toLocaleString('vi', {style : 'currency', currency : 'VND'}));
        $.ajax({
            type: "GET",
            url: routeOnchangeValidation,
            data: {
                'drinking_tow' : drinking_tow,
            },
            success: function(data) {
                if (data.status) {
                    let amount = data.data.amount;
                    let title = data.data.product_name;
                    if (value_input > amount) {
                        $('.drinking_amount').text(amount);
                        $('.drinking_title').text(title);
                        $('.modal').show();
                    }
                }
            }
        });
    });

    $('#drinking_select').on('change', function() {
        let drinking = this.value;
        $.ajax({
            type: "GET",
            url: routeAjaxOnchange,
            data: {
                'drinking' : drinking,
            },
            beforeSend: function() {
                $("#drinking_select option[value="+drinking+"]").attr("disabled", true);
            },
            success: function(data) {
                if (data.status) {
                    $('.form-select-drinking').after(data.html);
                    var total = 0;
                    $('#form-submit-drinking .render-form').each(function() {
                        let price = $(this).find('.drinking_amount').data('price');
                        let amount = $(this).find('.drinking_amount').val();
                        total += parseInt(price) * parseInt(amount);
                    })
                    $('.total-drink').html(total.toLocaleString('vi', {style : 'currency', currency : 'VND'}));
                }
            }
        });
    });

    $('.modal-show-bill').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: routeOnShow,
            data: {
                'id' : id,
            },
            success: function(data) {
                if (data.status) {
                    console.log(data.data.drinking_pubs);
                    let name = data.data.name;
                    let id = data.data.id;
                    let created_at = data.date_create_at;
                    let deleted_at = data.date_deleted_at;
                    let total = data.data.total
                    $('.drink-name').text(name);
                    $('.drink-id').text(id);
                    $('.drink-created_at').text(created_at);
                    $('.drink-deleted_at').text(deleted_at);
                    $('.total-drink-bill').text(total.toLocaleString('vi', {style : 'currency', currency : 'VND'}));
                    $('.tbody-drink').html(data.htmlDrinkingPubs);
                    $('.modal').show();
                }
            }
        })
    });
});
