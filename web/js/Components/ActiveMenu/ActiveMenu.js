export const MenuClickHandler = () => {

    $(document).ready(function () {
        $(document).on("scroll", ActiveMenuItemOnScroll);

        $('.menu-item-link').on('click', function (e) {

            e.preventDefault();

            $(document).off("scroll");

            $('.menu-item-link').each(function () {
                $(this).removeClass('menu-link-active');
            })
            $(this).addClass('menu-link-active');

            let target = this.hash;
            let $target;
            $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top-80
            }, 500, 'swing', function () {
                // window.location.hash = target;
                $(document).on("scroll", ActiveMenuItemOnScroll);
            });
        });
    });
}

const ActiveMenuItemOnScroll = () => {

    let scrollPos = $(document).scrollTop();

    $('.menu-item-link').each(function () {
        let currLink = $(this);
        let refElement = $(currLink.attr("href"));

        if (refElement.position().top-80 <= scrollPos && refElement.position().top-80 + refElement.height() > scrollPos) {
            $('.menu-item').removeClass("menu-link-active");
            currLink.addClass("menu-link-active");
        } else {
            currLink.removeClass("menu-link-active");
        }
    });
}
