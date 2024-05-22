<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookCategoryResource\Pages;
use App\Filament\Resources\BookCategoryResource\RelationManagers;
use App\Models\BookCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookCategoryResource extends Resource
{
    protected static ?string $model = BookCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel():string
    {
        return 'Categoria';
    }

    public static function form(Form $form):Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                                        ->schema([
                                            Forms\Components\TextInput::make('name')
                                                                      ->label('Nome')
                                                                      ->required(),
                                        ]),
            ])
        ;
    }

    public static function table(Table $table):Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                                         ->label('Nome')
                                         ->searchable()
                                         ->sortable(),
                Tables\Columns\TextColumn::make('books_count')
                                         ->label('Livros')
                                         ->counts('books'),
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
            ])
        ;
    }

    public static function getRelations():array
    {
        return [
            //
        ];
    }

    public static function getPages():array
    {
        return [
            'index'  => Pages\ListBookCategories::route('/'),
            'create' => Pages\CreateBookCategory::route('/create'),
            'edit'   => Pages\EditBookCategory::route('/{record}/edit'),
        ];
    }
}
