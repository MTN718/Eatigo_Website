//map on detail page
var marker;
var map;
var newMarkers = Array();
var newMarkers_boy = Array();
var rlat,rlon;
var icon_marker = basePath+'/themes/default/images/markermap090758/map_icon.png';
var icon_marker_notactive = {
    url: basePath+'/themes/default/images/markermap090758/marker_close.png', // url
    scaledSize: new google.maps.Size(40, 60), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
};
var icon_marker_active = basePath+'/themes/default/images/markermap090758/marker_yellow.png'; 
var currentMarker = 0;
function initialize(lat, lon) 
{
	rlat = lat;
	rlon = lon;
	
	if(action == 'restaurant'){
		detailHereAndNow();
	}else{
	
		var center = new google.maps.LatLng(rlat, rlon);
		var parliament = new google.maps.LatLng(rlat, rlon);
	  	var mapOptions = {
	    	zoom: 16,
	    	center: center,
			scrollwheel: false,
			navigationControl: false,
			mapTypeControl: false,
			scaleControl: false,
	  	};
		
		var restoname = document.getElementById('restoname').value;
		var restoaddress = document.getElementById('restoaddress').value;
	  	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	  	marker = new google.maps.Marker({
	    	map:map,
			icon:host+'/themes/default/images/detail/map_icon.png',
	    	draggable:false,
	    	animation: google.maps.Animation.DROP,
	   		position: parliament
	  	});
	  
	   	var contentString = '<div>'+restoname+'</div><div>'+restoaddress+'</div>';
	
	  	var infowindow = new google.maps.InfoWindow({
	      	content: contentString
	  	});
	  
	  	google.maps.event.addListener(marker, 'click', function()
	  	{
	 		infowindow.open(map, marker);
	  	});
  	
    }
}

function detailHereAndNow() {	
	
	var date = $('#date').val();
	var ppl = $('#ppl').val();
	var rid = $('#rid').val();
	
	if(!ppl)ppl = 2;
	
	if(time_stamp) time = time_stamp;
	
	var url = apiURL + 'search/?jsoncallback=?';
	var data = {'stype':2,'date':date,'time':time,'ppl':ppl,'partner':'2,17','lat':rlat,'lon':rlon,'sortby':5,'page':1,'pp':30};
	var LocationData = Array();
	var maLocation = Array();
	var i = 0;	
	$.post(url, data, function(jsonData) {
		if(jsonData.status == '200'){
			hereAndNow = jsonData.items;
			$.each(jsonData.items, function(index, item) {				
					if (from) {
						togoLink = basePath + '/' + countryCode + '/' + lang + '/' + city_select + '/restaurant/name/' + item.name_url + '/?from=' + from + '&source=';
					} else {
						togoLink = basePath + '/' + countryCode + '/' + lang + '/' + city_select + '/restaurant/name/' + item.name_url + '/?source=';
					}					
					var lat = item.lat;
					var lon = item.lon;
					var discount = item.timeSlot[0].detail.discount;
					var name = item.name;
					var onMap = item.onMap;	
					if(i== 0){
						var html = '<div style="color:#bc181f;">'+fullName+'</div>';
						maLocation[0] = Array(rlat,rlon, html, '', fullName, onMap);
					}
					if(rid != item.resto_id){
						var html = '<a href="'+togoLink+'" style="color:#767676;">'+item.name+'</a>';
						LocationData[i] = Array(lat,lon, html, discount, name, onMap, item.resto_id);
						i++;
					}
					
			});		
			LocationData = $.merge(maLocation, LocationData);
			initializeHND(LocationData,rlat,rlon);	
		}
	},'json');
}


