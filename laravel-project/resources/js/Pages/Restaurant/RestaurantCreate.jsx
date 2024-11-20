import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import CreateRestaurantForm from './Partials/CreateRestaurantForm';

export default function RestarantCreate({ mustVerifyEmail, status }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Creacion Restaurantes
                </h2>
            }
        >
            <Head title="Creacion Restaurantes" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                    <CreateRestaurantForm/>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
