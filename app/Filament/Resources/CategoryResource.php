<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
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

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralLabel(): string
    {
        return 'Kategórie';
    }

    public static function getNavigationLabel(): string
    {
        return 'Kategórie';
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
                RichEditor::make('description')->label('Popis'),
                //FileUpload::make('image')->image(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Obrázok')
                    ->collection('image')
                    ->image(),
                Toggle::make('active')->default(true)->label(label: 'Aktívne')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->label('Meno'),
                TextColumn::make('slug')->label('URL alias'),
                ToggleColumn::make('active')
                    ->label('Aktívne')
                    ->sortable(),
                ImageColumn::make('image')->label('Obrázok')
                    ->getStateUsing(fn($record) => $record->getFirstMediaUrl('image')),
                TextColumn::make('created_at')->dateTime('d.m.Y H:i')->sortable()->timezone('Europe/Bratislava')->label('Vytvorené'),
                TextColumn::make('updated_at')->dateTime('d.m.Y H:i')->sortable()->timezone('Europe/Bratislava')->label('Upravené'),
            ])  
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->defaultSort('id', 'desc') // default sorting by id , descending order
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(), 
                Tables\Actions\ForceDeleteAction::make(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
