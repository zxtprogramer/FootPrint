var userLong,userLat;
var usrMarker;
var map;
var picMarker=new Array();

function initMap(){
   map = new AMap.Map('container',{
            resizeEnable: true,
            zoom: 10,
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


function getUserPic(){
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
            res=xmlhttp.responseText;
            imgArr=res.split(";");
            i=0;
            for(i=0;i<imgArr.length;i++){
                info=imgArr[i].split(",");
                path=info[0];
                longitude=parseFloat(info[1]);
                latitude=parseFloat(info[2]);
                picMarker[i]=new AMap.Marker({position:[longitude,latitude]});
                picMarker[i].setMap(map);
            }
            
        }
    }

    xmlhttp.open("POST", "query.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("cmd=getUserPic&num=5&longMin=" + longMin + "&longMax=" + longMax + "&latMin=" + latMin + "&latMax=" + latMax);

}



function clearUserPos(){
    userMarker.setMap();
}

function start(){
    initMap();
    getUserPos();
    getUserPic();
    
}

start();

