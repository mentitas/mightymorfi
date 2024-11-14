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
            
            <Head title="Restaurants" />
                
                <ul>
                    {restaurants.map((restaurant) => (
                    <li key={restaurant.id}>
                        <div className="py-12">
                        <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                        <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                                <RestaurantManagement restaurant={restaurant}/>
                        </div>
                        </div>
                        </div>
                    </li>
                    ))}
                </ul>

        </AuthenticatedLayout>
    );
}
