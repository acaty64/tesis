<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UserDetailsTableSeeder::class);
        $this->call(TusersTableSeeder::class);
        $this->call(TuserUserTableSeeder::class);
        $this->call(TadvisorsTableSeeder::class);
        $this->call(ThesesTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(AdvisorsTableSeeder::class);
        $this->call(TdealsTableSeeder::class);
        $this->call(DealsTableSeeder::class);
        $this->call(SequencesTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
        $this->call(TracesTableSeeder::class);
    }
}
