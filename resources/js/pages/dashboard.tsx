    import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppNavbarLayout from '@/layouts/app-navbar-layout';
import { dashboard } from '@/routes';
import { Head } from '@inertiajs/react';
import SpreadsheetTable from '@/components/spreadsheetTable';

export default function Dashboard() {
    return (
        <AppNavbarLayout>
            <SpreadsheetTable />
        </AppNavbarLayout>
    );
}
