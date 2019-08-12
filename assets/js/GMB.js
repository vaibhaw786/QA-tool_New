$(document).on('click', '.table-box-select-new table tr td', function() {
    $(this).find('label').toggleClass('active');
    //$('.table-box-select-new table tbody tr td label input').show();
    $('.table-box-select-new tr td label').each(function() {
        if ($(this).hasClass('active')) {
            $(this).find('input').prop("checked", true);
        } else {
            $(this).find('input').prop("checked", false);
        }
    });
});

$(document).on('click', '.table-box-select-new table tr td label', function() {
    $(this).toggleClass('active');
    //$('.table-box-select-new table tbody tr td label input').show();
    $('.table-box-select-new tr td label').each(function() {
        if ($(this).hasClass('active')) {
            $(this).find('input').prop("checked", true);
        } else {
            $(this).find('input').prop("checked", false);
        }
    });
});

$(document).on('click', '.table-box-select-new table tr td span', function() {
    $(this).parent('label').toggleClass('active');
    //$('.table-box-select-new table tbody tr td label input').show();
    $('.table-box-select-new tr td label').each(function() {
        if ($(this).hasClass('active')) {
            $(this).find('input').prop("checked", true);
        } else {
            $(this).find('input').prop("checked", false);
        }
    });
})