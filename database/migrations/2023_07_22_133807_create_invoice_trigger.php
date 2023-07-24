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
            // Define the SQL statement for the trigger
            $triggerSQL = <<<EOT
            CREATE TRIGGER after_order_status_update
            AFTER UPDATE ON orders FOR EACH ROW
            BEGIN
                IF NEW.status = 'Dispatched' THEN
                    -- Get the last invoice_id and add 1 to it to start the new invoice_id
                    DECLARE lastInvoiceId INT DEFAULT 0;
                    SELECT MAX(invoice_id) INTO lastInvoiceId FROM invoice;
                    SET @newInvoiceId = IFNULL(lastInvoiceId, 100) + 1;
                    INSERT INTO invoice (delivery_terms, invoice_date, order_id, invoice_id, created_at, updated_at)
                    VALUES ('This information has been provided as a resource to familiarize PSIEC rules', NOW(), NEW.id, @newInvoiceId, NOW(), NOW());
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
    }
};
