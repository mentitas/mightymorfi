import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import LayoutWrapper from '@/Layouts/LayoutWrapper';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { Head, Link, usePage, useForm} from '@inertiajs/react';
import { useEffect, useState, useRef } from 'react';
import ViewOrders from './ViewOrders.jsx';
import CreateOrderAtTable from './CreateOrderAtTable.jsx'

export default function Order() {

    const { canOrder } = usePage().props;

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800"> Tus pedidos </h2>          
            }
        >
            <Head title="Pedidos" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            {canOrder ? ( <CreateOrderAtTable /> ) : ( <> </> )}
                            <ViewOrders />
                        </div>
                    </div>
                </div>
            </div>

        </AuthenticatedLayout>
    );
}