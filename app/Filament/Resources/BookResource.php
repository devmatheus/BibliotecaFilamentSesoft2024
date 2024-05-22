<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function getModelLabel():string
    {
        return 'Livro';
    }

    public static function form(Form $form):Form
    {
        return $form
            ->schema(
                [
                    Forms\Components\Section::make()
                                            ->schema(
                                                [
                                                    Forms\Components\TextInput::make('title')
                                                                              ->label('Título')
                                                                              ->required(),
                                                    Forms\Components\Grid::make()
                                                                         ->columns(2)
                                                                         ->schema(
                                                                             [
                                                                                 Forms\Components\TextInput::make('author')
                                                                                                           ->label('Autor')
                                                                                                           ->required(),
                                                                                 Forms\Components\TextInput::make('isbn')
                                                                                                           ->label('ISBN')
                                                                                                           ->required(),
                                                                                 Forms\Components\TextInput::make('pages')
                                                                                                           ->label('Páginas')
                                                                                                           ->integer()
                                                                                                           ->required(),
                                                                                 Forms\Components\DatePicker::make('published_at')
                                                                                                            ->label('Publicado em')
                                                                                                            ->required(),
                                                                                 Forms\Components\Select::make('categories')
                                                                                                        ->label('Categorias')
                                                                                                        ->relationship('categories', 'name')
                                                                                                        ->multiple()
                                                                                                        ->required(),
                                                                             ]
                                                                         ),
                                                    Forms\Components\FileUpload::make('cover')
                                                                               ->label('Capa')
                                                                               ->image()
                                                                               ->required(),
                                                    Forms\Components\RichEditor::make('description')
                                                                               ->label('Descrição'),
                                                ]
                                            ),
                ]
            )
        ;
    }

    public static function table(Table $table):Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                                         ->searchable()
                                         ->sortable(),
                Tables\Columns\TextColumn::make('author')
                                         ->searchable()
                                         ->sortable(),
                Tables\Columns\TextColumn::make('isbn')
                                         ->searchable()
                                         ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                                         ->searchable()
                                         ->sortable(),
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
            'index'  => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit'   => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
