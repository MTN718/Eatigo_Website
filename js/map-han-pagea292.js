var maData = Array();
var newMarkers = Array();
function initializeHN(LocationData)
{
	maData = LocationData;
	if(action == 'hereandnow')
	{
		var mapOptions = {
							scrollwheel: false,
							navigationControl: true,
							mapTypeControl: true,
							scaleControl: false,
						};
	}
	else
	{
		var maLocation = Array();
		maLocation[0] = Array(lat, lon, '<div class="box-banner-bottom-hnm-here">You are here.</div>', 0, 'You are here.');
		LocationData = $.merge(maLocation, LocationData);
		//var center = new google.maps.LatLng(lat, lon);
		/*
		var mapOptions = {
							zoom: 15,
							center: center,
							scrollwheel: false,
							navigationControl: false,
							mapTypeControl: false,
							scaleControl: false,
						};
		*/
		var mapOptions = {
							scrollwheel: false,
							navigationControl: true,
							mapTypeControl: true,
							scaleControl: false,
						};
	}
    var map = new google.maps.Map(document.getElementById('hn-map'), mapOptions);
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
		if(action == 'hereandnow')
		{
			bounds.extend(latlng);
		}
		else
		{
			if( (i <= 10) && (LocationData[4] != 'You are here.' ) )
			{
				bounds.extend(latlng);
			}
		}

        marker = new google.maps.Marker({
												position: latlng,
												map: map,
												draggable:false,
												//animation: google.maps.Animation.DROP,
												title: p[4],
												content: p[2],
												icon: basePath+'/themes/default/images/hereandnow/'+p[3]+'_percent.png',
												id:i,
										});
		google.maps.event.addListener(marker, 'click', function()
		{
				infowindow.setContent(this.content);
				infowindow.open(map, this);
				setTimeout(function()
				{ 
					for(var i = 0; i < LocationData.length; i++)
					{
						swipperHN(i, 'hnm');
					}
				},100);
		}); 
		newMarkers.push(marker);
		if(action != 'hereandnow')
		{
			if(p[3]!=0)newMarkers_boy.push(marker);
		}
    }

	$(".content_map").show();
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
	//google.maps.event.trigger(map, "resize");
	//if(action == 'hereandnow')
	//{
		google.maps.event.addListener(map, 'dragend', function()//dragend
		{ 
			if(document.getElementById("move-map").checked === true) 
			{// alert(map.getBounds());
				var bounds_new = map.getBounds();
				var ne = bounds_new.getNorthEast(); // LatLng of the north-east corner
				var sw = bounds_new.getSouthWest(); // LatLng of the south-west corder
				removeAndloadmore(map, ne, sw);
			}
		});
		
		google.maps.event.addListener(map, 'zoom_changed', function()
		{
			if(document.getElementById("move-map").checked === true) 
			{ 
				var bounds_new = map.getBounds(); //alert(bounds_new);
				if(bounds_new)
				{
					var ne = bounds_new.getNorthEast(); // LatLng of the north-east corner
					var sw = bounds_new.getSouthWest(); // LatLng of the south-west corder
					removeAndloadmore(map, ne, sw);
				}
			}
		});
	//}
	$(".up_map").show();
}

function removeAndloadmore(map, ne, sw)
{
	lat = map.getCenter().lat(); 
	lon = map.getCenter().lng(); //console.log(lat, lon);
	moveLo4HereAndNow(map, ne, sw);
}

function morePIN(LocationData, map)
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

        marker = new google.maps.Marker({
												position: latlng,
												map: map,
												draggable:false,
												//animation: google.maps.Animation.DROP,
												title: p[4],
												content: p[2],
												icon: basePath+'/themes/default/images/hereandnow/'+p[3]+'_percent.png',
												id:i,
										});
		
		google.maps.event.addListener(marker, 'click', function()
		{
			infowindow.setContent(this.content);
			infowindow.open(map, this);
			setTimeout(function()
			{ 
				for(var i = 0; i < LocationData.length; i++)
				{
					swipperHN(i, 'hnm');
				}
			},100);
		});
		newMarkers.push(marker);
    }
}
 
//google.maps.event.addDomListener(window, 'load', initialize);