var app = {
    
    marquee : function(){
        $('#marque').marquee({
            //speed in milliseconds of the marquee
            duration: 25000,
            //gap in pixels between the tickers
            gap: 50,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            direction: 'left',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true
        });
    },
    
    carouFredSel : function(){
        if($('#Crs').length == 0) return;
        $('#Crs').carouFredSel({
            circular: true,
            responsive : true,
            items                : 4,
            height : 320,
            direction            : "left",
            scroll : {
                items            : 1,
                easing            : "",
                duration        : 1000,
                pauseOnHover    : true
            }
        });
        
    },
    
    validateComment : function(){
        $('#CommentForm button').on('click' , function(){
            $('#CommentForm').validate({rules: {
                Name: {
                    required: true,
                    minlength: 2
                },
                Email : {
                    required: true,
                    email : true
                },
                Website : {
                    required: false,
                    url : true
                },
                Comment : {
                    required: true,
                    minlength: 5
                }
              },
              messages: {
                Name: {
                  required: "We need your email address to contact you",
                  minlength: jQuery.validator.format("At least {0} characters required!")
                }
              }
              
          });
          var valid = $('#CommentForm').valid();
          if(valid == true){
                $('#CommentForm').submit();
          } else {
              
          }
          
          return false;  
        });
        //console.log('validate comment');
    },
    
    popup : function(El){
       //console.log(El);
        var w = 600, h = 500;
        var left = ($(window).width/2)-(w/2);
        var top = ($(window).height/2)-(h/2);
        return window.open($(El).attr('href'), 'Distribuie', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    },
    
    fixedMenu : function(){
        $(document).on('scroll' , function(){
            var top = $('body').scrollTop();
            if(top > 130){
                $('.row.cat-main').addClass('tpfx');
            } else {
                $('.row.cat-main').removeClass('tpfx');
            }
        });  
    },
    likeModal : function(){
        
        if(typeof(Storage) !== "undefined") {
            // Store
            var wasDisplayed = localStorage.getItem('popupdisplayed');
            if(!wasDisplayed){
                localStorage.setItem("popupdisplayed", true);
                $('#FacebookLikeAndShare').modal('show');
            }
            localStorage.setItem("popupdisplayed", true);
            
        } else {
            // Sorry! No Web Storage support..
            return;
        }
    },
    mobileMenuToggle : function(){
        
     
            if($('#SdMn').hasClass('open'))
            {
                $('#SdMn').removeClass('open');
            }
            else
            {
                $('#SdMn').addClass('open');
            }
            
            return false; 
        
    },
    initialize : function(){
        this.marquee();  
        this.carouFredSel();
        this.fixedMenu();
        this.likeModal();
        this.mobileMenu();
    }
};


$().ready(function(){
   app.initialize(); 
});