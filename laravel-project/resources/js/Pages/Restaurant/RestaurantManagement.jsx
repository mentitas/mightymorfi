import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import ViewOrders from './Partials/ViewOrders.jsx';
import UpdateRestaurantNameForm from './Partials/UpdateRestaurantNameForm.jsx';
import { Link, useForm, usePage } from '@inertiajs/react';

export default function Edit({ mustVerifyEmail, status, restaurant }) {
    console.error(restaurant);
    return (
        <>        
            <Head title="Restaurant Management" />
            <div className="py-12">
                
                <h1 className="text-xl font-semibold leading-tight text-gray-800"> {restaurant.name} </h1>
                
                <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

                    <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        


                        <ViewOrders               restaurant={restaurant} />
                        <UpdateRestaurantNameForm restaurant={restaurant} />
                    </div>
                </div>
            </div>
        </>
    );
}
