<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create a stored procedure
        $storedProcSQL = <<<EOT
        CREATE PROCEDURE after_order_status_update_proc(IN order_id INT)
        BEGIN
            -- Get the last invoice_id and add 1 to it to start the new invoice_id
            SET @newInvoiceId := IFNULL((SELECT MAX(invoice_id) FROM invoice), 99) + 1;
            INSERT INTO invoice (delivery_terms, invoice_date, order_id, invoice_id, created_at, updated_at)
            VALUES ('This information has been provided as a resource to familiarize PSIEC rules', NOW(), order_id, @newInvoiceId, NOW(), NOW());
        END;
        EOT;

        // Execute the stored procedure SQL statement
        DB::unprepared($storedProcSQL);

        // Call the stored procedure after an order is updated to 'Dispatched'
        $triggerSQL = <<<EOT
        CREATE TRIGGER after_order_status_update
        AFTER UPDATE ON orders FOR EACH ROW
        BEGIN
            IF NEW.status = 'Dispatched' THEN
                CALL after_order_status_update_proc(NEW.id);
            END IF;
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
        DB::unprepared('DROP TRIGGER IF EXISTS after_order_status_update');

        // Drop the stored procedure
        DB::unprepared('DROP PROCEDURE IF EXISTS after_order_status_update_proc');
    }
};
