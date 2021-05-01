
$(function() {

    // resize window

    function resizeWindow() {

        var timesRun = 0;
        var interval = setInterval(function(){
            timesRun += 1;
            if(timesRun === 5){
                clearInterval(interval);
            }
            window.dispatchEvent(new Event('resize'));
        }, 62.5);
    }

    //  navbar toogler

    $('.navbar-toggler').on('click', function(){

        if ($(this).hasClass('left-sidebar-toggler')) {
            $('body').toggleClass('left-sidebar-hidden');
            resizeWindow();
        }

        if ($(this).hasClass('right-sidebar-toggler')) {
            $('body').toggleClass('right-sidebar-hidden');
            resizeWindow();
        }

        if ($(this).hasClass('mobile-leftside-toggler')) {
            $('body').toggleClass('mobile-leftside-show');
            resizeWindow();
        }

        if ($(this).hasClass('mobile-rightside-toggler')) {
            $('body').toggleClass('mobile-rightside-show');
            resizeWindow();
        }

    });


    // search toggle
    $('.search-toggle').on('click', function() {
        $('.search-container').toggleClass('open');
        $('.custom-search').focus();
    });

    //nav accordion

    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
//        cookie: 'dcjq-accordion-1',
        classExpand: 'dcjq-current-parent'
    });

    //for lobicard

    $('.lobicard-custom-icon').lobiCard({
        reload: {
            icon: 'ti-reload'
        },
        editTitle: {
            icon: 'ti-pencil-alt',
            icon2: 'ti-save-alt'
        },
        unpin: {
            icon: 'ti-move'
        },
        minimize: {
            icon: 'ti-angle-up',
            icon2: ' ti-angle-down'
        },
        close: {
            icon: 'ti-close'
        },
        expand: {
            icon: 'ti-fullscreen',
            icon2: 'ti-fullscreen'
        }
    });

    $('.lobicard-custom-control').lobiCard({
        reload: false,
        editTitle: false,
        unpin: false,
        minimize: {
            icon: 'ti-angle-up',
            icon2: ' ti-angle-down'
        },
        close: {
            icon: 'ti-close'
        },
        expand: {
            icon: 'ti-fullscreen',
            icon2: 'ti-fullscreen'
        }
    });


    //popover
    $('[data-toggle="popover"]').popover();

    //tooltip
    $('[data-toggle="tooltip"]').tooltip()

});



