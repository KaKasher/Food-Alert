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
            latLngBounds: {north: 57.000, south: 45.000, west: 5.500, east: 36.000}
        }
    };

    // tworzenie nowej mapy
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // opcje wyszukiwarki
    var autocompleteOptions = {componentRestrictions: {country: 'pl'}};

    // tworzenie wyszukiwarki na pasku nawigacyjnym
    var navInput = document.getElementById('nav-search');
    var navAutocomplete = new google.maps.places.Autocomplete(navInput, autocompleteOptions);
    enableEnterKey(navInput);

    // tworzenie wyszukiwarki pod guzikiem 'dodaj'
    var popupInput = document.getElementById('popup-search');
    var popupAutocomplete = new google.maps.places.Autocomplete(popupInput, autocompleteOptions);
    enableEnterKey(popupInput);

    document.getElementById('add-marker-btn').addEventListener("click", addMarkerFromPopup, false);

    // sprawia że propozycje wyszukiwania odpowiadają aktualnemu widokowi na mapie
    navAutocomplete.bindTo('bounds', map);

    // tworzenie znacznika który pokaże się po wyszukaniu
    var searchMarker = new google.maps.Marker({
        map: map,
      });

    
    navAutocomplete.addListener('place_changed', function(){
        searchMarker.setVisible(false);
        var place = navAutocomplete.getPlace();
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

        searchMarker.setPosition(place.geometry.location);
        searchMarker.setVisible(true);
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

            marker.addListener('click', function(){
                infoWindow.open(map, marker);
                });
        }

        // przybliża mapę gdy znacznik zostanie kliknięty
        marker.addListener('click', function() {
            map.setZoom(17);
            map.setCenter(marker.getPosition());
        });

    }

    function addMarkerFromPopup() {
        var place = popupAutocomplete.getPlace();

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

        map.setZoom(17);
        map.setCenter(place.geometry.location);

        $.ajax({
            type: "POST",
            url: "mapa/upload-markers.php",
            data: {
                    item: item,
                    comment: comment,
                    lat: lat,
                    lng: lng
                }
        });
    }

}


// podczas wcisnięcia klawisza enter na pasku wyszukiwania, wybierze pierwszy wynik
function enableEnterKey(input) {

    const _addEventListener = input.addEventListener

    const addEventListenerWrapper = (type, listener) => {
      if (type === "keydown") {
        const _listener = listener
        listener = (event) => {
          const suggestionSelected = document.getElementsByClassName('pac-item-selected').length
          if (event.key === 'Enter' && !suggestionSelected) {
            const e = new KeyboardEvent("keydown", { key: "ArrowDown", code: "ArrowDown", keyCode: 40 });
            e.key = 'ArrowDown'
            e.code = 'ArrowDown'
            _listener.apply(input, [e]);
          }
          _listener.apply(input, [event]);
        }
      }
      _addEventListener.apply(input, [type, listener]);
    }

    input.addEventListener = addEventListenerWrapper;
  }
