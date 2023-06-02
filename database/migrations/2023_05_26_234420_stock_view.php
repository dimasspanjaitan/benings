<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement(
            " CREATE VIEW stock_views AS
            SELECT p.id,p.name, (
                (SELECT SUM(purchase_details.qty) FROM purchase_details WHERE purchase_details.product_id = pd.product_id) -  COALESCE((SELECT SUM(sale_details.qty) FROM sale_details WHERE sale_details.product_id = pd.product_id), 0) as stock 
                FROM products as p
                INNER JOIN purchase_details as pd on pd.product_id = p.id
            "
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW stock_views");
    }
}