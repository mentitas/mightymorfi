import { useEffect, useState, useRef } from 'react';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';

const SimpleMap = () => {
  const mapRef = useRef(null);
  const [locations, setLocations] = useState([]);
  const latitude = 51.505;
  const longitude = -0.09;

  useEffect(() => {
    // Fetch restaurant locations from the backend
    fetch('/api/restaurants/locations')
      .then((response) => response.json())
      .then((data) => setLocations(data))
      .catch((error) => console.error('Error fetching locations:', error));
  }, []);

  return (
    <MapContainer center={[latitude, longitude]} zoom={13} ref={mapRef} style={{ height: '100vh', width: '100vw' }}>
      <TileLayer
        attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      />
      {locations.map((location, index) => (
        <Marker key={index} position={[location.latitude, location.longitude]}>
          <Popup>{location.name}</Popup>
        </Marker>
      ))}
    </MapContainer>
  );
};

export default SimpleMap;
