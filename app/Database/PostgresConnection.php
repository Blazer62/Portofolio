<?php

namespace App\Database;

use Illuminate\Database\PostgresConnection as BasePostgresConnection;

class PostgresConnection extends BasePostgresConnection
{
    /**
     * Karena prepared statement diemulasikan (agar kompatibel dengan
     * connection pooler Neon/PgBouncer), nilai boolean tidak lagi dikirim
     * sebagai parameter bertipe boolean oleh PDO. Ubah menjadi literal
     * 'true'/'false' agar PostgreSQL tetap bisa membandingkan dan menyimpan
     * ke kolom bertipe boolean.
     */
    public function prepareBindings(array $bindings)
    {
        foreach ($bindings as $key => $value) {
            if (is_bool($value)) {
                $bindings[$key] = $value ? 'true' : 'false';
            }
        }

        return parent::prepareBindings($bindings);
    }
}
