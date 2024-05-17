<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('country')->nullable()->after('email');
            $table->boolean('gender')->nullable()->after('country');
            $table->date('dob')->nullable()->after('gender');
            $table->boolean('terms_and_conditions')->nullable()->after('dob');
            $table->boolean('account_status')->default(0)->after('terms_and_conditions');
            $table->boolean('is_subscribed')->default(0)->after('account_status');
            $table->boolean('sub_plan_id')->default(0)->after('is_subscribed');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('gender');
            $table->dropColumn('dob');
            $table->dropColumn('terms_and_conditions');
            $table->dropColumn('account_status');
            $table->dropColumn('is_subscribed');
            $table->dropColumn('sub_plan_id');
        });
    }
};
