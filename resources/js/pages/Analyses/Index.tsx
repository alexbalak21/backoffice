import { Head, Link } from '@inertiajs/react';
import AppNavbarLayout from '@/layouts/app-navbar-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
import { format } from 'date-fns';
import { fr } from 'date-fns/locale';

interface Analysis {
  id: number;
  numero_rapport: string;
  nom_produit: string;
  espece: string;
  date_heure_prelevement: string;
  date_heure_analyse: string;
  cotation_fraicheur: string;
}

interface Props {
  analyses: {
    data: Analysis[];
    links: any[];
  };
}

export default function Index({ analyses }: Props) {
  return (
    <AppNavbarLayout>
      <Head title="Liste des analyses" />
      
      <div className="container mx-auto py-6 space-y-6">
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-3xl font-bold tracking-tight">Analyses</h1>
            <p className="text-muted-foreground">Gérez vos analyses de fraîcheur</p>
          </div>
          <Button asChild>
            <Link href={route('analyses.create')}>Nouvelle analyse</Link>
          </Button>
        </div>

        <Card>
          <CardHeader>
            <CardTitle>Liste des analyses</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="rounded-md border
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead>N° Rapport</TableHead>
                  <TableHead>Produit</TableHead>
                  <TableHead>Espèce</TableHead>
                  <TableHead>Date prélèvement</TableHead>
                  <TableHead>Date analyse</TableHead>
                  <TableHead>Fraîcheur</TableHead>
                  <TableHead className="text-right">Actions</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {analyses.data.length === 0 ? (
                  <TableRow>
                    <TableCell colSpan={7} className="text-center py-8 text-muted-foreground">
                      Aucune analyse trouvée. Commencez par créer votre première analyse.
                    </TableCell>
                  </TableRow>
                ) : (
                  analyses.data.map((analysis) => (
                    <TableRow key={analysis.id}>
                      <TableCell className="font-medium">{analysis.numero_rapport}</TableCell>
                      <TableCell>{analysis.nom_produit}</TableCell>
                      <TableCell>{analysis.espece}</TableCell>
                      <TableCell>
                        {format(new Date(analysis.date_heure_prelevement), 'PPp', { locale: fr })}
                      </TableCell>
                      <TableCell>
                        {format(new Date(analysis.date_heure_analyse), 'PPp', { locale: fr })}
                      </TableCell>
                      <TableCell>
                        <Badge variant="outline">{analysis.cotation_fraicheur}</Badge>
                      </TableCell>
                      <TableCell className="text-right space-x-2">
                        <Button variant="outline" size="sm" asChild>
                          <Link href={route('analyses.show', analysis.id)}>Voir</Link>
                        </Button>
                        <Button variant="outline" size="sm" asChild>
                          <Link href={route('analyses.edit', analysis.id)}>Modifier</Link>
                        </Button>
                      </TableCell>
                    </TableRow>
                  ))
                )}
              </TableBody>
            </Table>
          </CardContent>
        </Card>

        {/* Pagination */}
        {analyses.links.length > 3 && (
          <div className="flex items-center justify-end space-x-2">
            {analyses.links.map((link, index) => (
              <Button
                key={index}
                variant={link.active ? 'default' : 'outline'}
                size="sm"
                disabled={!link.url}
                asChild={!!link.url}
              >
                {link.url ? (
                  <Link href={link.url} dangerouslySetInnerHTML={{ __html: link.label }} />
                ) : (
                  <span dangerouslySetInnerHTML={{ __html: link.label }} />
                )}
              </Button>
            ))}
          </div>
        )}
      </div>
    </AppNavbarLayout>
  );
}
