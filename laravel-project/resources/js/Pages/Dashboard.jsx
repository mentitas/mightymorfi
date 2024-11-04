import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Dashboard() {
    const { hasRestaurant } = usePage().props;

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <p>You're logged in!</p>

                            {/* Chequeo de si el usuario tiene un restaurante */}
                            {hasRestaurant ? (
                                <Link
                                    href="/restaurant"
                                    className="inline-block px-4 py-2 mt-4 text-white bg-blue-500 rounded hover:bg-blue-600"
                                >
                                    Editar mi restaurant
                                </Link>
                            ) : (
                                <>
                                    <p className="mt-4 text-gray-700">Parece que no tenés ningún restaurant...</p>
                                    <Link
                                        href="/restaurant/create"
                                        className="inline-block px-4 py-2 mt-2 text-white bg-green-500 rounded hover:bg-green-600"
                                    >
                                        Registrar
                                    </Link>
                                </>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
