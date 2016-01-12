var userLong,userLat;
var usrMarker;
var map;
var picMarker=new Array();
var mouseLongitude;
var mouseLatitude;

function initMap(){
   map = new AMap.Map('container',{
            resizeEnable: true,
            zoom: 12,
            center: [116.39,39.9]
    });
}


function getUserPos(){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        userLong=0;
        userLat=0;
        if(xmlhttp.readyState==4 && xmlhttp.status==200){
            res=xmlhttp.responseText;
            resArr=res.split(" ");
            longitude=parseFloat(resArr[0]);
            latitude=parseFloat(resArr[1]);

            if(longitude>0 && longitude<180 && latitude>0 && latitude<90){
                userLong=longitude;
                userLat=latitude;
            }
            else{
                userLong=0;
                userLat=0;
            }
 
            userMarker=new AMap.Marker({position:[userLong,userLat]});
            userMarker.setMap(map);
            
        }
    }

    xmlhttp.open("POST", "query.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("cmd=getUserPos");

}


function getPic(flag){

    bounds=map.getBounds().toString();
    bArr=bounds.split(';');
    ws=bArr[0].split(',');
    en=bArr[1].split(',');
    longMin=Math.min(parseFloat(ws[0]),parseFloat(en[0]));
    longMax=Math.max(parseFloat(ws[0]),parseFloat(en[0]));
    latMin=Math.min(parseFloat(ws[1]),parseFloat(en[1]));
    latMax=Math.max(parseFloat(ws[1]),parseFloat(en[1]));

    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        userLong=0;
        userLat=0;
        if(xmlhttp.readyState==4 && xmlhttp.status==200){

            for(i=0;i<picMarker.length;i++){
                picMarker[i].setMap();
            }

            res=xmlhttp.responseText;
            
            imgArr=res.split(";");
            i=0;
            for(i=0;i<imgArr.length;i++){
                info=imgArr[i].split(",");
                path=info[0];
                longitude=parseFloat(info[1]);
                latitude=parseFloat(info[2]);
                if(i<picMarker.length){
                    picMarker[i].setMap();
                }
                 
                snapPath=path + "_snap.jpg";
                infoList=[];
                infoList.push("<div class=\"SnapMainDiv\"><div class=\"SnapImgDiv\"><img class=\"SnapImg\" src=\"" + snapPath + "\" onclick=\"javascript:_onClickMarker('" + path + "')\"/></div></div>");

	        picMarker[i]=new AMap.Marker({position:[longitude,latitude]});
                picMarker[i].setLabel({offset:new AMap.Pixel(20,20), content: infoList.join("<br/>")});
                picMarker[i].setMap(map);
            }
            
        }
    }

    xmlhttp.open("POST", "query.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    if(flag==0){
        xmlhttp.send("cmd=getAllPic&num=" + picNum + "&longMin=" + longMin + "&longMax=" + longMax + "&latMin=" + latMin + "&latMax=" + latMax);
    }
    else{
        xmlhttp.send("cmd=getUserPic&num=" + picNum + "&longMin=" + longMin + "&longMax=" + longMax + "&latMin=" + latMin + "&latMax=" + latMax);
    }

}




function picMakerClear(){
    i=0;
    for(i=0;i<picMarker.length;i++){
        picMarker[i].setMap();
    }
}

function _onClick(e){
    mouseLongitude=e.lnglat.getLng();
    mouseLatitude=e.lnglat.getLat();
    //alert(mouseLongitude + "," + mouseLatitude);
    //
    pos=(mouseLongitude + "," + mouseLatitude);
    $("#UploadIFrame").contents().find("#picPos").attr("value",pos );
}



function _onClickMarker(path){
    $("#PicViewImg").attr("src",path);
}


function _onMoveend(e){ 
    getPic(picFlag); 
}
function _onDragend(e){
    getPic(picFlag); 
}
function _onZoomend(e){
    getPic(picFlag); 
}
function _onTouchend(e){
    getPic(picFlag); 
} 

function addListener(){
    AMap.event.addListener(map,"moveend",_onMoveend);
    AMap.event.addListener(map,"dragend",_onMoveend);
    AMap.event.addListener(map,"zoomend",_onMoveend);
    AMap.event.addListener(map,"touchend",_onMoveend);
    AMap.event.addListener(map,"click",_onClick);
}



function clearUserPos(){
    userMarker.setMap();
}

function start(){
    initMap();
    addListener();
    getUserPos();
    
}

start();

