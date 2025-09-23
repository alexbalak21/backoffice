import { type ReactNode } from 'react';
import AppNavbarLayout from '@/layouts/app-navbar-layout';
import { type BreadcrumbItem } from '@/types';

interface SettingsNavbarLayoutProps {
    children: ReactNode;
    title?: string;
    breadcrumbs?: BreadcrumbItem[];
}

export default function SettingsNavbarLayout({ 
    children, 
    title = 'Settings',
    breadcrumbs = [] 
}: SettingsNavbarLayoutProps) {
    return (
        <AppNavbarLayout title={title} breadcrumbs={breadcrumbs}>
            <div className="space-y-6">
                <div className="space-y-6">
                    {children}
                </div>
            </div>
        </AppNavbarLayout>
    );
}
