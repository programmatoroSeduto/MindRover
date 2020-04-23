function carouselImage(n)
{
    //riferimento a tutti i pannelli nel carosello
    let panels = $(".splash-carousel-content").children();
    
    //nascondi tutti i pannelli
    panels.css({"display": "none"});

    //visualizza solo il pannello indicato dal numero
    let elem = panels.first();
    for(let i=1; i<=panels.length; i++)
    {
        if(i == n)
        {
            elem.css({"display": "block"});
        }
        else
        {
            elem = elem.next();
        }
    }
}