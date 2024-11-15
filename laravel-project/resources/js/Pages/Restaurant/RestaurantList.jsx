import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import RestaurantManagement from './RestaurantManagement.jsx';
import { Link, useForm, usePage } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton.jsx';
import { useEffect, useState, useRef } from 'react';


export default function RestaurantList() {
    
    const user = usePage().props.auth.user;
    const [restaurants, setRestaurants] = useState([]);

    useEffect(() => {
      // Fetch user's restaurants from the backend
      fetch('/api/restaurants/' + user.id)
        .then((response) => response.json())
        .then((data) => setRestaurants(data))
        .catch((error) => console.error('Error fetching restaurants:', error));
    }, []);

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Restaurants administrados
                </h2>
            }
        >
        <Head title="Restaurant" />

        <div className="py-12">

                <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div className="p-6 text-gray-900">
                        <ul>
                            {/* Chequeo de si el usuario tiene un restaurante */}
                            {restaurants ? (
                                restaurants.map((restaurant) => (
                                    <li key={restaurant.id}>
                                        <RestaurantManagement restaurant={restaurant}/>
                                    </li>
                                ))
                            ) : (
                                <>
                                <p className="mt-4 text-gray-700">Parece que no tenés ningún restaurant...</p>
                                </>
                            )}
                        </ul>

                    <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <Link
                            href="/restaurant/create"
                            className="inline-block px-4 py-2 mt-2 text-white bg-green-500 rounded hover:bg-green-600"
                        >
                            Registrar un nuevo restaurant
                        </Link>

                    </div>
                </div>
            </div>
        </div>
        </AuthenticatedLayout>
    );
}
