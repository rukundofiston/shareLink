$(document).ready(function(){
    //alert('principe');
    var li = $('#principes_bas li');
    var div = $('#principes_haut div');
    li.click(function(event){
        id = li.index($(event.target));
        div.each(function(){
         $(this).css({display:"none"});
        });
        $(div.get(id)).css({"display":"block", "padding-top":"36px", "padding-left": "36px", "padding-right": "180px", "height": "164px"});
        li.each(function(){
           $(this).removeClass('selectionne') ;
        });
        $(li.get(id)).addClass('selectionne');
    });
});