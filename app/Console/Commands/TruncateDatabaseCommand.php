<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate all tables except specific ones';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
     public function handle()
    {
        // الجداول اللي مش هتتمسح
        $except = [
            'admins',
            'admin_password_resets',
            'migrations',
            'password_resets',
            'personal_access_tokens',
            'infos',
            'attributes',
            'options',
            'kurlies',
            'areas',
            'countries',
            'currencies',
            'permissions',
            'role_permission',
            'roles',
            'settings',
            'shipping_addresses',
            'statements'
        ];

        Schema::disableForeignKeyConstraints();

        foreach (DB::select('SHOW TABLES') as $table) {
            $tableName = array_values((array)$table)[0];
            if (!in_array($tableName, $except)) {
                DB::table($tableName)->truncate();
                $this->info("Truncated: {$tableName}");
            }
        }

        Schema::enableForeignKeyConstraints();

        $this->info('✅ Database truncated successfully (except allowed tables).');
        return 0;
    }
}
