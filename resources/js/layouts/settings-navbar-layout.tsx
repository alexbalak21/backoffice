import { Navbar } from '@/components/ui/navbar';
import { edit as editAppearance } from '@/routes/appearance';
import { dashboard } from '@/routes';
import { edit as editPassword } from '@/routes/password';
import { edit } from '@/routes/profile';
import { show } from '@/routes/two-factor';
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

interface SettingsNavbarLayoutProps {
    children: ReactNode;
}

export default function SettingsNavbarLayout({ children }: SettingsNavbarLayoutProps) {
    const pageProps = usePage().props as any;
    const auth = pageProps.auth || {};
    
    // Get all route URLs
    const dashboardUrl = getRouteUrl(dashboard);
    const profileUrl = getRouteUrl(edit);
    const passwordUrl = getRouteUrl(editPassword);
    const twoFactorUrl = getRouteUrl(show);
    const appearanceUrl = getRouteUrl(editAppearance);

    return (
        <div className="min-h-screen bg-background">
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
                        url: profileUrl,
                        items: [
                            { title: 'Profile', url: profileUrl },
                            { title: 'Password', url: passwordUrl },
                            { title: 'Two-Factor Auth', url: twoFactorUrl },
                            { title: 'Appearance', url: appearanceUrl },
                        ]
                    }
                ]}
                auth={{
                    login: { title: 'Log in', url: '/login' },
                    signup: { title: 'Sign up', url: '/register' }
                }}
            />

            <div className="container px-4 py-6">
                <div className="flex flex-col lg:flex-row lg:space-x-12">
                    {children}
                </div>
            </div>
        </div>
    );
}
