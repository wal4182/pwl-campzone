<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdateStokInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_stok_insert AFTER INSERT ON `pesanan_detail` FOR EACH ROW
        BEGIN
            UPDATE produk SET stok=stok - NEW.jumlah
            WHERE id = new.produk_id;
        END
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `update_stok_insert`');
    }
}
