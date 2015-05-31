// alert("hello world");
$(document).ready(function () {

    $(window).scroll(function(){
        if ($(window).scrollTop() == $(document).height() - $(window).height()){
            if($('div#last_item_loader').text()==""){
                load_NextSet();
            }
        }
    }); 
    
    $(".dropdown li").hover(function(){
    
        $(this).addClass("hover");
        $('ul:first',this).css('visibility', 'visible');
    
    }, function(){
    
        $(this).removeClass("hover");
        $('ul:first',this).css('visibility', 'hidden');
    
    });

    var menu = $('.menu-res');
    var menuList = menu.find('ul:first');
    var listItems = menu.find('li').not('.responsive-tab');

    // Responsive trigger
    menuList.prepend('<li class="responsive-tab"><a href="#">Menu</a></li>');

    // Toggle menu visibility
    menu.on('click', '.responsive-tab', function(){
        listItems.slideToggle('fast');
        listItems.addClass('collapsed');
    });

    //===================================================================
    // ROYAL SLIDER
    //=================================================================== 

    $('.photo-section').royalSlider({
        arrowsNav: true,
        loop: true,
        keyboardNavEnabled: true,
        autoScaleSliderHeight: 600,
        controlsInside: false,
        imageScaleMode: 'fill',
        arrowsNavAutoHide: false,
        autoScaleSlider: true,
        controlNavigation: 'bullets',
        thumbsFitInViewport: false,
        navigateByClick: true,
        startSlideId: 0,
        slidesSpacing: 1,
        transitionType:'move',
        globalCaption: false,
        deeplinking: {
          enabled: true,
          change: false
        },
        autoPlay: {
            enabled: true,
            pauseOnHover: true,
            stopAtAction: false,
            delay:4000
        }

    });

    //===================================================================
    // FORM VALIDATOR
    //=================================================================== 

    $('.TTWForm').on('submit', function(e){
        e.preventDefault();
        var firstName = $('input[name=field1]').val();
        var lastName = $('input[name=field4]').val();
        var userEmail = $('input[name=field5]').val();
        var userMessage = $('textarea[name=field6]').val();
        //console.log(nome,email);
        var estado = true;
        $('.mensagemErro').hide().removeClass('certo erro aviso');

        // verifica s eo nome é maior que 3 caracteres
        if(firstName.length < 3)
        {
            estado = false;
            $('.mensagemErro').addClass('erro');
            $('.mensagemErro').text("Invalid First Name");
            $('.mensagemErro').fadeIn();
        }

        if(lastName.length < 3)
        {
            estado = false;
            $('.mensagemErro').addClass('erro');
            $('.mensagemErro').text("Invalid Last Name");
            $('.mensagemErro').fadeIn();
        }

        if(userMessage.length < 3)
        {
            estado = false;
            $('.mensagemErro').addClass('erro');
            $('.mensagemErro').text("Invalid Message");
            $('.mensagemErro').fadeIn();
        }
        
        if(!isEmailValid(userEmail))
        {
            estado = false;
            $('.mensagemErro').addClass('erro');
            $('.mensagemErro').text("Invalid Email");
            $('.mensagemErro').fadeIn();
        }
        
        if(estado == true)
        {
            $('.mensagemErro').fadeOut();
            $.ajax({
              method: "POST",
              url: $('.TTWForm').attr("action"),
              data: { field5: userEmail, field4: lastName, field1: firstName, field6: userMessage },
              dataType: "json"
            }).done(function( msg ){
                console.log(msg);
                switch(msg.erro)
                {
                    case 0:
                        $('.mensagemErro').addClass('certo');
         
                    break;

                    case 1:
                        $('.mensagemErro').addClass('erro');
                    break;

                }
                $('.mensagemErro').text(msg.mensagem).fadeIn();
                $('.mensagemErro').text(msg.mensagem).fadeOut(5000);

                
            });
        }

    });


});
    