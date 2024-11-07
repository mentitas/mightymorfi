import PrimaryButton from '@/Components/PrimaryButton';
import { Transition } from '@headlessui/react';
import { Link, useForm, usePage } from '@inertiajs/react';

export default function ViewOrders({
    mustVerifyEmail,
    status,
    className = '',
    orders = ["uno", "dos", "tres"]
}) {

    return (
        <section>
            {orders.length > 0 ? (
                <div>
                    {orders.map((order, index) => (
                        <div key={index} className="order-item p-4 mb-4 border rounded-lg">
                            <h2>Comanda en mesa {order}</h2>
                            <p>Descripción de la comanda en mesa {order}</p>
                            <PrimaryButton>Entregar</PrimaryButton>
                        </div>
                    ))}
                </div>
            ) : (
                <p>No hay comandas para mostrar.</p>
            )}
        </section>
    );
}
