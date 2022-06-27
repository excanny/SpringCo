<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AccountType;

class CreateAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('interest_rate');
            $table->boolean('is_default');
        });
       
        AccountType::insert(
            [
                [
                    'name' => 'FLEX',
                    'interest_rate' => 2.5,
                    'is_default' => true
                ],
                [
                    'name' => 'DELUXE',
                    'interest_rate' => 3.5,
                    'is_default' => false
                ],
                [
                    'name' => 'VIVA',
                    'interest_rate' => 6.0,
                    'is_default' => false
                ],
                [
                    'name' => 'PIGGY',
                    'interest_rate' => 9.2,
                    'is_default' => false
                ],
                [
                    'name' => 'SUPA',
                    'interest_rate' => 10.0,
                    'is_default' => false
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_types');
    }
}
