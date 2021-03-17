<?php
/** @noinspection PhpMissingFieldTypeInspection */

namespace Tochka\Promises\Commands;

use Illuminate\Console\Command;
use Tochka\Promises\Facades\GarbageCollector;

class PromiseGcc extends Command
{
    protected $signature = 'promise:gcc';

    protected $description = 'Сборщик мусора';

    public function handle(): void
    {
        GarbageCollector::handle();
    }
}
