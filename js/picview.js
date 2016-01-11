
$(window).resize(function(){ 
$('#PicView').css({ 
position:'absolute', 
left: ($(window).width() - $('#PicView').outerWidth())/2, 
//top: ($(window).height() - $('#PicView').outerHeight())/2 + $(document).scrollTop()
top:0
}); 
}); 


function showPicView(path){
    $("#PicViewImg").attr("src",path);
    $('#PicView').css({ 
    position:'absolute', 
    left: ($(window).width() - $('#PicView').outerWidth())/2, 
    //top: ($(window).height() - $('#PicView').outerHeight())/2 + $(document).scrollTop()
    top:0
    }); 

}

function hidePicView(path){
    $("#PicViewImg").attr("src",path);
    $('#PicView').css({ 
    position:'absolute', 
    left: ($(window).width() - $('#PicView').outerWidth())/2, 
    //top: ($(window).height() - $('#PicView').outerHeight())/2 + $(document).scrollTop()
    top: 50-$('#PicView').outerHeight()
    }); 

}


hidePicView();

$("#PicViewControlDiv").click(function(){hidePicView();});

