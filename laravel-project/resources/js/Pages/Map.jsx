import SimpleMap from '@/Components/Map.jsx';
import DefaultLayout from '@/Layouts/DefaultLayout';
import { Head } from '@inertiajs/react';

export default function map() {
    return (
        <DefaultLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Restaurant Finder
                </h2>
                
            }
        >
            <Head title="Restaurant map" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            Navigate the following map to explore all restaurants.
                            <SimpleMap />
                        </div>
                    </div>
                </div>
            </div>
        </DefaultLayout>
    );
}