function initializeHND(LocationData,rlat,rlon)
{
	maData = LocationData;
	var mapOptions = {
						scrollwheel: false,
						navigationControl: true,
						mapTypeControl: true,
						scaleControl: false,
					};
	
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var bounds = new google.maps.LatLngBounds();
    var infowindow = new google.maps.InfoWindow({
      				 								maxWidth:330,
													maxHeight:380,
  												});
	var newMarkers_boy = marker = Array(); var mySwiper = Array();
	
    for (var i in LocationData)
    {
        var p = LocationData[i];
		var latlng = new google.maps.LatLng(p[0], p[1]);
		bounds.extend(latlng);	
		if(i == 0){
			var iconmarker = icon_marker_active; 
		} else if(p[5] == 0){
			var iconmarker = icon_marker_notactive; 
		}else{
			var iconmarker = basePath+'/themes/default/images/hereandnow/'+p[3]+'_percent.png'; 
		}		
		
        marker = new google.maps.Marker({
												position: latlng,
												map: map,
												draggable:false,
												//animation: google.maps.Animation.DROP,
												title: p[4],
												content: p[2],
												onmap: p[5],
												icon: iconmarker,
												rid: iconmarker,
												id:i,
										});
		google.maps.event.addListener(marker, 'click', function()
		{
				/*
				if(currentMarker){infowindow.close(map, currentMarker);}
				for (var i=0; i<newMarkers.length; i++) {
					//console.log(newMarkers[i].onmap);
					if(newMarkers[i].onmap == 0){
						newMarkers[i].setIcon(icon_marker_notactive);
					}else{
						newMarkers[i].setIcon(icon_marker);
					}										
				}		
				infowindow.close();		
				this.setIcon(icon_marker_active);	
				*/			
				infowindow.setContent(this.content);
				infowindow.open(map, this);
				currentMarker = this.id;	
				
		}); 
		newMarkers.push(marker);
		if(action != 'hereandnow')
		{
			if(p[3]!=0)newMarkers_boy.push(marker);
		}
		//google.maps.event.trigger(marker[i], 'click');
    }

	//$(".content_map").show();
	if(action != 'hereandnow')
	{
		var bounds = new google.maps.LatLngBounds();
		for(var i = 0, allMarker = newMarkers_boy.length; i < allMarker; i++){
			bounds.extend(newMarkers_boy[i].getPosition());
		}
		map.fitBounds(bounds);
	}else{
		map.fitBounds(bounds);
	}
	//infowindow.open(map,marker[0]);
	
	//google.maps.event.trigger(map, "resize");
	if(1)
	{
		google.maps.event.addListener(map, 'dragend', function()//dragend
		{ 
			if(1) 
			{// alert(map.getBounds());
				infowindow.close();				
				var bounds_new = map.getBounds();
				var ne = bounds_new.getNorthEast(); // LatLng of the north-east corner
				var sw = bounds_new.getSouthWest(); // LatLng of the south-west corder
				removeAndloadmore2(map, ne, sw);
			}
		});
		
		google.maps.event.addListener(map, 'zoom_changed', function()
		{
			if(1) 
			{ 
				infowindow.close();				
				var bounds_new = map.getBounds(); //alert(bounds_new);
				if(bounds_new)
				{
					var ne = bounds_new.getNorthEast(); // LatLng of the north-east corner
					var sw = bounds_new.getSouthWest(); // LatLng of the south-west corder
					removeAndloadmore2(map, ne, sw);
				}
			}
		});
		google.maps.event.trigger(newMarkers[0], 'click');
	}
}
function removeAndloadmore2(map, ne, sw)
{
	rlat = map.getCenter().lat(); 
	rlon = map.getCenter().lng(); //console.log(lat, lon);
	moveLo4HereAndNow2(map, ne, sw);
}

function moveLo4HereAndNow2(map, ne, sw) {
	
	var date = $('#date').val();
	var ppl = $('#ppl').val();
	var rid = $('#rid').val();
	//clearMarkers();
	if(!ppl)ppl = 2;
	
	if(time_stamp) time = time_stamp;
	
	var url = apiURL + 'search/?jsoncallback=?';
	var data = {'stype':2,'date':date,'time':time,'ppl':ppl,'partner':'2,17','lat':rlat,'lon':rlon,'sortby':5,'page':1,'pp':1000};
	
	maData = Array();
	LocationData = Array();
	
	var i = 0;	
	$.post(url, data, function(jsonData) {
		if(jsonData.status == '200'){
			if (jsonData.items != 'no result') {
				
				hereAndNow = arrayUnique(hereAndNow, jsonData.items);				
				$.each(hereAndNow, function(index, item) {
					
					if ((item.lat >= sw.lat() && item.lat <= ne.lat()) && (item.lon <= ne.lng() && item.lon >= sw.lng())) {
						if (from) {
							togoLink = basePath + '/' + countryCode + '/' + lang + '/' + city_select + '/restaurant/name/' + item.name_url + '/?from=' + from + '&source=';
						} else {
							togoLink = basePath + '/' + countryCode + '/' + lang + '/' + city_select + '/restaurant/name/' + item.name_url + '/?source=';
						}					
						var lat = item.lat;
						var lon = item.lon;
						var discount = item.timeSlot[0].detail.discount;
						var name = item.name;
						var onMap = item.onMap;					
						var html = '<a href="'+togoLink+'" style="color:#767676;">'+item.name+'</a>';
						if(rid != item.resto_id){
							LocationData[i] = Array(lat, lon, html, discount, name, onMap, item.resto_id);
							i++;
						}
					}
					
				});
				morePIN2(LocationData, map)
			} 
		}
	},'json');
}

function morePIN2(LocationData, map)
{
	maData = LocationData;
	var bounds = new google.maps.LatLngBounds();
    var infowindow = new google.maps.InfoWindow({
      				 								maxWidth:330,
													maxHeight:380,
  												});
    for (var i in LocationData)
    {
        
        var p = LocationData[i];
		var latlng = new google.maps.LatLng(p[0], p[1]);
		bounds.extend(latlng);
		
		if(p[5] == 0){
			var iconmarker = icon_marker_notactive; 
		}else{
			var iconmarker = basePath+'/themes/default/images/hereandnow/'+p[3]+'_percent.png';			 
		}
		
        marker = new google.maps.Marker({
												position: latlng,
												map: map,
												draggable:false,
												//animation: google.maps.Animation.DROP,
												title: p[4],
												content: p[2],
												onmap: p[5],
												icon: iconmarker,
												id:i,
										});
		
		google.maps.event.addListener(marker, 'click', function()
		{
			/*
			for (var i=0; i<newMarkers.length; i++) {
				//console.log(newMarkers[i].onmap);
				if(newMarkers[i].onmap == 0){
					newMarkers[i].setIcon(icon_marker_notactive);
				}else{
					newMarkers[i].setIcon(icon_marker);
				}							
			}	
			infowindow.close();			
			this.setIcon(icon_marker_active);	
			*/		
			infowindow.setContent(this.content);
			infowindow.open(map, this);	
			currentMarker = this.id;		
		});
		newMarkers.push(marker);
    }
    
    //if(currentMarker) google.maps.event.trigger(currentMarker, 'click');
}



