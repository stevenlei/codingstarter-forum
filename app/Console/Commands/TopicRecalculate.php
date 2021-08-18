<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Topic;
use App\Models\Post;

class TopicRecalculate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'topic:recalculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate statistics for Topics';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Set the first post of topic to is_first = true, as is_first was added in later stage, this command is for this upgrade.
        foreach (Topic::all() as $topic)
        {
            $post = Post::where('topic_id', $topic->id)->orderBy('created_at', 'ASC')->first();
            $post->is_first = true;
            $post->save();
        }

        return 0;
    }
}
