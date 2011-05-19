function url2cmd(url) {
	var maps_google_co_jp_maps = url.match(/^http:\/\/maps\.google\.co\.jp\/maps\?(.+)/);
	var maps_google_co_jp = url.match(/^http:\/\/maps\.google\.co\.jp\/\?(.+)/);
			
	if (maps_google_co_jp_maps || maps_google_co_jp) {
	   var id = RegExp.$1;
	   main(id);
    } else {
       pne_url2a(url);
    }
}

function main(id) {
    var cmd = id.split("&amp;");
    var param = new Array();
    param["z"] = "15";
    param["ll"] = "0,0";
    for(i=0; i<cmd.length; i++) {
       var work = cmd[i].split("=");
       if( work.length == 2 ) {
         param[work[0]] = work[1];
       }
    }
    var ll = param["ll"].split(",");
    var z = param["z"];
    var t = param["t"];
    var q = param["q"];

    var html = ''
	+ '<iframe MARGINWIDTH="0" MARGINHEIGHT="0" HSPACE="0" VSPACE="0" FRAMEBORDER="0" SCROLLING="no" BORDERCOLOR="#000000" src="?m=pc&a=page_h_googlemap'+'&x='+ll[0]+'&y='+ll[1]+'&z='+z+'&t='+t+'&q='+q+'" name="sample" width="300" height="320">'
	+ 'この部分はインラインフレームを使用しています。'
	+ '</iframe>';
	
    document.write(html);
}
