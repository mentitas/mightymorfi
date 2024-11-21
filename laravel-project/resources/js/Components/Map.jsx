import { usePage } from '@inertiajs/react';
import { useEffect, useState, useRef } from 'react';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import SecondaryButton from '@/Components/SecondaryButton';

import L from 'leaflet';
import "leaflet/dist/leaflet.css";

// Import marker icons
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

// Set up the default icon
const defaultIcon = L.icon({
  iconUrl: markerIcon,
  shadowUrl: markerShadow,
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

// Apply the icon globally to avoid reassigning for each Marker
L.Marker.prototype.options.icon = defaultIcon;

const SimpleMap = () => {
  const mapRef = useRef(null);
  const latitude = 51.505;
  const longitude = -0.09;

  //Busco las props con la location desde Inertia
  const locations = usePage().props.locations;
  console.log(locations);

  return (
    <div className="mx-auto max-w-screen-lg px-4"> {/* Centers and constrains width */}
      <MapContainer
        center={[latitude, longitude]}
        zoom={13}
        ref={mapRef}
        style={{ height: "500px", width: "100%" }} // Width is responsive to container
        className="rounded-lg shadow-lg"
      >
        <TileLayer
          attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        />

        {locations.map((location, index) => (
        <Marker key={index} position={[location.latitude, location.longitude]}>

          <Popup>
              <h3 className="font-bold">{location.name}</h3>
              <img width="75" height="75" src={location.logo}/>

              <p><strong>Opening Hours:</strong> {location.timetable || "Not Available"}</p>

                <SecondaryButton className="my-2"
                                onClick={() => window.open(location.menu, '_blank')}>
                    Ver el menu        
                </SecondaryButton>
                <SecondaryButton className="my-2"
                                 onClick={() => window.location.href = '/order/' + location.id + '/pickup'}>
                    Hacer pedido Pickup
                </SecondaryButton>
               
            </Popup>
        </Marker>
        ))}
      {
        // Agregar un puntito con la posición del usuarix
        navigator.geolocation.getCurrentPosition((position) => {
          const { latitude, longitude } = position.coords;
          mapRef.current.setView([latitude, longitude], 13);
        }, (error) => {
          console.error('Error getting user location:', error);
        })
      }
    </MapContainer>
  </div>
  );
};

export default SimpleMap;
