import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import UpdateRestaurantNameForm from './Partials/UpdateRestaurantNameForm.jsx';

export default function Edit({ mustVerifyEmail, status }) {
    return (
        <>        
            <Head title="Restaurant Management" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                    <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        <UpdateRestaurantNameForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            className="max-w-xl"
                        />
                    </div>
                </div>
            </div>
        </>
    );
}
