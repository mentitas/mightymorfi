import PrimaryButton from '@/Components/PrimaryButton';
import DangerButton from '@/Components/DangerButton';
import { Transition } from '@headlessui/react';
import { Link, useForm, usePage } from '@inertiajs/react';
import { useEffect, useState, useRef } from 'react';


export default function ViewOrders({
    restaurant
}) {

    const [orders, setOrders] = useState([]);

    const porPrepararColor = "blue";

    const { data, setData, patch } = useForm();

    const fetchOrders = () => {
      fetch('/api/orders/' + restaurant.id)
        .then((response) => response.json())
        .then((data) => setOrders(data))
        .catch((error) => console.error('Error fetching orders:', error));
    };

    const changeOrderStatus = (orderId, status) => {
        patch(route('order.updateStatus', { id: orderId, status: status}), {

            onSuccess: ()    => { fetchOrders(); },
            onError: (error) => { console.error('Error updating order status: ', error); }
        });
    };


    const deleteOrder = (orderId) => {
        patch(route('order.delete', { id: orderId}), {
            onSuccess: ()    => { fetchOrders(); },
            onError: (error) => { console.error('Error deleting order: ', error); }
        });
    };

    // Fetch restaurant orders from the backend
    useEffect(() => {
        fetchOrders();
    }, []);


    return (

        <div className = "pb-10">
            
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
                        <h2>Comanda en mesa {order.table}</h2>
                        <p>{order.content}</p>
                        <p className="mt-1 text-sm text-gray-600"> Cambiar estado: {order.status}</p>
                        <div className="mt-1 flex justify-between w-full">
                            <div className="flex space-x-r">
                                <PrimaryButton 
                                    bgColor={order.status == "Por preparar" ? "#1b9e4b" : ""}
                                    onClick={() => changeOrderStatus(order.id, "Por preparar")}>
                                    Por preparar
                                </PrimaryButton>
                                <PrimaryButton
                                    bgColor={order.status == "Preparando" ? "#1b9e4b" : ""}
                                    onClick={() => changeOrderStatus(order.id, "Preparando")}>
                                    Preparando
                                </PrimaryButton>
                                <PrimaryButton
                                    bgColor={order.status == "Entregado" ? "#1b9e4b" : ""}
                                    onClick={() => changeOrderStatus(order.id, "Entregado")}>
                                    Entregado
                                </PrimaryButton>
                            </div>
                            <DangerButton onClick={() => deleteOrder(order.id)}>
                                Borrar comanda
                            </DangerButton>
                        </div>
                    </div>

                ))}
            </div>
            ) : (
                <p>No hay comandas para mostrar.</p>
            )}

           
        </div>
    );
}
