
let modal = {
    'nick' : document.getElementById("nick_modal"),
    'email' : document.getElementById("email_modal"),
    'pass' : document.getElementById("pass_modal"),
    'first' : document.getElementById("first_modal"),
    'last' : document.getElementById("last_modal"),
    'status' : document.getElementById("status_modal"),
    'descr' : document.getElementById("descr_modal"),
    'style' : document.getElementById("style_modal"),
};

let btn = {
    'nick' : document.getElementById("nick_btn"),
    'email' : document.getElementById("email_btn"),
    'pass' : document.getElementById("pass_btn"),
    'first' : document.getElementById("first_btn"),
    'last' : document.getElementById("last_btn"),
    'status' : document.getElementById("status_btn"),
    'descr' : document.getElementById("descr_btn"),
    'style' : document.getElementById("style_btn"),
};

let close = {
    'nick' : document.getElementById("nick_close"),
    'email' : document.getElementById("email_close"),
    'pass' : document.getElementById("pass_close"),
    'first' : document.getElementById("first_close"),
    'last' : document.getElementById("last_close"),
    'status' : document.getElementById("status_close"),
    'descr' : document.getElementById("descr_close"),
    'style' : document.getElementById("style_close"),
};

{
    let f = function(param)
    {
        btn[param].onclick = function() 
        {
            modal[param].style.display = "block";
        }

        close[param].onclick = function() 
        {
            modal[param].style.display = "none";
        }
    }

    for (let key in modal)
    {
        f(key);
    }
}
