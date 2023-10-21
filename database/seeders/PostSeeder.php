<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            "user_id" => 1,
            "title" => "Cricket: The Gentleman's Game",
            "slug" => "cricket-the-gentlemans-game",
            "description" => "Cricket, often referred to as The Gentleman's Game, is a globally cherished sport that has captured the hearts of millions. Played in numerous formats, including Test matches, One Day Internationals (ODIs), and the high-octane Twenty20 (T20), cricket offers a thrilling mix of strategy, skill, and sportsmanship.

            With origins dating back to the 16th century in England, cricket has evolved into a spectacle that unites nations, transcending cultural and geographical boundaries. The game is characterized by a 22-yard pitch, batsmen, bowlers, fielders, and a dedicated following of fans who revel in the excitement of every boundary and wicket.",
            "published" => true,
        ]);

        Post::create([
            "user_id" => 2,
            "title" => "The Beautiful Game: Football",
            "slug" => "the-beautiful-game-football",
            "description" => "Football, known as The Beautiful Game, is a globally cherished sport that ignites passion and unites people worldwide. Played on pitches from Buenos Aires to Barcelona, it's a sport that transcends borders and languages, captivating millions with its simplicity and creativity.

            With roots tracing back to ancient civilizations, modern football features two teams, a round ball, and an unquenchable thirst for goals. The thrill of witnessing a perfectly executed pass, a dazzling dribble, or a thunderous strike is a sensation unlike any other in the world of sports.",
            "published" => true,
        ]);

        Post::create([
            "user_id" => 2,
            "title" => "The Elegant Racquet Sport: Badminton",
            "slug" => "the-elegant-racquet-sport-badminton",
            "description" => "Badminton, often regarded as the elegant racquet sport, is a game of finesse and agility that has captured the hearts of enthusiasts around the globe. Played on a rectangular court divided by a net, it demands precision, quick reflexes, and strategic play.

            With its origins rooted in ancient India, badminton has evolved into a sport known for its swift rallies and graceful shots. The shuttlecock, with its distinctive flight, adds to the charm of the game, making it a unique and thrilling sport to watch and play.",
            "published" => false,
        ]);

        Post::create([
            "user_id" => 3,
            "title" => "Spike and Serve: The World of Volleyball",
            "slug" => "spike-and-serve-the-world-of-volleyball",
            "description" => "Volleyball, a dynamic and energetic sport, is known for its fast-paced action and teamwork. Played on a rectangular court divided by a net, it's a sport that combines power, finesse, and strategy to create thrilling rallies and stunning spikes.

            With a history dating back to its invention in the United States, volleyball has become a global sensation. The game's simplicity and emphasis on team coordination make it accessible to players of all skill levels, from casual beach players to elite athletes.",
            "published" => false,
        ]);
    }
}
