
function initMap() {

    // opcje dla mapy
    var mapOptions = {
        center: {lat: 52.000, lng: 19.000},
        mapTypeId: 'roadmap',
        zoom: 10,
        minZoom: 4,
        panControl: false,
        fullscreenControl: false,
        mapTypeControl: false,
        streetViewControl: false
    };

    // tworzenie nowej mapy
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);


    // tworzenie wyszukiwarki na pasku nawigacyjnym
    var navInput = document.getElementById('nav-search');
    var navAutocompleteOptions = {componentRestrictions: {country: 'pl'}};
    var navAutocomplete = new google.maps.places.Autocomplete(navInput, navAutocompleteOptions);

    enableEnterKey(navInput);

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
            map.setCenter(place.geometry.location);
            map.setZoom(17);
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

    // var infoWindowAddMarker = new google.maps.InfoWindow({
    //     content: "<button id='info-btn' type='button' class='btn btn-light'>Light</button>"
    // });

    // map.addListener("rightclick", function(event) {
    // infoWindowAddMarker.setPosition(event.latLng);
    // infoWindowAddMarker.open(map);
    // document.getElementById('info-btn').addEventListener("click", addMarker(), false);
    // });

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
