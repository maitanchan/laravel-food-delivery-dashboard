<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FoodResource\Pages;
use App\Filament\Resources\FoodResource\RelationManagers;
use App\Models\Food;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FoodResource extends Resource
{
    protected static ?string $model = Food::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationGroup = 'Management';

    protected static ?string $navigationLabel = 'Food Management';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label("Name"),

                                Forms\Components\RichEditor::make('desc')
                                    ->columnSpan('full')
                                    ->label("Description")
                            ])->columns(2),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('cat')
                                    ->label("Category"),

                                Forms\Components\TextInput::make('price')
                                    ->label("Price"),

                                Forms\Components\TextInput::make('shortTitle')
                                    ->label("Service Others"),

                                Forms\Components\RichEditor::make('shortDesc')
                                    ->columnSpan('full')
                                    ->label("Description Others")

                            ])->columns(2),
                    ]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Toggle::make('approve')
                                    ->label('Approve')
                                    ->default(false),

                            ]),

                        Forms\Components\Section::make('Image')
                            ->schema([
                                Forms\Components\FileUpload::make('cover')
                                    ->directory('form-attachments')
                                    ->preserveFilenames()
                                    ->image()
                                    ->imageEditor()
                            ])->collapsible(),

                        Forms\Components\TextInput::make('deliveryTime')
                            ->label("Discount"),




                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Food ID')->toggleable()->sortable(),
                Tables\Columns\ImageColumn::make('cover')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->label('Name')->toggleable()->limit(30),
                Tables\Columns\TextColumn::make('desc')->searchable()->sortable()->label('Description ')->toggleable()->limit(10),
                Tables\Columns\TextColumn::make('cat')->label('Category')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('price')->label('Price')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('deliveryTime')->label('Discount')->toggleable()->sortable(),
                Tables\Columns\IconColumn::make('approve')->sortable()
                    ->toggleable()
                    ->toggleable()
                    ->label('Approve')
                    ->boolean(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
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
            'index' => Pages\ListFood::route('/'),
            'create' => Pages\CreateFood::route('/create'),
            'edit' => Pages\EditFood::route('/{record}/edit'),
        ];
    }
}
