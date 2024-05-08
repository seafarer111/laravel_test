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

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Histórico de Partidas';

    protected static ?string $modelLabel = 'Histórico de Partidas';

    protected static ?string $slug = 'historico-de-partidas';

    /**
     * @return string[]
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['user.name', 'user.email', 'providers']; // TODO: Change the autogenerated stub
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('session_id')
                    ->maxLength(191),
                Forms\Components\TextInput::make('transaction_id')
                    ->maxLength(191),
                Forms\Components\TextInput::make('game')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('game_uuid')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('type_money')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('providers')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Toggle::make('refunded')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\TextInput::make('round_id')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuário')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('session_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('game')
                    ->label('Jogo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('game_uuid')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_money')
                    ->label('Pagamento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Valor')
                    ->money('BRL')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('providers')
                    ->label('Provedor')
                    ->searchable(),
                Tables\Columns\IconColumn::make('refunded')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                Tables\Columns\TextColumn::make('round_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([

            ])
            ->bulkActions([

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
            'index' => Pages\ListOrders::route('/'),
        ];
    }
}