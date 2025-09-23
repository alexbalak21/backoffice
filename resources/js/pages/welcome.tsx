import { dashboard, login } from '@/routes';
import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <div className="min-h-screen flex items-center justify-center bg-gray-50">
            <Head title="Login" />
            
            {auth.user ? (
                <Link
                    href={dashboard()}
                    className="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                >
                    Go to Dashboard
                </Link>
            ) : (
                <div className="text-center">
                    <h1 className="text-2xl font-bold mb-6">Welcome to Backoffice</h1>
                    <Link
                        href={login()}
                        className="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                    >
                        Log in
                    </Link>
                </div>
            )}
        </div>
    );
}
