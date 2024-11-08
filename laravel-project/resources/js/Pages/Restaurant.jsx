import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import RestaurantManagement from './Restaurant/RestaurantManagement.jsx';
import { Link, useForm, usePage } from '@inertiajs/react';


export default function Restaurant() {
    
    const user = usePage().props.auth.user;
    const { restaurants } = usePage().props;

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
            <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div className="p-6 text-gray-900">
                        <ul>
                          {restaurants.map((restaurant) => (
                            <li key={restaurant.id}>
                                <RestaurantManagement restaurant={restaurant}/>
                            </li>
                          ))}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </AuthenticatedLayout>
    );
}
