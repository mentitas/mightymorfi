import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { Link, useForm, usePage } from '@inertiajs/react';

export default function UpdateRestaurantName({
    mustVerifyEmail,
    status,
    className = '',
}) {
    const user = usePage().props.auth.user;

    // Nombres que carga por default
    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            name:    user.restaurant,
            contact: "1234",
            address: "notLibertador 1234",
            email:   user.email,
            menu:    user.restaurant?.menu || "",
            horarios: user.restaurant?.horarios || "",
            telefono: user.restaurant?.telefono || "",
            logo:    user.restaurant?.logo || "",
        });

    const submit = (e) => {
        e.preventDefault();

        patch(route('profile.update'));
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">
                    Restaurant Info
                </h2>

                <p className="mt-1 text-sm text-gray-600">
                    Update your restaurant's information.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="name" value="Name" />
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
                    <InputLabel htmlFor="menu" value="Menu URL" />
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
                    <InputLabel htmlFor="horarios" value="Horarios" />
                    <TextInput
                        id="horarios"
                        className="mt-1 block w-full"
                        value={data.horarios}
                        onChange={(e) => setData('horarios', e.target.value)}
                        required
                        autoComplete="horarios"
                    />
                    <InputError className="mt-2" message={errors.horarios} />
                </div>

                <div>
                    <InputLabel htmlFor="telefono" value="Teléfono" />
                    <TextInput
                        id="telefono"
                        className="mt-1 block w-full"
                        value={data.telefono}
                        onChange={(e) => setData('telefono', e.target.value)}
                        required
                        autoComplete="telefono"
                    />
                    <InputError className="mt-2" message={errors.telefono} />
                </div>

                <div>
                    <InputLabel htmlFor="logo" value="Logo URL" />
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
