<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/populate',function(){
    $faker = Faker\Factory::create();

    $badge = new \App\Badge;
    $badge->name = 'bh45UyX8N89xNIBjAAwZjUICvm9oiPJUnrCWjZ-4ZZk';
    $badge->save();

    $badge = new \App\Badge;
    $badge->name = 'xenMwLvwXNN2DDqXO_LzyPYZIvI0Vhzf11qP_2yutl0';
    $badge->save();

    $location = new \App\Location;
    $location->supercell_id = 32000248;
    $location->code = 'gb';
    $location->name = 'United Kingdom';
    $location->save();

	$clan = new \App\Clan;
	$clan->state = 0;
	$clan->tag = 'A123';//$faker->randomAscii(8);
	$clan->name = $faker->words(3, true);
	$clan ->save();

	$clan2 = new \App\Clan;
	$clan2->state = 0;
	$clan2->tag = 'B123';//$faker->randomAscii(8);
	$clan2->name = $faker->words(3, true);
	$clan2 ->save();

    $cs1 = new \App\ClanSnapshot;
    $cs1->clan_id = mt_rand( 1, 2 );
    $cs1->badge_id = $badge->id;
    $cs1->location_id = $location->id;
    //$cs1->war_frequency = 'A';
    $cs1->state = 'I';
    $cs1->war_wins = 146;
    $cs1->war_wins_streak = 0;
    $cs1->points = 30000;
    $cs1->description = $faker->words(10, true);
    $cs1->created_at = date( 'Y-m-d H:i:s', time() - 86400 );
    $cs1->updated_at = date( 'Y-m-d H:i:s', time() - 86400 );
    $clan->snapshots()->save($cs1);

    $lsc = new \App\LocationSnapshotClan;
	$lsc->clan_id = mt_rand( 1, 2 );
    $lsc->location_id = 1;
    $lsc->rank = 2;
    $lsc->previous_rank = 3;
	$lsc->created_at = date( 'Y-m-d H:i:s', time() - 86400 );
	$lsc->updated_at = date( 'Y-m-d H:i:s', time() - 86400 );
    $lsc->save();

    $cs2 = new \App\ClanSnapshot;
	$cs2->clan_id = mt_rand( 1, 2 );
    $cs2->badge_id = $badge->id;
    $cs2->location_id = $location->id;
    //$cs2->war_frequency = 'A';
    $cs2->state = 'C';
    $cs2->war_wins = 147;
    $cs2->war_wins_streak = 1;
    $cs2->points = 40000;
    $cs2->description = $faker->words(10, true);
    $clan->snapshots()->save($cs2);

    $lsc = new \App\LocationSnapshotClan;
	$lsc->clan_id = mt_rand( 1, 2 );
    $lsc->location_id = 1;
    $lsc->rank = 4;
    $lsc->previous_rank = 5;
    $lsc->save();

    $j = 1;
    for( $i = 0; $i <= 40; $i++ ) {
        $player = new \App\Player;
        //$player->clan_id = $clan->id;
        $player->tag = strtoupper($faker->shuffle($faker->randomNumber(3) . substr($faker->word(), 0, 6)));
        $player->name = ucfirst($faker->words(mt_rand(1, 2), true));
        $player->save();

        $trophies = mt_rand(0,6200);

        $cm = new \App\ClanMember;
        $cm->player_id = $player->id;
        $cm->in_league = mt_rand(0,1);
        $cm->exp_level = mt_rand(10,140);
        $cm->trophies = $trophies;
        $cm->donations = mt_rand(0,15000);
        $cm->donations_received = mt_rand(0,15000);
        $cs1->members()->save($cm);

        if( $trophies >= 5000 ) {
            $lsp = new \App\LocationSnapshotPlayer;
            $lsp->player_id = $player->id;
            $lsp->location_id = 1;
            $lsp->rank = $j;
            $lsp->trophies = $trophies;
            $lsp->previous_rank = 11;
            $lsp->created_at = date( 'Y-m-d H:i:s', time() - 86400 );
            $lsp->updated_at = date( 'Y-m-d H:i:s', time() - 86400 );
            $lsp->save();
            $j++;
        }

        $trophies = mt_rand(0,6200);

        $cm = new \App\ClanMember;
        $cm->player_id = $player->id;
        $cm->in_league = mt_rand(0,1);
        $cm->exp_level = mt_rand(10,140);
        $cm->trophies = $trophies;
        $cm->donations = mt_rand(0,15000);
        $cm->donations_received = mt_rand(0,15000);
        $cs2->members()->save($cm);

        if( $trophies >= 5000 ) {
            $lsp = new \App\LocationSnapshotPlayer;
            $lsp->player_id = $player->id;
            $lsp->location_id = 1;
            $lsp->rank = 10;
            $lsp->trophies = $trophies;
            $lsp->previous_rank = 11;
            $lsp->save();
        }
    }

    die('done');
});

Route::get('{any?}', function() {
    return view('welcome');
})->where('any', '.*');