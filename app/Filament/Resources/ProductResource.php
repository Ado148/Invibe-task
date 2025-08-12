<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use PhpParser\Node\Stmt\Label;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Actions\CreateAction;
use Filament\Actions\CancelAction;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralLabel(): string // Returns the plural label for the resource
    {
        return 'Produkty';
    }
    public static function getNavigationLabel(): string
    {
        return 'Produkty';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Meno')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')->label('URL alias'),
                TextInput::make('product_num'),
                TextInput::make('price')->numeric()->required(),
                RichEditor::make('description')->label('Popis'),
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Obrázok')
                    ->collection('image')
                    ->image(),
                Select::make('categories')
                    ->label('Kategórie')
                    ->multiple() // Allows selecting multiple categories
                    ->relationship('categories', 'name')->required(),
                Toggle::make('active')->default(true)->label('Aktívne')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable()->label('Meno'),
                TextColumn::make('slug')->label('URL alias'),
                TextColumn::make('product_num')->sortable()->searchable()->label('Produktové č.'),
                TextColumn::make('price')->money('eur', true)->label('Cena'),
                TextColumn::make('categories.name')
                    ->label('Kategórie')
                    ->listWithLineBreaks()
                    ->limit(3),
                ToggleColumn::make('active')->label('Aktívne'),
                ImageColumn::make('image')
                    ->label('Obrázok')
                    ->getStateUsing(fn($record) => $record->getFirstMediaUrl('image')),
                TextColumn::make('created_at')->dateTime('d.m.Y H:i')->sortable()->label('Vytvorené'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(), // allows filtering by soft delted items
            ])
            ->defaultSort('id', 'desc') // default sorting by id , descending order
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // soft delete, not from the db
                Tables\Actions\RestoreAction::make(), // restore the soft deleted item
                Tables\Actions\ForceDeleteAction::make(), // complete deleteion from the db
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
