$(document).on('click',"#sidebar-toggler",function (e) {
    e.stopPropagation();
    const sidebar = $('#sidebar');
    handleSidebarWidth(sidebar);
});

$(document).on('click',"#notifications",function (e) {
    e.stopPropagation();
    $('#notifications-area').children('.notifications').toggle()
});
function handleSidebarWidth(sidebar) {
    if (sidebar.width() > 0) {
        closeSideBar(sidebar);
    }
    else {
        openSideBar(sidebar);
    }
}
window.getWindowSize =function getWindowSize() {
    const window_size = $(window).width();
    return window_size;
};

function openSideBar(sidebar) {
    if (getWindowSize() >= 768 && getWindowSize() < 1024) {
        sidebar.animate({
            width: '40%'
        }, 500);
        setTimeout(() => {
            $("*", sidebar).css('visibility', 'visible');
        }, 300);
    }
    else if (getWindowSize() >= 600 && getWindowSize() < 768) {
        sidebar.animate({
            width: '50%'
        }, 500);
        setTimeout(() => {
            $("*", sidebar).css('visibility', 'visible');
        }, 300);
    }
    else if (getWindowSize() <= 600) {
        sidebar.animate({
            width: '100%'
        }, 500);
        setTimeout(() => {
            $("*", sidebar).css('visibility', 'visible');
        }, 300);
    }
}

function closeSideBar(sidebar) {
    $("*", sidebar).css('visibility', 'hidden');
    setTimeout(() => {
        sidebar.animate({
            width: 0
        }, 500);
    }, 50);
}

$(document).on('click',"#sidebar",function (e) {
    e.stopPropagation();
});

$(document).on('click',".in-sidebar-toggler",function (e) {
    e.stopPropagation();
    const sidebar = $('#sidebar');
    handleSidebarWidth(sidebar);
});

$('.has-sub').on('click', function(){
    $(this).parent().children('#sub-menu').slideToggle(400)
})
