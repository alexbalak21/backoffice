import { Head, useForm } from '@inertiajs/react';
import AppNavbarLayout from '@/layouts/app-navbar-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

export default function CreateAnalysis() {
  const { data, setData, post, processing, errors } = useForm({
    numero_rapport: '',
    lieu_prelevement: '',
    date_heure_prelevement: '',
    date_heure_reception_laboratoire: '',
    temperature_reception: '',
    conditions_conservation: '',
    date_heure_analyse: '',
    fournisseur_fabricant: '',
    conditionnement: '',
    agrement: '',
    lot: '',
    type_peche: '',
    nom_produit: '',
    espece: '',
    origine: '',
    date_emballage: '',
    date_consommation: '',
    imp: '',
    hx: '',
    note_nucleotide: '',
    cotation_fraicheur: '',
    observations: '',
    ref_rapport: '',
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    post(route('analyses.store'));
  };

  const formatDateForInput = (dateString: string) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toISOString().slice(0, 16);
  };

  return (
    <AppNavbarLayout>
      <Head title="Nouvelle Analyse" />
      
      <div className="container mx-auto py-6 space-y-6">
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-3xl font-bold tracking-tight">Nouvelle Analyse</h1>
            <p className="text-muted-foreground">Remplissez les détails de l'analyse</p>
          </div>
          <div className="flex items-center space-x-2">
            <Button variant="outline" onClick={() => window.history.back()}>Annuler</Button>
            <Button form="analysis-form" type="submit" disabled={processing}>
              {processing ? 'Enregistrement...' : 'Enregistrer'}
            </Button>
          </div>
        </div>

        <form id="analysis-form" onSubmit={handleSubmit} className="space-y-6">
          <Card>
            <CardHeader>
              <CardTitle>Informations générales</CardTitle>
              <CardDescription>Détails de base de l'analyse</CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="numero_rapport">Numéro de rapport *</Label>
                  <Input
                    id="numero_rapport"
                    value={data.numero_rapport}
                    onChange={(e) => setData('numero_rapport', e.target.value)}
                    placeholder="Entrez le numéro de rapport"
                    required
                  />
                  {errors.numero_rapport && <p className="text-sm text-red-500">{errors.numero_rapport}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="lieu_prelevement">Lieu de prélèvement *</Label>
                  <Input
                    id="lieu_prelevement"
                    value={data.lieu_prelevement}
                    onChange={(e) => setData('lieu_prelevement', e.target.value)}
                    placeholder="Entrez le lieu de prélèvement"
                    required
                  />
                  {errors.lieu_prelevement && <p className="text-sm text-red-500">{errors.lieu_prelevement}</p>}
                </div>
              </div>
              
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="date_heure_prelevement">Date et heure de prélèvement *</Label>
                  <Input
                    type="datetime-local"
                    id="date_heure_prelevement"
                    value={data.date_heure_prelevement}
                    onChange={(e) => setData('date_heure_prelevement', e.target.value)}
                    className="w-full"
                    required
                  />
                  {errors.date_heure_prelevement && <p className="text-sm text-red-500">{errors.date_heure_prelevement}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="date_heure_reception_laboratoire">Date et heure de réception *</Label>
                  <Input
                    type="datetime-local"
                    id="date_heure_reception_laboratoire"
                    value={data.date_heure_reception_laboratoire}
                    onChange={(e) => setData('date_heure_reception_laboratoire', e.target.value)}
                    className="w-full"
                    required
                  />
                  {errors.date_heure_reception_laboratoire && <p className="text-sm text-red-500">{errors.date_heure_reception_laboratoire}</p>}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="temperature_reception">Température de réception (°C) *</Label>
                  <Input
                    type="number"
                    step="0.01"
                    id="temperature_reception"
                    value={data.temperature_reception}
                    onChange={(e) => setData('temperature_reception', e.target.value)}
                    placeholder="0.00"
                    required
                  />
                  {errors.temperature_reception && <p className="text-sm text-red-500">{errors.temperature_reception}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="date_heure_analyse">Date et heure d'analyse *</Label>
                  <Input
                    type="datetime-local"
                    id="date_heure_analyse"
                    value={data.date_heure_analyse}
                    onChange={(e) => setData('date_heure_analyse', e.target.value)}
                    className="w-full"
                    required
                  />
                  {errors.date_heure_analyse && <p className="text-sm text-red-500">{errors.date_heure_analyse}</p>}
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="conditions_conservation">Conditions de conservation</Label>
                <Input
                  id="conditions_conservation"
                  value={data.conditions_conservation}
                  onChange={(e) => setData('conditions_conservation', e.target.value)}
                  placeholder="Décrivez les conditions de conservation"
                />
                {errors.conditions_conservation && <p className="text-sm text-red-500">{errors.conditions_conservation}</p>}
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
                  <Label htmlFor="nom_produit">Nom du produit *</Label>
                  <Input
                    id="nom_produit"
                    value={data.nom_produit}
                    onChange={(e) => setData('nom_produit', e.target.value)}
                    placeholder="Entrez le nom du produit"
                    required
                  />
                  {errors.nom_produit && <p className="text-sm text-red-500">{errors.nom_produit}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="espece">Espèce *</Label>
                  <Input
                    id="espece"
                    value={data.espece}
                    onChange={(e) => setData('espece', e.target.value)}
                    placeholder="Entrez l'espèce"
                    required
                  />
                  {errors.espece && <p className="text-sm text-red-500">{errors.espece}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="origine">Origine *</Label>
                  <Input
                    id="origine"
                    value={data.origine}
                    onChange={(e) => setData('origine', e.target.value)}
                    placeholder="Entrez l'origine"
                    required
                  />
                  {errors.origine && <p className="text-sm text-red-500">{errors.origine}</p>}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="fournisseur_fabricant">Fournisseur/Fabricant *</Label>
                  <Input
                    id="fournisseur_fabricant"
                    value={data.fournisseur_fabricant}
                    onChange={(e) => setData('fournisseur_fabricant', e.target.value)}
                    required
                  />
                  {errors.fournisseur_fabricant && <p className="text-sm text-red-500">{errors.fournisseur_fabricant}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="conditionnement">Conditionnement *</Label>
                  <Input
                    id="conditionnement"
                    value={data.conditionnement}
                    onChange={(e) => setData('conditionnement', e.target.value)}
                    required
                  />
                  {errors.conditionnement && <p className="text-sm text-red-500">{errors.conditionnement}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="agrement">Agrément *</Label>
                  <Input
                    id="agrement"
                    value={data.agrement}
                    onChange={(e) => setData('agrement', e.target.value)}
                    required
                  />
                  {errors.agrement && <p className="text-sm text-red-500">{errors.agrement}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="lot">Lot *</Label>
                  <Input
                    id="lot"
                    value={data.lot}
                    onChange={(e) => setData('lot', e.target.value)}
                    required
                  />
                  {errors.lot && <p className="text-sm text-red-500">{errors.lot}</p>}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="type_peche">Type de pêche *</Label>
                  <Input
                    id="type_peche"
                    value={data.type_peche}
                    onChange={(e) => setData('type_peche', e.target.value)}
                    required
                  />
                  {errors.type_peche && <p className="text-sm text-red-500">{errors.type_peche}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="date_emballage">Date d'emballage *</Label>
                  <Input
                    type="date"
                    id="date_emballage"
                    value={data.date_emballage}
                    onChange={(e) => setData('date_emballage', e.target.value)}
                    className="w-full"
                    required
                  />
                  {errors.date_emballage && <p className="text-sm text-red-500">{errors.date_emballage}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="date_consommation">Date de consommation *</Label>
                  <Input
                    type="date"
                    id="date_consommation"
                    value={data.date_consommation}
                    onChange={(e) => setData('date_consommation', e.target.value)}
                    className="w-full"
                    required
                  />
                  {errors.date_consommation && <p className="text-sm text-red-500">{errors.date_consommation}</p>}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="imp">IMP *</Label>
                  <Input
                    type="number"
                    step="0.01"
                    id="imp"
                    value={data.imp}
                    onChange={(e) => setData('imp', e.target.value)}
                    required
                  />
                  {errors.imp && <p className="text-sm text-red-500">{errors.imp}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="hx">HX *</Label>
                  <Input
                    type="number"
                    step="0.01"
                    id="hx"
                    value={data.hx}
                    onChange={(e) => setData('hx', e.target.value)}
                    required
                  />
                  {errors.hx && <p className="text-sm text-red-500">{errors.hx}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="cotation_fraicheur">Cotation fraîcheur *</Label>
                  <Input
                    id="cotation_fraicheur"
                    value={data.cotation_fraicheur}
                    onChange={(e) => setData('cotation_fraicheur', e.target.value)}
                    required
                  />
                  {errors.cotation_fraicheur && <p className="text-sm text-red-500">{errors.cotation_fraicheur}</p>}
                </div>
                <div className="space-y-2">
                  <Label htmlFor="ref_rapport">Référence rapport *</Label>
                  <Input
                    id="ref_rapport"
                    value={data.ref_rapport}
                    onChange={(e) => setData('ref_rapport', e.target.value)}
                    required
                  />
                  {errors.ref_rapport && <p className="text-sm text-red-500">{errors.ref_rapport}</p>}
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="note_nucleotide">Note nucléotide</Label>
                <Input
                  id="note_nucleotide"
                  value={data.note_nucleotide}
                  onChange={(e) => setData('note_nucleotide', e.target.value)}
                />
                {errors.note_nucleotide && <p className="text-sm text-red-500">{errors.note_nucleotide}</p>}
              </div>

              <div className="space-y-2">
                <Label htmlFor="observations">Observations</Label>
                <textarea
                  id="observations"
                  value={data.observations}
                  onChange={(e) => setData('observations', e.target.value)}
                  className="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-[80px]"
                />
                {errors.observations && <p className="text-sm text-red-500">{errors.observations}</p>}
              </div>
            </CardContent>
          </Card>
        </form>
      </div>
    </AppNavbarLayout>
  );
}
