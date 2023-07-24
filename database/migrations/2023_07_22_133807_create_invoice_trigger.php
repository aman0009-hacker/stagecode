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
        // Set the log_bin_trust_function_creators to allow non-SUPER users to create triggers
        DB::unprepared('SET GLOBAL log_bin_trust_function_creators = 1;');

        // Define the SQL statement for the trigger
        $triggerSQL = <<<EOT
        CREATE TRIGGER after_order_status_update
        AFTER UPDATE ON orders FOR EACH ROW
        BEGIN
            IF NEW.status = 'Dispatched' THEN
                -- Get the last invoice_id and add 1 to it to start the new invoice_id
                SET @lastInvoiceId := (
                    SELECT MAX(invoice_id) FROM invoice
                );
                SET @newInvoiceId := IFNULL(@lastInvoiceId, 100) + 1;
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
        DB::unprepared('DROP TRIGGER IF EXISTS after_order_status_update;');

        // Reset log_bin_trust_function_creators to its default value (optional)
        DB::unprepared('SET GLOBAL log_bin_trust_function_creators = 0;');
    }
};

