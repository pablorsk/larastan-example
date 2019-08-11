<?php
/**
 * Copyright (C) 1997-2018 Reyesoft <info@reyesoft.com>.
 *
 * This file is part of LaravelJsonApi. LaravelJsonApi can not be copied and/or
 * distributed without the express permission of Reyesoft
 */

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @SuppressWarnings(PHPMD.ShortMethodName)
 */
class CreateTableBookBook extends Migration
{
    public function up(): void
    {
        Schema::create(
            'book_book', function (Blueprint $table): void {
                $table->increments('id');
                $table->integer('book_id');
                $table->integer('parent_book_id')->default(0);
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('book_book');
    }
}
