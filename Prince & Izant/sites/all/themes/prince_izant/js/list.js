(function($, Drupal) {
  Drupal.behaviors.main_script = {
    attach:function(context, settings) {


      //
      $('.messages').insertAfter('.webform-component--i-am-not-a-robot .form-type-checkbox');


      $(document).ready(function() {

        
        // Dropdown for language (header)
        $('.language li:first-child').unbind('click').bind('click', function() {
          $('.language li:last-child').slideToggle();
          $('.header-top .language').toggleClass('active');
        });


        // Toggle mobile menu
        $('.toggle').unbind("click").bind("click", function() {
          $(this).toggleClass('on');
          $('#block-system-main-menu').slideToggle();
          $('.logo').toggleClass('hide');
          $('#block-search-form').toggleClass('show');
          $('.header-top .language').toggleClass('show');
          $('#header').toggleClass('open-menu');
          $('body').toggleClass('overhide');
        });

        // Open children menu
        $('#block-system-main-menu .content > ul > li.expanded').append('<div class="dropdown-arrow"></div>');
        $('#block-system-main-menu .content > ul > li.expanded > .dropdown-arrow').unbind("click").bind("click", function() {
          $(this).parent('li.expanded').toggleClass('open');
        });

        // Center children menu
        $('#header .menu > li.expanded > ul').ready(function() {
          var widthMenuChildren = $('#header .menu > li.expanded > ul').width();
          $('#header .menu > li.expanded > ul').css('margin-left', - widthMenuChildren / 4);
        });
     

        // Slick slider
        // Banner (main slider)
        $('.main-slider ul.slider').slick({
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: false,
          prevArrow: $('.prev'),
          nextArrow: $('.next')
        });
        // Hide arrow if one slide
        setTimeout(function() {
          var numberSlide = $(".main-slider .slick-track .slick-slide").length;
          if (numberSlide == 1) {
            $('.main-slider').addClass('one-slide');
          }
        }, 1000);

        // Markets slider
        $('ul.markets-slider').slick({
          infinite: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          dots: true,
          autoplay: false,
          arrows: false,
          responsive: [
            {
              breakpoint: 750,
              settings: {
                slidesToScroll: 1,
                dots: true,
                slidesToShow: 1,
                variableWidth: true
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToScroll: 1,
                dots: true,
                slidesToShow: 1,
                variableWidth: true
              }
            }
          ]
        });

        // Products slider
        $(window).resize(function() {
          if($(window).width() >= 1024) {
            $('.products-section .products-slider').not('.slick-initialized').slick({
              infinite: false,
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
              autoplay: false,  
              arrows: false,
              vertical: true,
              verticalSwiping: true,
            });
          }
        });
        // Remove slider for table
        $slick_slider = $('.products-section .products-slider');
        $(window).on('resize', function() {
          if ($(window).width() < 1024) {
            if ($slick_slider.hasClass('slick-initialized')) {
              $slick_slider.slick('unslick');
            }
            return
          }
  
          if (!$slick_slider.hasClass('slick-initialized')) {
            return $slick_slider.slick(settings);
          }
        });
        $(document).ready(function() {
          $(this).resize();
        });


        // News slider
        $('.news-section .view-news .view-content ul').slick({
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          autoplay: false,
          fade: true,
          speed: 500,
          cssEase: 'linear',      
          arrows: false
        });


        // Cards slider
        $(window).resize(function() {
          if($(window).width() >= 750) {
            $('.cards-slider-section .cards-slider').not('.slick-initialized').slick({
              infinite: false,
              slidesToShow: 3,
              slidesToScroll: 3,
              dots: true,
              autoplay: false,
              arrows: false
            });
          }
        });
        $('.cards-slider-section .cards-slider').not('.slick-initialized').slick({
          infinite: false,
          slidesToShow: 3,
          slidesToScroll: 3,
          dots: true,
          autoplay: false,
          arrows: false
        });
        // Remove slider for table
        $slick_slider_card = $('.cards-slider-section .cards-slider');
        $(window).on('resize', function() {
          if ($(window).width() < 750) {
            if ($slick_slider_card.hasClass('slick-initialized')) {
              $slick_slider_card.slick('unslick');
            }
            return
          }
  
          if (!$slick_slider_card.hasClass('slick-initialized')) {
            return $slick_slider_card.slick(settings);
          }
        });


        $('.subsidiarie .category').ready(function() {
          $(this).find('ul').parent('.category').addClass('expanded');

          $('.subsidiarie .category.expanded').unbind('click').bind('click', function() {
            $(this).toggleClass('open');
            $(this).find('ul').slideToggle();
          });

        });


        // Open \ show content for (Card)
        setTimeout(function() {
          $('.wrapper-cards li').each(function(){
            
              if ($(this).find('.text').css('height') > "142") {
                $(this).find('.text').addClass('more-text');
                $(this).find('.text').find('p').hide();
                $(this).find('.text').find('li').hide();
                $(this).find('.text').append('<div class="more"></div>');
                
                $('.card-content .text .more').unbind('click').bind('click', function() {
                  $(this).closest('.text').toggleClass('active');
                });
              }

          });

          $('.wrapper-cards li').find('.text').css('height', 40);
        }, 800);


        // Add span for table (for sort)
        $('th.header').append('<span class="arrow"></span>');
        

        //
        $('.webform-client-form-2 .form-actions input[type="submit"]').click(function() {
          if ($('input.required').val() == 0) {
            $('input.required').addClass('error');
          } else {
            $('input.required').removeClass('error');
          }
        });


        // Button scroll top (for page News)
        // Create button
        $('.page-news #content').append('<div class="arrow-up"><div class="arrow-fixed"></div></div>');
        
        setTimeout(function() {
            if ($('body').hasClass('page-news')) {
              setInterval(function() {
                var heightContent = $('.page-news #content').height();
                $('.page-news .arrow-up').css('height', heightContent);
                console.log('sasa');
              }, 500);
            }


          // Animation scroll
          $('.arrow-fixed').click(function() {
            $('body').animate({'scrollTop': 0}, 1000);
            $('html').animate({'scrollTop': 0}, 1000);
          });
            
            // Show \ Hide button with scroll
            $(window).scroll(function() {
              if($(window).scrollTop() > 400){
                $('.arrow-fixed').show(300);
              } else{
                $('.arrow-fixed').hide(300);
              }
          });
        }, 1500);


        // Checked checkbox (for Webform)
        $('.webform-client-form-2 .form-actions input[type="submit"]').click(function() {
          if ($('.webform-component--i-am-not-a-robot input[type="checkbox"]').is(':checked')) {
            $('.webform-component--i-am-not-a-robot .option').removeClass('active');
          } else {
            $('.webform-component--i-am-not-a-robot .option').addClass('active');
          }
        });


        // Validation email
        function validateEmail(email) {
          var re = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return re.test(email);
        }

        $('.webform-component--email').append('<span class="result"></span>');
        function validate() {
          $('.result').text('');
          var email = $(".email").val();
          if (validateEmail(email)) {
            $('.result').text(' ');
            $('.email').removeClass('error');
          } else {
            $('.result').text('请填写正确信息');
            $('.email').addClass('error');
          }
          // return false;
        }
        
        $('.webform-client-form-2 .form-actions input[type="submit"]').bind('click', validate);
                  
  
        // Play video
        var videoID  = $('.video-id').data('video-id'),
            videoIMG = $('.img-path').data('img-path');

        $('.cover-img').prettyEmbed({
          videoID: videoID,
          previewSize: 'hd',				// use either this option...
          customPreviewImage: videoIMG,			// ...or this option
        
          // Embed controls
          showInfo: false,
          showControls: true,
          loop: false,
        
          colorScheme: 'dark',
          showRelated: false,
        
          useFitVids: false
        });
        



        
      });


    }
  }
}(jQuery, Drupal));
