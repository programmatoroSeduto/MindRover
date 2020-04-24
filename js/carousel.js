let carousel_elements_list = null;
let carousel_active_panel = null;

function carouselImage(n)
{
    //riferimento a tutti i pannelli nel carosello
    if(carousel_elements_list === null)
    {
        carousel_elements_list = $(".splash-carousel-content").children();
        carousel_active_panel = carousel_elements_list.first();
    }
    
    let animDuration = 500;
    //nascondi tutti i pannelli
    //panels.css({"display": "none"});
    carousel_active_panel.fadeOut(animDuration).css({"display": "none"});

    //visualizza solo il pannello indicato dal numero
    let elem = carousel_elements_list.first();
    for(let i=1; i<=carousel_elements_list.length; i++)
    {
        if(i == n)
        {
            elem.fadeIn(animDuration).css({"display": "block"});
            carousel_active_panel = elem;
        }
        else
        {
            elem = elem.next();
        }
    }
}

