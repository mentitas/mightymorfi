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
                            <h2>{order}</h2>
                            <p>{order}</p>
                            <PrimaryButton>Deliver</PrimaryButton>
                        </div>
                    ))}
                </div>
            ) : (
                <p>No hay comandas para mostrar.</p>
            )}
        </section>
    );
}
