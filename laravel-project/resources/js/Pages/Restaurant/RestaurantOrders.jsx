import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import ViewOrders from './Partials/ViewOrders.jsx';
import UpdateRestaurantNameForm from './Partials/UpdateRestaurantNameForm.jsx';
import { Link, useForm, usePage } from '@inertiajs/react';

export default function RestaurantOrders() {
    const restaurant = usePage().props.restaurant
    return (
        <AuthenticatedLayout
        header={
            <h2 className="text-xl font-semibold leading-tight text-gray-800">
                Historial de Pedidos
            </h2>
        }>
            <Head title="Pedidos" />
                <div className = "pb-20">
                    <h1 className = "text-xl font-semibold leading-tight text-gray-800 pb-5"> {restaurant.name} </h1>
                    <ViewOrders restaurant={restaurant} />
                </div>
        </AuthenticatedLayout>
    );
}
