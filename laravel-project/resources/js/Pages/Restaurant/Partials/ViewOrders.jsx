import PrimaryButton from '@/Components/PrimaryButton';
import { Transition } from '@headlessui/react';
import { Link, useForm, usePage } from '@inertiajs/react';

export default function ViewOrders({
    mustVerifyEmail,
    status,
    className = '',
    restaurant,
    orders = ["uno", "dos", "tres"]
}) {

    return (

        <section>
            
            <header>
                <h2 className="text-lg font-medium text-gray-900">
                    Comandas de {restaurant.name}
                </h2>

                <p className="mt-1 text-sm text-gray-600">
                    Administrá las comandas de tu restaurant.
                </p>
            </header>

            {orders.length > 0 ? (
                <div>
                    {orders.map((order, index) => (
                        <div key={index} className="order-item p-4 mb-4 border rounded-lg">
                            <h2>Comanda en mesa {order}</h2>
                            <p>Descripción de la comanda en mesa {order}</p>
                            <p className="mt-1 text-sm text-gray-600"> Cambiar estado: </p>
                            <div className="mt-1 flex justify-between w-full">
                                <div className="flex space-x-r">
                                    <PrimaryButton>Por preparar</PrimaryButton>
                                    <PrimaryButton>Preparando</PrimaryButton>
                                    <PrimaryButton>Entregado</PrimaryButton>
                                </div>
                                <PrimaryButton> Borrar comanda </PrimaryButton>
                            </div>
                        </div>
                    ))}
                </div>
            ) : (
                <p>No hay comandas para mostrar.</p>
            )}
        </section>
    );
}
