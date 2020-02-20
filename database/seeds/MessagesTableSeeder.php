<?php

use App\Message;
use Illuminate\Database\Seeder;
class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 15; $i++){

            $nb_messages = 50;
            $val_min = 1;
            $val_max = 10;
            while($nb_messages != 0 )
            {
                $nombre = mt_rand($val_min, $val_max);
                if( $nombre!= $i )
                {

                    $message = new Message;
                    $message->from_id = $i;
                    $message->to_id = $nombre;
                    $message->content = $faker->realText(30);
                    $message->save();

                    $nb_messages--;
                }
            }
        }
    }
}
