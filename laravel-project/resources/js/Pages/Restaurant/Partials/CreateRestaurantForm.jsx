import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { Link, useForm, router } from '@inertiajs/react';

export default function CreateRestaurantForm() {

    const { data, setData, errors, processing, recentlySuccessful } =
        useForm({
            name:      "",
            contact:   "",
            address:   "",
            latitude:  "",
            longitude: "",
            tables:    "",
            menu:      "",
            timetable: "",
            logo:      ""
        });

    const submit = (e) => {
        e.preventDefault();
        router.visit('/restaurant', {
            method:'post',data:{data},
            onSuccess:{},
            onError:{}
            }
        );
    };

    return (
        <section className="max-w-xl pb-30">
            <header>
                <h2 className="text-lg font-medium text-gray-900">
                    Creacion de restaurant
                </h2>

                <p className="mt-1 text-sm text-gray-600">
                    Ingresa la información de tu restaurant.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel value="Nombre" />
                    <TextInput
                        id="name"
                        className="mt-1 block w-full"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                        isFocused
                        autoComplete="name"
                    />
                    <InputError className="mt-2" message={errors.name} />
                </div>

                <div>
                    <InputLabel value="Teléfono" />
                    <TextInput
                        id="telefono"
                        className="mt-1 block w-full"
                        value={data.contact}
                        onChange={(e) => setData('contact', e.target.value)}
                        required
                        autoComplete="telefono"
                    />
                    <InputError className="mt-2" message={errors.telefono} />
                </div>

                <div>
                    <InputLabel value="Dirección" />
                    <TextInput
                        id="Dirección"
                        className="mt-1 block w-full"
                        value={data.address}
                        onChange={(e) => setData('address', e.target.value)}
                        required
                        autoComplete="dirección"
                    />
                    <InputError className="mt-2" message={errors.telefono} />
                </div>
                <div>
                    <InputLabel value="Latitud" />
                    <TextInput
                        id="latitude"
                        className="mt-1 block w-full"
                        value={data.latitude}
                        onChange={(e) => setData('latitude', e.target.value)}
                        required
                        autoComplete="latitud"
                    />
                    <InputError className="mt-2" message={errors.latitude} />
                </div>
                <div>
                    <InputLabel value="Longitud" />
                    <TextInput
                        id="longitude"
                        className="mt-1 block w-full"
                        value={data.longitude}
                        onChange={(e) => setData('longitude', e.target.value)}
                        required
                        autoComplete="longitud"
                    />
                    <InputError className="mt-2" message={errors.longitude} />
                </div>
                <div>
                    <InputLabel value="Horarios" />
                    <TextInput
                        id="horarios"
                        className="mt-1 block w-full"
                        value={data.timetable}
                        onChange={(e) => setData('timetable', e.target.value)}
                        required
                        autoComplete="horarios"
                    />
                    <InputError className="mt-2" message={errors.horarios} />
                </div>

                <div>
                    <InputLabel value="Cantidad de mesas" />
                    <TextInput
                        id="tables"
                        className="mt-1 block w-full"
                        value={data.tables}
                        onChange={(e) => setData('tables', e.target.value)}
                        required
                        autoComplete="tables"
                    />
                    <InputError className="mt-2" message={errors.menu} />
                </div>
                
                <div>
                    <InputLabel value="Menu URL" />
                    <TextInput
                        id="menu"
                        className="mt-1 block w-full"
                        value={data.menu}
                        onChange={(e) => setData('menu', e.target.value)}
                        required
                        autoComplete="menu"
                    />
                    <InputError className="mt-2" message={errors.menu} />
                </div>

                <div>
                    <InputLabel value="Logo URL" />
                    <TextInput
                        id="logo"
                        className="mt-1 block w-full"
                        value={data.logo}
                        onChange={(e) => setData('logo', e.target.value)}
                        required
                        autoComplete="logo"
                    />
                    <InputError className="mt-2" message={errors.logo} />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>

                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600">
                            Saved.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}