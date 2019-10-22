var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


function initMap() {

    // opcje dla mapy
    var mapOptions = {
        center: {lat: 52.250, lng: 19.100},
        mapTypeId: 'roadmap',
        zoom: 7,
        minZoom: 7,
        panControl: false,
        fullscreenControl: false,
        mapTypeControl: false,
        streetViewControl: false,
        restriction: {
            latLngBounds: {north: 59.000, south: 43.000, west: 0.000, east: 42.000}
        }
    };

    // tworzenie nowej mapy
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);


    // zapisywanie pozycji okna z mapą
    if (history.state != null) {
        var state = history.state;

        var sw = new google.maps.LatLng(state['sw']);
        var ne = new google.maps.LatLng(state['ne']);

        bounds = new google.maps.LatLngBounds(sw, ne);

        map.fitBounds(bounds);
    }

    google.maps.event.addListenerOnce(map, 'bounds_changed', function() {
        if (history.state != null) {
            map.setZoom(history.state['zoom']);
        }
      });

    google.maps.event.addListener(map, 'idle', function() {
        var bounds = map.getBounds();
        var zoom = map.getZoom();
        var state = {'sw': {lat: bounds.getSouthWest().lat(), lng: bounds.getSouthWest().lng()}, 'ne': {lat: bounds.getNorthEast().lat(), lng: bounds.getNorthEast().lng()}, 'zoom': zoom};
        var title = '';
        var url = document.URL;
        history.replaceState(state, title, url);
    });
    

    // tworzenie wyszukiwarki na pasku nawigacyjnym
    var navInput = document.getElementById('nav-search');
    var navAutocomplete = new google.maps.places.SearchBox(navInput);


    // tworzenie wyszukiwarki pod guzikiem 'dodaj'
    var popupInput = document.getElementById('popup-search');
    var popupAutocomplete = new google.maps.places.SearchBox(popupInput);

    // nasłuchiwanie guzika 'dodaj'
    document.getElementById('add-marker-btn').addEventListener("click", addMarkerFromPopup, false);

    // sprawia że propozycje wyszukiwania odpowiadają aktualnemu widokowi na mapie
    map.addListener('bounds_changed', function() {
        navAutocomplete.setBounds(map.getBounds());
        popupAutocomplete.setBounds(map.getBounds());
      });

    // tworzenie znacznika który pokaże się po wyszukaniu
    var searchMarker = new google.maps.Marker({
        map: map,
      });


    // wyszukiwanie poprzez wyszukiwarke na pasku
    navAutocomplete.addListener('places_changed', function(){
        var place = navAutocomplete.getPlaces()[0];

        if (!place.geometry) {
            window.alert("Nic nie znaleziono dla wejścia: '" + place.name + "'");
            return;
        }

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setZoom(17);
            map.setCenter(place.geometry.location);
        }
    });


    // pobranie znaczników z bazy
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "mapa/googlemap.php", true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);

            var markers = Array();

            for(var i = 0; i < data.length; i++) {
                var marker = {
                    coords: {lat: parseFloat(data[i].lat), lng: parseFloat(data[i].lng)},
                    item: data[i].product,
                    comment: data[i].comment
                }
                markers.push(marker);
            }
    
            for(var i = 0; i < markers.length; i++) {
                addMarker(markers[i]);
            }
        }

    };

    function addMarker(props) {

        var marker = new google.maps.Marker({
        position: props.coords,
        map: map,
        });

        if(props.iconImg) {
            marker.setIcon(props.iconImg);
        }

        if(props.item) {
            var content = "<h3>Do odebrania: " + props.item;
            if(props.comment) {
                content += "</h3><h6>" + props.comment + "</h6>";
            }

            var infoWindow = new google.maps.InfoWindow({
                content: content
                });

            marker.addListener('mouseover', function(){
                infoWindow.open(map, marker);
                });

            marker.addListener('click', function(){
                infoWindow.open(map, marker);
                });

            marker.addListener('mouseout', function(){
                infoWindow.close(map, marker);
                });

        }

        // przybliża mapę gdy znacznik zostanie kliknięty
        marker.addListener('click', function() {
            map.setZoom(17);
            map.setCenter(marker.getPosition());
        });
    }

    function addMarkerFromPopup() {
        var place = popupAutocomplete.getPlaces()[0];

        if (!place.geometry) {
            window.alert("Nic nie znaleziono dla wejścia: '" + place.name + "'");
            return;
        }

        var item = document.getElementById('popup-item').value;
        var comment = document.getElementById('popup-comment').value;

        var props = {
            coords: place.geometry.location,
            item: item,
            comment: comment,
        }
        
        addMarker(props);

        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();
        var address = place.name;

        map.setZoom(17);
        map.setCenter(place.geometry.location);

        $.ajax({
            type: "POST",
            url: "mapa/upload-markers.php",
            data: {
                    item: item,
                    comment: comment,
                    lat: lat,
                    lng: lng,
                    address: address
                }
        });
    }
}
