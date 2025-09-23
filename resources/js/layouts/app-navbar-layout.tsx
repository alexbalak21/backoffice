import { type ReactNode } from 'react';
import { Head } from '@inertiajs/react';
import { Navbar } from '@/components/ui/navbar';
import { dashboard } from '@/routes';

interface AppNavbarLayoutProps {
    children: ReactNode;
    breadcrumbs?: Array<{ title: string; href: string }>;
}

function getRouteUrl(route: any): string {
    if (typeof route === 'string') return route;
    if (route && typeof route === 'object' && 'url' in route) return route.url;
    return '/dashboard';
}

export default function AppNavbarLayout({ children, breadcrumbs = [] }: AppNavbarLayoutProps) {
    const dashboardUrl = getRouteUrl(dashboard());
    
    return (
        <div className="min-h-screen bg-background">
            <Head>
                <title>Dashboard - Your App</title>
                <meta name="description" content="Your application dashboard" />
            </Head>
            
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
                    // Add more menu items here
                    // Example:
                    // {
                    //     title: 'Products',
                    //     url: '/products',
                    //     items: [
                    //         { title: 'All Products', url: '/products' },
                    //         { title: 'Categories', url: '/categories' },
                    //     ]
                    // }
                ]}
                auth={{
                    login: { title: 'Log in', url: '/login' },
                    signup: { title: 'Sign up', url: '/register' }
                }}
            />
            
            <main className="container mx-auto py-6 px-4">
                {children}
            </main>
        </div>
    );
}
