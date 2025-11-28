<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Resources\Resource;
use BackedEnum;
use Filament\Tables;
use Filament\Forms;
use Filament\Schemas\Schema;
class UserResource extends Resource
{
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required(),
            Forms\Components\Select::make('role')
                ->label('Rôle')
                ->options(function () {
                    $user = auth()->user();
                    $options = [];
                    if ($user?->role === \App\Models\User::ROLE_SUPERADMIN) {
                        $options = [
                            \App\Models\User::ROLE_SUPERADMIN => 'Super Admin',
                            \App\Models\User::ROLE_ADMIN => 'Admin',
                            \App\Models\User::ROLE_REDACELEC => 'Relecteur',
                            \App\Models\User::ROLE_STUDENT => 'Utilisateur',
                        ];
                    } elseif ($user?->role === \App\Models\User::ROLE_ADMIN) {
                        $options = [
                            \App\Models\User::ROLE_REDACELEC => 'Relecteur',
                            \App\Models\User::ROLE_STUDENT => 'Utilisateur',
                        ];
                    } else {
                        $options = [
                            \App\Models\User::ROLE_STUDENT => 'Utilisateur',
                        ];
                    }
                    return $options;
                })
                ->required(),
        ]);
    }
    protected static ?string $model = User::class;
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Utilisateurs';
    protected static ?int $navigationSort = 2; // 1 pour Questions, 2 pour Utilisateurs


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rôle')
                    ->formatStateUsing(function ($state) {
                        return match($state) {
                            \App\Models\User::ROLE_SUPERADMIN => 'Super Admin',
                            \App\Models\User::ROLE_ADMIN => 'Admin',
                            \App\Models\User::ROLE_REDACELEC => 'Relecteur',
                            \App\Models\User::ROLE_STUDENT => 'Utilisateur',
                            default => 'Inconnu',
                        };
                    }),
            ])
            ->filters([
                // Ajoutez des filtres si besoin
            ]);
    }
    
        public static function getPages(): array
        {
            return [
                'index' => \App\Filament\Resources\UserResource\Pages\ListUsers::route('/'),
                'create' => \App\Filament\Resources\UserResource\Pages\CreateUser::route('/create'),
                'edit' => \App\Filament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
            ];
        }
}
