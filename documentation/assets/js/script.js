/* global hljs */
$(document).ready(function () {

    //page loader
    Pace.on("done", function () {
        console.log("finished");
        $('.loader').fadeIn(1500);
    });

    //navbar add remove calss
    var header = $(".no-background");
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 1) {
            header.removeClass('no-background').addClass("navbar-bg");
        } else {
            header.removeClass("navbar-bg").addClass('no-background');
        }
    });

    //multi dropdown
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        var $el = $(this);
        var $parent = $(this).offsetParent(".dropdown-menu");
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parent("li").toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-menu .show').removeClass("show");
        });

        if (!$parent.parent().hasClass('navbar-nav')) {
            $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
        }

        return false;
    });

    //Sticky sidebar
    $('.leftSidebar, .content, .rightSidebar')
            .theiaStickySidebar({
                additionalMarginTop: 111
            });

    $('.faqLeftSidebar, .faqContent').theiaStickySidebar();

    //Language dropdown
    $("#lng_select").msDropdown();

    //Navbar top search
    $(".navbar").each(function () {
        $("li.search > a", this).on("click", function (e) {
            e.preventDefault();
            $(".top-search").slideToggle();
        });
    });
    $(".input-group-addon.close-search").on("click", function () {
        $(".top-search").slideUp();
    });

    //Sidebar
    $('.overlay').on('click', function () {
        $('#sidebar, .page-content').toggleClass('active');
        $('#sidebar').removeClass('active');
        $('.overlay').fadeOut();
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar, .page-content').toggleClass('active');
        $('.overlay').fadeIn();
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    // add image to tooltip	
    $(".imgtip").hover(function (e) {
        t = $(this).attr('data-img');
        $(".navbar").append("<div id='imgtip'>" + t + "</div>");
        $("#imgtip")
                .css("top", (e.pageY - 10) + "px")
                .css("left", (e.pageX + 20) + "px")
                .fadeIn("fast");
    },
            function () {
                $(this).attr('data-img', t);
                $("#imgtip").remove();
            });
    $(".imgtip").mousemove(function (e) {
        $("#imgtip")
                .css("top", (e.pageY - 10) + "px")
                .css("left", (e.pageX + 20) + "px");
    });

    //Highlight
    var snippets = document.querySelectorAll('.snippet');
    [].forEach.call(snippets, function (snippet) {
        snippet.firstChild.insertAdjacentHTML('beforebegin', '<button class="btn-snippet" data-clipboard-snippet><img class="clippy" width="13" src="assets/img/clippy.svg" alt="Copy to clipboard"></button>');
    });
    var clipboardSnippets = new ClipboardJS('[data-clipboard-snippet]', {
        target: function (trigger) {
            return trigger.nextElementSibling;
        }
    });
    clipboardSnippets.on('success', function (e) {
        e.clearSelection();
        showTooltip(e.trigger, 'Copied!');
    });
    clipboardSnippets.on('error', function (e) {
        showTooltip(e.trigger, fallbackMessage(e.action));
    });

    var btns = document.querySelectorAll('.btn-snippet');
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener('mouseleave', clearTooltip);
        btns[i].addEventListener('blur', clearTooltip);
    }

    function clearTooltip(e) {
        e.currentTarget.setAttribute('class', 'btn-snippet');
        e.currentTarget.removeAttribute('aria-label');
    }

    function showTooltip(elem, msg) {
        elem.setAttribute('class', 'btn-snippet tooltipped tooltipped-s');
        elem.setAttribute('aria-label', msg);
    }

    function fallbackMessage(action) {
        var actionMsg = '';
        var actionKey = (action === 'cut' ? 'X' : 'C');
        if (/iPhone|iPad/i.test(navigator.userAgent)) {
            actionMsg = 'No support :(';
        } else if (/Mac/i.test(navigator.userAgent)) {
            actionMsg = 'Press ⌘-' + actionKey + ' to ' + action;
        } else {
            actionMsg = 'Press Ctrl-' + actionKey + ' to ' + action;
        }
        return actionMsg;
    }
    $('pre code').each(function (i, block) {
        hljs.highlightBlock(block);
    });

    //metisMenu
    $(".sidebarMenu").metisMenu();

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - 10)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });

    //Back to top
    $('body').append('<div id="toTop" class="btn-top"><i class="ti-upload"></i></div>');
    $(window).scroll(function () {
        if ($(this).scrollTop() !== 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').on('click', function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

    //Video popup
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    //testimonial
    $('.owl-carousel').owlCarousel({
        loop: true,
        dots: false,
        nav: true,
        navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
});









$(window).scroll(function () {
    var scrollDistance = $(window).scrollTop();
    // Assign active class to nav links while scolling
    $(".page-section").each(function (i) {
        if ($(this).position().top <= scrollDistance) {
            $(".navigation a.active").removeClass("active");
            $(".navigation a")
                    .eq(i)
                    .addClass("active");
        }
    });
}).scroll();








