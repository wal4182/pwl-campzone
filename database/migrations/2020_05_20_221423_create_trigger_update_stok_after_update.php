<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdateStokAfterUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_stok_after_update AFTER UPDATE ON `pesanan_detail` FOR EACH ROW
        BEGIN
            UPDATE produk SET stok = stok - new.jumlah
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
        DB::unprepared('DROP TRIGGER `update_stok_after_update`');
    }
}
