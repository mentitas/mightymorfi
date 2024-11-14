import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import ViewOrders from './Partials/ViewOrders.jsx';
import UpdateRestaurantNameForm from './Partials/UpdateRestaurantNameForm.jsx';
import { Link, useForm, usePage } from '@inertiajs/react';

export default function Edit({ restaurant }) {
    console.error(restaurant);
    return (
        <>        
            <Head title="Restaurant Management" />
                <ViewOrders               restaurant={restaurant} />
                <UpdateRestaurantNameForm restaurant={restaurant} />
        </>
    );
}
