function nav_my_fun(){
    picFlag=1;
    $("#UploadDiv").hide();

    $("#PanelDiv").slideToggle("slow");
}

function nav_all_fun(){
    picFlag=0;
}

function nav_logout_fun(){
    $("#logoutForm").submit();
}

function nav_upload_fun(){
    $("#UploadDiv").show();

    $("#PanelDiv").slideToggle("slow");

}


