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
                            Forms\Components\TextInput::make('distrito_municipal')
                                ->label('DISTRITO MUNICIPAL')
                                ->required(),
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
                            Forms\Components\TextInput::make('matricula')
                                ->label('MATRICULA')
                                ->required(),
                            Forms\Components\TextInput::make('partida')
                                ->label('PARTIDA')
                                ->required(),
                            Forms\Components\TextInput::make('nro')
                                ->label('NRO.')
                                ->required(),
                        ]),
                    Forms\Components\Wizard\Step::make('Estado Actual del Folio Real o Partida')
                        ->schema([
                            Forms\Components\Checkbox::make('reposicion')
                                ->label('REPOSICION'),
                            Forms\Components\DatePicker::make('actualizacion')
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
                            Forms\Components\TextInput::make('distrito_judicial')
                                ->label('DISTRITO JUDICIAL DE:'),
                            Forms\Components\TextInput::make('testimonio_de')
                                ->label('TESTIMONIO DE:'),
                        ]),
                    Forms\Components\Wizard\Step::make('Estado Actual del Testimonio')
                        ->schema([
                            Forms\Components\Checkbox::make('reposicion')->label('REPOSICIÓN'),
                            Forms\Components\Checkbox::make('2do_traslado')->label('2DO TRASLADO'),
                            Forms\Components\Checkbox::make('otro')->label('OTRO'),
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
                            Forms\Components\TextInput::make('notaria_de_fe_publica')
                                ->label('NOTARIA DE FE PUBLICA'),
                            Forms\Components\TextInput::make('notaria_de_gobierno')
                                ->label('NOTARIA DE GOBIERNO'),
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
                            Forms\Components\Checkbox::make('global')->label('GLOBAL'),
                            Forms\Components\Checkbox::make('individual')->label('INDIVIDUAL'),
                        ]),
                    Forms\Components\Wizard\Step::make('Gravamen')
                        ->schema([
                            Forms\Components\Checkbox::make('si')->label('SI'),
                            Forms\Components\Checkbox::make('no')->label('NO'),
                        ]),
                    Forms\Components\Wizard\Step::make('Otras Descripciones')
                        ->schema([
                            Forms\Components\Textarea::make('otras_descripciones')
                                ->label('OTRAS DESCRIPCIONES'),
                        ]),
                ])->label('Registro de Registros'),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
