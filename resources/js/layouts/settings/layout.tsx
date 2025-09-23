import Heading from '@/components/heading';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { cn } from '@/lib/utils';
import { edit as editAppearance } from '@/routes/appearance';
import { edit as editPassword } from '@/routes/password';
import { edit } from '@/routes/profile';
import { show } from '@/routes/two-factor';
import { type NavItem } from '@/types';
import { type RouteDefinition } from '@/lib/routes';
import { Link } from '@inertiajs/react';
import { type PropsWithChildren } from 'react';
import { getRouteUrl } from '@/lib/routes';

// Helper function to convert route to string URL
const getNavItemHref = (route: any): string => {
    if (!route) return '/';
    if (typeof route === 'string') return route;
    if (typeof route === 'object' && 'url' in route) return route.url;
    if (typeof route === 'function') {
        try {
            const result = route();
            return getNavItemHref(result);
        } catch (e) {
            console.error('Error getting route URL:', e);
            return '/';
        }
    }
    return '/';
};

const sidebarNavItems: NavItem[] = [
    {
        title: 'Profile',
        href: getNavItemHref(edit()),
        icon: null,
    },
    {
        title: 'Password',
        href: getNavItemHref(editPassword()),
        icon: null,
    },
    {
        title: 'Two-Factor Auth',
        href: getNavItemHref(show()),
        icon: null,
    },
    {
        title: 'Appearance',
        href: getNavItemHref(editAppearance()),
        icon: null,
    },
];

export default function SettingsLayout({ children }: PropsWithChildren) {
    // When server-side rendering, we only render the layout on the client...
    if (typeof window === 'undefined') {
        return null;
    }

    const currentPath = window.location.pathname;

    return (
        <>
            <div className="mb-8">
                <Heading
                    title="Settings"
                    description="Manage your profile and account settings"
                />
            </div>

            <div className="flex flex-col lg:flex-row lg:space-x-12">
                <aside className="w-full max-w-xs lg:w-56">
                    <nav className="flex flex-col space-y-1">
                        {sidebarNavItems.map((item, index) => (
                            <Button
                                key={`${item.href}-${index}`}
                                size="sm"
                                variant="ghost"
                                asChild
                                className={cn('w-full justify-start', {
                                    'bg-muted': currentPath === item.href,
                                })}
                            >
                                <Link href={item.href}>
                                    {item.icon && (
                                        <item.icon className="mr-2 h-4 w-4" />
                                    )}
                                    {item.title}
                                </Link>
                            </Button>
                        ))}
                    </nav>
                </aside>

                <Separator className="my-6 lg:hidden" />

                <div className="flex-1">
                    <section className="space-y-6">
                        {children}
                    </section>
                </div>
            </div>
        </>
    );
}
