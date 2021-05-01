
//date picker start

$(function(){

    $('.date-picker-input').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });



    $('.dpYears').datepicker({
        autoclose: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });

    // month & date only
    $('.dpMonths').datepicker({
        format: 'mm-dd',
        autoclose: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });

    $('.dpMonthYear').datepicker({
        format: 'mm-yyyy',
        autoclose: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });


    var checkin = $('.dpd1').datepicker({
        onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        }
        checkin.hide();

        $('.dpd2')[0].focus();
    }).data('datepicker');
    var checkout = $('.dpd2').datepicker({
        onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkout.hide();
    }).data('datepicker');


    // inline picker
    $('#inline-datepicker').datepicker({
        todayHighlight: true,
        autoclose: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });


    // enable clear button
    $('#helper-datepicker').datepicker({
        todayBtn: "linked",
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });


    // orientation

    $('#datepicker-top-left').datepicker({
        orientation: "top left",
        todayHighlight: true,
        autoclose: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });

    $('#datepicker-top-right').datepicker({
        orientation: "top right",
        todayHighlight: true,
        autoclose: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });

    $('#datepicker-bottom-left').datepicker({
        orientation: "bottom left",
        todayHighlight: true,
        autoclose: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });

    $('#datepicker-bottom-right').datepicker({
        orientation: "bottom right",
        todayHighlight: true,
        autoclose: true,
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });


});



