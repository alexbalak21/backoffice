import AppNavbarLayout from '@/layouts/app-navbar-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

export default function Analysis() {
  return (
    <AppNavbarLayout>
      <div className="container mx-auto py-6 space-y-6">
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-3xl font-bold tracking-tight">Nouvelle Analyse</h1>
            <p className="text-muted-foreground">Remplissez les détails de l'analyse</p>
          </div>
          <div className="flex items-center space-x-2">
            <Button variant="outline">Annuler</Button>
            <Button>Enregistrer</Button>
          </div>
        </div>

        <div className="grid gap-6">
          <Card>
            <CardHeader>
              <CardTitle>Informations générales</CardTitle>
              <CardDescription>Détails de base de l'analyse</CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="numero_rapport">Numéro de rapport</Label>
                  <Input id="numero_rapport" name="numero_rapport" placeholder="Entrez le numéro de rapport" />
                </div>
                <div className="space-y-2">
                  <Label htmlFor="lieu_prelevement">Lieu de prélèvement</Label>
                  <Input id="lieu_prelevement" name="lieu_prelevement" placeholder="Entrez le lieu de prélèvement" />
                </div>
              </div>
              
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="date_heure_prelevement">Date et heure de prélèvement</Label>
                  <Input 
                    type="datetime-local" 
                    id="date_heure_prelevement" 
                    name="date_heure_prelevement"
                    className="w-full"
                  />
                </div>
                <div className="space-y-2">
                  <Label htmlFor="date_heure_reception">Date et heure de réception</Label>
                  <Input 
                    type="datetime-local" 
                    id="date_heure_reception" 
                    name="date_heure_reception"
                    className="w-full"
                  />
                </div>
              </div>
            </CardContent>
          </Card>

          <Card>
            <CardHeader>
              <CardTitle>Détails du produit</CardTitle>
              <CardDescription>Informations sur le produit analysé</CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="nom_produit">Nom du produit</Label>
                  <Input id="nom_produit" name="nom_produit" placeholder="Entrez le nom du produit" />
                </div>
                <div className="space-y-2">
                  <Label htmlFor="espece">Espèce</Label>
                  <Input id="espece" name="espece" placeholder="Entrez l'espèce" />
                </div>
                <div className="space-y-2">
                  <Label htmlFor="origine">Origine</Label>
                  <Input id="origine" name="origine" placeholder="Entrez l'origine" />
                </div>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </AppNavbarLayout>
  );
}
