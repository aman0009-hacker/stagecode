<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         // Define the SQL statement for the trigger
         $triggerSQL = <<<EOT
         CREATE TRIGGER after_order_status_update1
         AFTER INSERT ON orders FOR EACH ROW
         BEGIN
                 -- Get the last invoice_id and add 1 to it to start the new invoice_id
                 SET @newInvoiceId := IFNULL((SELECT MAX(invoice_id) FROM invoice), 99) + 1;
                 -- Provide an explicit UUID value for the 'id' column during INSERT
                 INSERT INTO invoice (id, delivery_terms, invoice_date, order_id, invoice_id, created_at, updated_at)
                 VALUES (UUID(), 'This information has been provided as a resource to familiarize PSIEC rules', NOW(), NEW.id, @newInvoiceId, NOW(), NOW());
             
         END;
         EOT;
 
         // Execute the trigger SQL statement
         DB::unprepared($triggerSQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the trigger
        DB::unprepared('DROP TRIGGER IF EXISTS after_order_status_update1');
    }
};
