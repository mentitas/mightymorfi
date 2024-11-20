import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import Modal from '@/Components/Modal';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, usePage, useForm} from '@inertiajs/react';
import { useEffect, useState, useRef } from 'react';
import OrderForm from './OrderForm.jsx';

export default function CreateOrderAtTable() {

    const user = usePage().props.auth.user;
    const { restaurant, table, orders } = usePage().props;

    const [isModalOpen, setIsModalOpen] = useState(false);

    const openModal = () => {
        setIsModalOpen(true);
    };

    const closeModal = () => {
        setIsModalOpen(false);
    };

    return (
    
        <>   
            <Head title="Pedidos" />
               <PrimaryButton
                  onClick={openModal}
                >
                Hacer pedido en la mesa {table} del restaurant {restaurant.name}.

                </PrimaryButton>

            <Modal show={isModalOpen} onClose={closeModal} className="p-50 flex">
                <div className="py-12">
                    <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <h2 className="text-xl font-semibold leading-tight text-gray-800">
                                Hacer pedido en la mesa {table} del restaurant {restaurant.name}.
                            </h2>
            
                            <p> Podés ver el menu en {restaurant.menu} </p>
            
                            <OrderForm />
                        </div>
                    </div>
                </div>
            </Modal>
        </>
    );
}
