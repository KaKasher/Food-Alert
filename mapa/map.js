
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
 

    // dodaje znacznik podczas kliknięcia
    google.maps.event.addListener(map, 'click', function(event){
        addMarker({coords: event.latLng});
    });

    var markers = [
    {coords: {lat: 52.000, lng: 19.000}},
    {coords: {lat: 52.500, lng: 19.500}},
    {
        coords: {lat: 52.050, lng: 19.100},
        iconImg: 'http://maps.google.com/mapfiles/kml/shapes/dining.png',
        content: "<img src='https://trello-attachments.s3.amazonaws.com/5d989f3d4abf6e1e4ebad3ff/178x151/7a6711ebb8216ca83c6df90591571bb1/Bez_tytu%C5%82u.png'/>"
    }
    ];

    // dodaje wszystkie znaczniki
    for(var i = 0; i < markers.length; i++) {
        addMarker(markers[i]);
    }


    function addMarker(props) {

        var marker = new google.maps.Marker({
        position: props.coords,
        map: map,
        });

        if(props.iconImg) {
            marker.setIcon(props.iconImg);
        }

        if(props.content) {
            var infoWindow = new google.maps.InfoWindow({
            content: props.content
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
            content: "<h3>Do odebrania: " + item + "</h3><h6>" + comment + "</h6>"
        }

        addMarker(props);

        map.setZoom(17);
        map.setCenter(place.geometry.location);
        
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
