<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuariosSeeders extends Seeder
{
    public const ADMINISTRADORES = [
        'admin@example.com' => 'Administrador',
    ];

    public const REGISTRADORES = [
        'registrador@example.com' => 'Ana Registradora',
    ];

    public const REVISORES = [
        'revisor@example.com' => 'Luis Revisor',
    ];

    public const APROBADORES = [
        'aprobador@example.com' => 'Marta Aprobadora',
    ];

    public const GERENCIA = [
        'gerencia@example.com' => 'Carlos Gerencia',
    ];

    public function run(): void
    {
        $this->crear(self::ADMINISTRADORES, 'Administrador');
        $this->crear(self::REGISTRADORES, 'Registrador');
        $this->crear(self::REVISORES, 'Revisor');
        $this->crear(self::APROBADORES, 'Aprobador');
        $this->crear(self::GERENCIA, 'Gerencia');
    }

    private function crear(array $usuarios, string $rol): void
    {
        foreach ($usuarios as $email => $nombre) {
            User::firstOrCreate(
                ['email' => $email],
                ['name' => $nombre, 'password' => 'password', 'email_verified_at' => now()],
            )->assignRole($rol);
        }
    }
}
