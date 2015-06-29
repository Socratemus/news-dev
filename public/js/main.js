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
        $('#Crs').carouFredSel({
            circular: true,
            responsive : true,
            items                : 3,
            // height : 200,
            direction            : "left",
            scroll : {
                items            : 1,
                easing            : "elastic",
                duration        : 1000,
                pauseOnHover    : true
            }
        });
        
    },
    
    initialize : function(){
        this.marquee();  
        this.carouFredSel();
    }
};


$().ready(function(){
   app.initialize(); 
});