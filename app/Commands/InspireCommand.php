<?php

namespace App\Commands;

use App\Color;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

use function Termwind\render;
use function Termwind\style;

class InspireCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'inspire {name=Artisan}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (Color::exists()) {
            $random_color = Color::inRandomOrder()->first()->hex;
            style('rc')->color($random_color);
        } else {
            style('rc')->color('#FFFFFF');
        }
        render(<<<'HTML'
            <div class="py-1 ml-2">
                <div class="px-1 bg-rc text-black">Laravel Zero</div>
                <em class="ml-1">
                  Simplicity is the ultimate sophistication.
                </em>
            </div>
        HTML);
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}