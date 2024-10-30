import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Restaurant() {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Restaurant
                </h2>
            }
        >
            <Head title="Restaurant" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            Estamos viendo la info de tu restaurant!
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
