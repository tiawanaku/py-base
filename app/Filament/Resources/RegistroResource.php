<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistroResource\Pages;
use App\Filament\Resources\RegistroResource\RelationManagers;
use App\Models\Registro;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class RegistroResource extends Resource
{
    protected static ?string $model = Registro::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Datos Iniciales')
                        ->schema([
                            Forms\Components\Select::make('distrito_municipal')
                                ->label('DISTRITO MUNICIPAL')
                                ->required()
                                ->options([
                                    '1' => 'Distrito1',
                                    '2' => 'Distrito2',
                                    '3' => 'Distrito3',
                                    '4' => 'Distrito4',
                                    '5' => 'Distrito5',
                                    '6' => 'Distrito6',
                                    '7' => 'Distrito7',
                                    '8' => 'Distrito8',
                                    '9' => 'Distrito9',
                                    '10' => 'Distrito10',
                                    '11' => 'Distrito11',
                                    '12' => 'Distrito12',
                                    '13' => 'Distrito13',
                                    '14' => 'Distrito14',
                                ]),
                            Forms\Components\TextInput::make('ubicacion_denominacion_anterior')
                                ->label('UBICACIÓN DENOMINACIÓN ANTERIOR')
                                ->required(),
                            Forms\Components\TextInput::make('actual_denominacion')
                                ->label('ACTUAL DENOMINACIÓN')
                                ->required(),
                            Forms\Components\TextInput::make('codigo_catastral')
                                ->label('CÓDIGO CATASTRAL')
                                ->required(),
                        ]),
                    Forms\Components\Wizard\Step::make('Folio Real')
                        ->schema([
                            Forms\Components\Radio::make('tipo')
                                ->label('Seleccione un tipo')
                                ->options([
                                    'matricula' => 'MATRICULA',
                                    'partida' => 'PARTIDA',
                                ])
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    // Establecer valores de matricula y partida según la selección
                                    $set('matricula', $state === 'matricula' ? 1 : 0);
                                    $set('partida', $state === 'partida' ? 1 : 0);
                                }),
                            Forms\Components\Hidden::make('matricula')->default(0),
                            Forms\Components\Hidden::make('partida')->default(0),
                            Forms\Components\TextInput::make('nro')
                                ->label('NRO.')
                                ->required(),
                        ]),

                        Forms\Components\Wizard\Step::make('Estado Actual del Folio Real o Partida')
                        ->schema([
                            Forms\Components\Checkbox::make('reposicion')
                                ->label('REPOSICION'),
                            Forms\Components\Checkbox::make('actualizacion')
                                ->label('ACTUALIZACIÓN'),
                            Forms\Components\Checkbox::make('cambio_a_matricula')
                                ->label('CAMBIO A MATRICULA'),
                            Forms\Components\Checkbox::make('cambio_de_razon_social')
                                ->label('CAMBIO DE RAZON SOCIAL'),
                            Forms\Components\Checkbox::make('cambio_de_jurisdiccion')
                                ->label('CAMBIO DE JURISDICCION'),
                            Forms\Components\Checkbox::make('solicitud_de_transferencia')
                                ->label('SOLICITUD DE TRANSFERENCIA'),
                        ]),

                    Forms\Components\Wizard\Step::make('Escritura Publica')
                        ->schema([
                            Forms\Components\TextInput::make('nro_testimonio')
                                ->label('Nº TESTIMONIO'),
                            Forms\Components\TextInput::make('nro_notaria')
                                ->label('Nº NOTARIA'),
                            Forms\Components\TextInput::make('notario')
                                ->label('NOTARIO'),
                            Forms\Components\Select::make('distrito_judicial')
                                ->label('DISTRITO JUDICIAL DE:')
                                ->options([
                                    'la_paz' => 'La Paz - Bolivia',
                                    'el_alto' => 'El Alto - Bolivia',
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('testimonio_de')
                                ->label('TESTIMONIO DE:'),
                        ]),

                    Forms\Components\Wizard\Step::make('Estado Actual del Testimonio')
                        ->schema([
                            Forms\Components\Checkbox::make('reposicion')->label('REPOSICIÓN'),
                            Forms\Components\Checkbox::make('2do_traslado')->label('2DO TRASLADO'),
                            Forms\Components\TextInput::make('otro')->label('OTRO'),
                        ]),

                    Forms\Components\Wizard\Step::make('Superficie Total y Superficie Restante')
                        ->schema([
                            Forms\Components\TextInput::make('superficie_total')
                                ->label('SUPERFICIE TOTAL'),
                            Forms\Components\TextInput::make('superficie_restante')
                                ->label('SUPERFICIE RESTANTE'),
                        ]),

                    Forms\Components\Wizard\Step::make('Registro Notarial')
                        ->schema([
                            Forms\Components\Radio::make('registro_notarial')
                                ->label('Selecciona el tipo de Notaría')
                                ->options([
                                    'notaria_de_fe_publica' => 'NOTARÍA DE FE PÚBLICA',
                                    'notaria_de_gobierno' => 'NOTARÍA DE GOBIERNO',
                                ])
                                ->required(),
                        ]),

                    Forms\Components\Wizard\Step::make('Registrado por:')
                        ->schema([
                            Forms\Components\TextInput::make('ley_municipal')->label('LEY MUNICIPAL'),
                            Forms\Components\Checkbox::make('adjudicacion')->label('ADJUDICACION'),
                            Forms\Components\Checkbox::make('expropiacion')->label('EXPROPIACION'),
                            Forms\Components\Checkbox::make('cesion_de_areas')->label('CESION DE AREAS'),
                        ]),
                    Forms\Components\Wizard\Step::make('Denominacion')
                        ->schema([
                            Forms\Components\Checkbox::make('equipamiento')->label('EQUIPAMIENTO'),
                            Forms\Components\Checkbox::make('area_verde')->label('AREA VERDE'),
                            Forms\Components\Checkbox::make('vias')->label('VIAS'),
                        ]),
                    Forms\Components\Wizard\Step::make('Registro')
                        ->schema([
                            Forms\Components\Radio::make('tipo_registro')
                                ->label('Selecciona el tipo de registro')
                                ->options([
                                    'global' => 'GLOBAL',
                                    'individual' => 'INDIVIDUAL',
                                ])
                                ->required(),
                        ]),

                        Forms\Components\Wizard\Step::make('Gravamen')
                        ->schema([
                            Forms\Components\Radio::make('gravamen')
                                ->label('¿Gravamen?')
                                ->options([
                                    'si' => 'SI',
                                    'no' => 'NO',
                                ])
                                ->required(),
                        ]),

                    Forms\Components\Wizard\Step::make('Otras Descripciones')
                        ->schema([
                            Forms\Components\Textarea::make('otras_descripciones')
                                ->label('OTRAS DESCRIPCIONES'),
                        ]),

                    // Paso adicional: Área en Mapa
                    Forms\Components\Wizard\Step::make('Área en Mapa')
                    ->schema([
                        \Dotswan\MapPicker\Fields\Map::make('location')
                            ->label('Ubicación')
                            ->columnSpanFull()
                            ->defaultLocation(latitude: 40.4168, longitude: -3.7038) // Ubicación por defecto
                            ->afterStateUpdated(function (callable $set, ?array $state): void {
                                $set('latitude', $state['lat']);
                                $set('longitude', $state['lng']);
                                // Aseguramos que el GeoJSON de las figuras se guarda correctamente.
                                $set('geojson', json_encode($state['geojson'] ?? [])); // Si no hay GeoJSON, guarda un array vacío
                            })
                            ->afterStateHydrated(function ($state, $record, $set) {
                                if ($record) {
                                    // Si el registro tiene coordenadas y GeoJSON, se pasa correctamente
                                    $set('location', [
                                        'lat' => $record->latitude ?? null,
                                        'lng' => $record->longitude ?? null,
                                        // Asegúrate de que no hay HTML ni etiquetas en la descripción.
                                        'geojson' => json_decode(strip_tags($record->description) ?? '[]')
                                    ]);
                                } else {
                                    // Si no hay registro, configuramos valores predeterminados.
                                    $set('location', [
                                        'lat' => null,
                                        'lng' => null,
                                        'geojson' => null
                                    ]);
                                }
                            })
                            ->liveLocation(true, true, 5000)
                            ->showMarker()
                            ->draggable()
                            ->tilesUrl("https://tile.openstreetmap.de/{z}/{x}/{y}.png")
                            ->zoom(15)
                            ->detectRetina()
                            ->showMyLocationButton()
                            ->geoMan(true)
                            ->geoManEditable(true)
                            ->geoManPosition('topleft')
                            ->drawPolygon() // Habilita el dibujo de polígonos
                            ->drawCircle()
                            ->editPolygon()
                            ->deleteLayer()
                            ->setColor('#3388ff')
                            ->setFilledColor('#cad9ec')
                    ]),
                ])->columnSpanFull()
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Columnas de la segunda definición
                Tables\Columns\TextColumn::make('distrito_municipal')
                    ->label('Distrito Municipal')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ubicacion_denominacion_anterior')
                    ->label('Ubicación Denominación Anterior')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('actual_denominacion')
                    ->label('Actual Denominación')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('codigo_catastral')
                    ->label('Código Catastral')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo de Folio Real')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nro')
                    ->label('Número del Folio Real')
                    ->sortable(),
                Tables\Columns\TextColumn::make('otras_descripciones')
                    ->label('Otras Descripciones')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->label('Latitud')
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->label('Longitud')
                    ->sortable(),

                // Columnas de la primera definición
                Tables\Columns\TextColumn::make('geojson')
                    ->label('Área en Mapa')
                    ->formatStateUsing(function ($state) {
                        if ($state) {
                            $geojson = json_decode($state, true);
                            return '<a href="#" onclick="openMapModal(' . json_encode($geojson) . ')">Ver Polígono</a>';
                        }
                        return 'No disponible';
                    })
                    ->html(), // Esto permite que el HTML sea interpretado y renderizado correctamente
            ])
            ->filters([
                // Filtros si es necesario...
            ])
            ->actions([
                Action::make('ver_mapa')
                    ->label('Ver Mapa')
                    ->icon('heroicon-o-map')
                    ->color('primary')
                    ->modalHeading('Ver Mapa')
                    ->modalContent(function ($record) {
                        $geojson = json_decode($record->geojson, true);
                        return view('modal-mapa', compact('geojson'));
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistros::route('/'),
            'create' => Pages\CreateRegistro::route('/create'),
            'edit' => Pages\EditRegistro::route('/{record}/edit'),
        ];
    }
}
