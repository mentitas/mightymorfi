import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { Head, Link, usePage, useForm} from '@inertiajs/react';
import { useEffect, useState, useRef } from 'react';

export default function OrderForm( ) {

    const user = usePage().props.auth.user;
    const { restaurant, table } = usePage().props;
    
    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        restaurant: restaurant.id,
        table: table,
        content: "...",
        status: "Por preparar",
        user_id: user.id,
    });

    const submit = (e) => {
        e.preventDefault();
        patch(route('order.store'));
    };


    return (
        <>
            <form onSubmit={submit} className="mt-6 space-y-6 pb-50">
                <div className="pb-50">
                    <InputLabel value="Tu pedido" />
                        <TextInput
                        id="content"
                        className="mt-1 block w-full"
                        value={data.content}
                        onChange={(e) => setData('content', e.target.value)}
                        required
                        isFocused
                        autoComplete="content"
                        />
                        <InputError className="mt-2" message={errors.content} />
                        <div className="flex items-center gap-4">
                            <PrimaryButton disabled={processing}>Enviar </PrimaryButton>
                        </div>
                </div>
            </form>
        </>
    );
}
