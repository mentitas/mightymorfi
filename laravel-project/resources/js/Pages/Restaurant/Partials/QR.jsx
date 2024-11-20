import PrimaryButton from '@/Components/PrimaryButton';
import DangerButton from '@/Components/DangerButton';
import { Transition } from '@headlessui/react';
import { router, useForm, usePage } from '@inertiajs/react';
import { useEffect, useState, useRef } from 'react';

export default function QR({content}) {

    const qrs = usePage().props.qrs
    
    return (
        <div>
            {qrs.length > 0 ? (
            <div className="order-container flex flex-wrap">
                {qrs.map((qr, index) => (
                    <div key={index} className="order-item p-4 mb-4 border rounded-lg">
                        <p> QR de la mesa {index+1}. </p>
                        <img src={qr} alt="Código QR para la mesa {index+1}" />
                    </div>
                ))}

            </div>
            ) : (
                <p>No hay QRs para mostrar. Incremente la cantidad de mesas.</p>
            )} 
          
        </div>

    );
}