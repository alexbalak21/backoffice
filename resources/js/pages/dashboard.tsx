import AppNavbarLayout from '@/layouts/app-navbar-layout';
import SpreadsheetTable from '@/components/spreadsheetTable';

export default function Dashboard() {
    return (
        <AppNavbarLayout>
            <SpreadsheetTable />
        </AppNavbarLayout>
    );
}
