import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { Link, useForm, usePage } from '@inertiajs/react';
import ViewOrders from './Partials/ViewOrders.jsx';


export default function RestaurantOrders() {
    
    const restaurant = usePage().props.restaurant

    return (


        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Comandas activas
                </h2>
            }
        >
        
        <Head title="Comandas" />

        <div className="py-12">

                <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div className="p-6 text-gray-900">
                        <h1 className = "text-xl font-semibold leading-tight text-gray-800 pb-5"> {restaurant.name} </h1>
                            <ViewOrders />
                    </div>
                </div>
        </div>
        </AuthenticatedLayout>
    );
}
