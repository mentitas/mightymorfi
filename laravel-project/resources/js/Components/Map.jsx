import { useEffect, useState, useRef } from 'react';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
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

  const [locations, setLocations] = useState([]);

  useEffect(() => {
    // Fetch restaurant locations from the backend
    fetch('/api/restaurants/locations')
      .then((response) => response.json())
      .then((data) => setLocations(data))
      .catch((error) => console.error('Error fetching locations:', error));
  }, []);

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
          <Marker key={index} position={[location.latitude, location.longitude]} />
        ))}
      {
        // Add a marker for the user's current location
        navigator.geolocation.getCurrentPosition((position) => {
          const { latitude, longitude } = position.coords;
          // center the map on the user's location
          mapRef.current.setView([latitude, longitude], 13);
          //L.marker([latitude, longitude]).addTo(mapRef.current).bindPopup('You are here');
        }, (error) => {
          console.error('Error getting user location:', error);
        })
      }
    </MapContainer>
  </div>
  );
};

export default SimpleMap;
