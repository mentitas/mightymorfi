import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import DefaultLayout from '@/Layouts/DefaultLayout';
import { usePage } from '@inertiajs/react';

export default function LayoutWrapper({ children }) {
    const { auth } = usePage().props;

    const Layout = auth?.user ? AuthenticatedLayout : DefaultLayout;

    return <Layout>{children}</Layout>;
}
