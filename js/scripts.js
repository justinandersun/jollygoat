dataslide = 1;

jQuery(document).ready(function ($) {

    $(window).stellar();

    var links = $('.navigation').find('li');
    slide = $('.slide');
    button = $('.button');
    mywindow = $(window);
    htmlbody = $('html,body');


    slide.waypoint(function (event, direction) {


        var newTemp = dataslide;

        dataslide = $(this).attr('data-slide');


        if (direction === 'down' && dataslide!=1) {
            $('.navigation li[data-slide="' + dataslide + '"]').addClass('active').prev().removeClass('active');
        }
        else if(direction === 'up' && dataslide!=1) {
            $('.navigation li[data-slide="' + dataslide + '"]').addClass('active').next().removeClass('active');
        }
        else if(dataslide == 1) {
            dataslide = newTemp;
        }

    });
 
    mywindow.scroll(function () {
        if (mywindow.scrollTop() == 0) {          
            $('.navigation li[data-slide="1"]').addClass('active');
            $('.navigation li[data-slide="2"]').removeClass('active');
        }
        if(mywindow.scrollTop() + mywindow.height() == $(document).height()) {
            // dataslide = $(this).attr('data-slide');
            $('.navigation li[data-slide="' + 4 + '"]').addClass('active').prev().removeClass('active');
        }

    });

    function goDownScroll(dataslide) {
        if(dataslide === '1') {
            htmlbody.animate({
                scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top
            }, 2000, 'easeInOutQuint');
        }
        else {
            htmlbody.animate({
                scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top+1
            }, 2000, 'easeInOutQuint');            
        }


    }

    function goUpScroll(dataslide) {
        htmlbody.animate({
            scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top-1
        }, 2000, 'easeInOutQuint');

    }

    var tempSlide;

    links.click(function (e) {
        e.preventDefault();
        tempSlide = dataslide;
        dataslide = $(this).attr('data-slide');
        if(tempSlide > dataslide) {
            //scroll up
            goUpScroll(dataslide);
        }
        else {
            goDownScroll(dataslide);
        }

    });

    button.click(function (e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);

    });


    //submit form ajax stuff
    $("#contactForm").submit(function() {
        var data = {};

        data['name'] = $('#name').val();
        data['email'] = $('#email').val();
        data['comments'] = $('#message').val(); 

            var url = "submitted.php"; // the script where you handle the form input.
            $.ajax({
                   type: "POST",
                   url: url,
                   data: data, // serializes the form's elements.
                   success: function(data)
                   {
                       $('#contactForm').fadeOut("slow", function () {
                            $('#thankYou').fadeIn( 2000); 
                       });
                       
                   }
                 });
        return false;
    });    


});