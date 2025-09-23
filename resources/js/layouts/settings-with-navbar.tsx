import { Navbar } from '@/components/ui/navbar';
import { dashboard } from '@/routes';
import { usePage } from '@inertiajs/react';
import { type ReactNode } from 'react';

// Helper function to safely get URL from route
function getRouteUrl(route: any): string {
    if (!route) return '/dashboard';
    if (typeof route === 'string') return route;
    if (typeof route === 'object' && 'url' in route) return route.url;
    if (typeof route === 'function') {
        try {
            const result = route();
            return getRouteUrl(result);
        } catch (e) {
            console.error('Error getting route URL:', e);
            return '/dashboard';
        }
    }
    return '/dashboard';
}

interface SettingsWithNavbarProps {
    children: ReactNode;
    breadcrumbs?: Array<{
        title: string;
        href: string;
    }>;
}

export default function SettingsWithNavbar({ children, breadcrumbs = [] }: SettingsWithNavbarProps) {
    const pageProps = usePage().props as any;
    const auth = pageProps.auth || {};
    
    // Get dashboard URL
    const dashboardUrl = getRouteUrl(dashboard);

    return (
        <div className="min-h-screen bg-background">
            {/* Navbar */}
            <Navbar 
                logo={{
                    url: dashboardUrl,
                    src: "/logo.svg",
                    alt: "Logo",
                    title: "Backoffice"
                }}
                menu={[
                    { 
                        title: 'Dashboard', 
                        url: dashboardUrl 
                    },
                    {
                        title: 'Settings',
                        url: '/settings/profile',
                        items: [
                            { title: 'Profile', url: '/settings/profile' },
                            { title: 'Password', url: '/settings/password' },
                            { title: 'Two-Factor Auth', url: '/settings/two-factor' },
                            { title: 'Appearance', url: '/settings/appearance' },
                        ]
                    }
                ]}
                auth={{
                    login: { title: 'Log in', url: '/login' },
                    signup: { title: 'Sign up', url: '/register' },
                    ...(auth.user ? { user: auth.user } : {})
                }}
            />

            {/* Main content with sidebar */}
            <div className="container px-4 py-6">
                {children}
            </div>
        </div>
    );
}
