<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Management';

    protected static ?string $navigationLabel = 'Order Management';


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
                                    ->label("Name Food")
                                    ->live(onBlur: true),

                            ])->columns(2),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label("Price"),
                                Forms\Components\TextInput::make('sellerId')
                                    ->label("Seller"),

                                Forms\Components\TextInput::make('buyerId')
                                    ->label("Buyer"),

                            ])->columns(2),
                    ]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Toggle::make('isCompleted')
                                    ->label('Status')
                                    ->default(true),


                                Forms\Components\TextInput::make('payment_intent')
                                    ->label("Payment Key"),

                            ]),

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
                Tables\Columns\TextColumn::make('id')->label('Order ID')->toggleable()->sortable(),
                Tables\Columns\ImageColumn::make('img')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->label('Name')->toggleable()->limit(10),
                Tables\Columns\TextColumn::make('price')->label('Price')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('sellerId')->label('Seller')->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('buyerId')->label('Buyer')->toggleable()->sortable(),
                Tables\Columns\IconColumn::make('isCompleted')->sortable()
                    ->toggleable()
                    ->toggleable()
                    ->label('Status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('payment_intent')->label('Payment Key')->toggleable()->sortable(),

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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
