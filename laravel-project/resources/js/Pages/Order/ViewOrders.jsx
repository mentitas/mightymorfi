import { Head, Link, usePage} from '@inertiajs/react';
import { useEffect, useState, useRef } from 'react';

export default function ViewOrders() {

    const user = usePage().props.auth.user;

    const [orders, setOrders] = useState([]);
    
    useEffect(() => {
        // Fetch user's orders from backend
        fetch('/api/orders/user/' + user.id)
            .then((response) => response.json())
            .then((data) => setOrders(data))
            .catch((error) => console.error('Error fetching orders:', error));

    }, []);

    return (
        <>
           <div>

            <h2> Pedidos activos </h2>
            {orders.length > 0 ? (
                <div>
                    {orders.map((order, index) => (
                        <div key={index} className="order-item p-4 mb-4 border rounded-lg">
                            <h2>Pedido en la mesa {order.table} del restaurant {order.restaurant} </h2>
                            <p>{order.content}</p>
                            <p className="mt-1 text-sm text-gray-600"> Estado: {order.status}</p>
                        </div>
                    ))}
                </div>
                ) : (
                    <p>Aún no hiciste ningún pedido.</p>
                )}
                    
            </div>
        </>
    );
}
