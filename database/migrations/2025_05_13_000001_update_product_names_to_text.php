<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE products MODIFY name_ar TEXT");
        DB::statement("ALTER TABLE products MODIFY name_en TEXT");
    }

    public function down()
    {
        DB::statement("ALTER TABLE products MODIFY name_ar VARCHAR(50)");
        DB::statement("ALTER TABLE products MODIFY name_en VARCHAR(50)");
    }
};
