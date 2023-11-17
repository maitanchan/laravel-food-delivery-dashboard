<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BuyerResource\Pages;
use App\Filament\Resources\BuyerResource\RelationManagers;
use App\Models\Buyer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BuyerResource extends Resource
{
    protected static ?string $model = Buyer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $navigationLabel = 'Buyer Management';


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
                                Forms\Components\TextInput::make('username')
                                    ->label("Username")

                            ])->columns(2),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->label("Email"),

                                Forms\Components\TextInput::make('country')
                                    ->label("Country"),

                                Forms\Components\TextInput::make('phone')
                                    ->label("Phone"),

                            ])->columns(2),
                    ]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\RichEditor::make('desc')
                            ->columnSpan('full')
                            ->label("Description"),

                        Forms\Components\Section::make('Image')
                            ->schema([
                                Forms\Components\FileUpload::make('img')
                                    ->directory('form-attachments')
                                    ->preserveFilenames()
                                    ->image()
                                    ->imageEditor()
                            ])->collapsible(),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Buyer ID')->toggleable()->sortable(),
                Tables\Columns\ImageColumn::make('img')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('username')->searchable()->sortable()->label('Name')->toggleable()->limit(10),
                Tables\Columns\TextColumn::make('email')->label('Email')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('country')->label('Country')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->label('Phone')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('desc')->label('Description')->toggleable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    // Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->recordUrl(null);
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
            'index' => Pages\ListBuyers::route('/'),
            'create' => Pages\CreateBuyer::route('/create'),
            'edit' => Pages\EditBuyer::route('/{record}/edit'),
        ];
    }
}
