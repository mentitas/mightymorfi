import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import LoginPromptLayout from '@/Layouts/LoginPromptLayout';
import { usePage } from '@inertiajs/react';

export default function LayoutWrapper({ children }) {
    const { auth } = usePage().props;

    const Layout = auth?.user ? AuthenticatedLayout : LoginPromptLayout;

    return <Layout>{children}</Layout>;
}
