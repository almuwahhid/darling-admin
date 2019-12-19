function activateFnc(){
  $('.slideshow').each(function(){
    $('.slideshow').height($('.slideshow').width()/2);
  });
  $('.centerVertical').each(function(){
    $(this).css("margin-top", $(this).parent().height()/2 - $(this).height()/2);
  });
  $('.centerHorizontal').each(function(){
    $(this).css("margin-left", $(this).parent().width()/2 - $(this).width()/2);
  });

  $('.widthRect').each(function(){
    $(this).css("width", $(this).height());
  });

  $('.heightRect').each(function(){
    $(this).css("height", $(this).width());
  });

  $('.heightHalf').each(function(){
    $(this).css("height", $(this).width()/2);
  });

  $('.heightWindow').each(function(){
    $(this).css("height", $(window).height());
  });

  $('.heightPeta').each(function(){
    $(this).css("height", $(window).height()-100);
  });

  $('.heightParent').each(function(){
    $(this).css("height", $(this).parent().width());
  });

  $('.widthParent').each(function(){
    $(this).css("width", $(this).parent().height());
  });

  $('.layout-img-icon').each(function(){
    $(this).hover(
      function(){
        console.log($(this).children());
        $(this).children().fadeIn();
      },
      function(){
        $(this).children().fadeOut();
      }
    );
  });
  $('.centerVerticalWindow').each(function(){
    $(this).css("margin-top", $(window).height()/2 - $(this).height()/2);
  });

  $('.centerHorizontalWindow').each(function(){
    $(this).css("margin-left", $(window).width()/2 - $(this).width()/2);
  });

  $('.content-main').each(function(){
    $(this).height($(window).height());
  });
  $('.potongtext').each(function(){  
    if(isian.length>30){
      $(this).html(isian.substr(0, 35)+"...").text();
    }
  });
  $('.map-container').each(function(){
    $(this).height($(window).height()-80);
  });
  $('.map-container-detail').each(function(){
    $(this).height($(window).height()/2);
  });
}
$('document').ready(function() {
  activateFnc();

  $(window).resize(function(){
    $('.slideshow').each(function(){
      $('.slideshow').height($('.slideshow').width()/2);
    });
    $('.centerVertical').each(function(){
      $(this).css("margin-top", $(this).parent().height()/2 - $(this).height()/2);
    });
    $('.centerHorizontal').each(function(){
      $(this).css("margin-left", $(this).parent().width()/2 - $(this).width()/2);
    });

    $('.widthRect').each(function(){
      $(this).css("width", $(this).height());
    });

    $('.heightRect').each(function(){
      $(this).css("height", $(this).width());
    });

    $('.heightWindow').each(function(){
      $(this).css("height", $(window).height());
    });

    $('.heightPeta').each(function(){
      $(this).css("height", $(window).height()-100);
    });

    $('.heightParent').each(function(){
      $(this).css("height", $(this).parent().width());
    });

    $('.widthParent').each(function(){
      $(this).css("width", $(this).parent().height());
    });

    $('.layout-img-icon').each(function(){
      $(this).hover(
        function(){
          console.log($(this).children());
          $(this).children().fadeIn();
        },
        function(){
          $(this).children().fadeOut();
        }
      );
    });
    $('.centerVerticalWindow').each(function(){
      $(this).css("margin-top", $(window).height()/2 - $(this).height()/2);
    });

    $('.centerHorizontalWindow').each(function(){
      $(this).css("margin-left", $(window).width()/2 - $(this).width()/2);
    });

    $('.content-main').each(function(){
      $(this).height($(window).height());
    });
    $('.map-container').each(function(){
      $(this).height($(window).height()-80);
    });
    $('.map-container-detail').each(function(){
      $(this).height($(window).height()/2);
    });


  });
});
