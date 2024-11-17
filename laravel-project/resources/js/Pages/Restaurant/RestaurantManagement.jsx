import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import ViewOrders from './Partials/ViewOrders.jsx';
import UpdateRestaurantNameForm from './Partials/UpdateRestaurantNameForm.jsx';
import { Link, useForm, usePage } from '@inertiajs/react';

export default function Edit({ restaurant }) {
    return (
        <>        
            <Head title="Restaurant Management" />
                <div className = "pb-20">
                    <h1 className = "text-xl font-semibold leading-tight text-gray-800 pb-5"> {restaurant.name} </h1>
                    <ViewOrders               restaurant={restaurant} />
                    <UpdateRestaurantNameForm restaurant={restaurant} />
                </div>
        </>
    );
}
