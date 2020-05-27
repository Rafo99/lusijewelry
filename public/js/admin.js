$('.select-cat').on('change', function() {
    if (this.value == 1) {
        $('.hidden-select').show();
    } else {
        $('.hidden-select').hide();
    }
});

