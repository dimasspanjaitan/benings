<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Settings
};
use Faker\Provider\Lorem;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::truncate();

        $setting = array( 
            [
                'id' => 1,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit iste eos, nam molestias quas ipsum? Ab iusto alias, voluptates quisquam earum quod. Itaque commodi quae voluptate inventore tenetur alias? Ab.
                Eaque ad dolore quia repellat nisi id nam, ea aliquam eius enim debitis molestias nesciunt labore beatae facere error soluta ipsam aut a animi, inventore sed explicabo doloremque ullam. Pariatur.
                Dolore, nostrum ratione iusto odit consequuntur debitis quos blanditiis corrupti placeat delectus nisi mollitia dignissimos, ipsa quia ipsam voluptatum eligendi minima nihil magnam impedit nam. Facilis veniam voluptatibus commodi sapiente?
                Aut, exercitationem nisi. Pariatur distinctio ipsum reiciendis deserunt ex voluptas sint mollitia iste necessitatibus eos accusamus error cum exercitationem aliquid, rem voluptatum modi praesentium quas officiis sequi, molestiae autem odio.
                Pariatur esse autem aperiam consequatur accusamus consectetur quam veritatis minima dolore maxime magni ut deleniti ab suscipit, nostrum animi, omnis enim ex repellendus iusto atque aspernatur, earum temporibus! Omnis, quia.
                Quibusdam iure facilis fugit suscipit assumenda eos ad deleniti voluptatum. Voluptates a ab sunt quia ut eius nulla dolorum amet repudiandae, ipsa, omnis nisi quisquam optio vitae! Ipsam, corporis nisi?
                Blanditiis provident, similique nisi incidunt, aliquid quod voluptatibus non aperiam perferendis aliquam illo, sed ipsum! Vero dolorem repellendus nostrum! Deserunt laudantium excepturi inventore error ab ipsam, totam sed delectus ea.
                Beatae excepturi ullam quia molestiae cum tempora. Fuga dolorum modi, repellat nemo molestias, odio quisquam eligendi iusto omnis totam voluptate amet! Harum illo ipsam temporibus eaque eius? Iusto, voluptatem eius.
                Natus repellendus sequi corporis cumque labore. Consectetur iste aut temporibus! Minima, architecto delectus quibusdam, nobis incidunt non ullam repellat voluptatem soluta vero quasi dolore itaque dolorum expedita, distinctio eligendi laborum!
                Rem aliquam error porro temporibus eum corrupti necessitatibus illum, nisi exercitationem eveniet hic excepturi, voluptatibus, similique nostrum! Architecto eveniet sapiente placeat nesciunt cupiditate perspiciatis dolor, debitis asperiores velit inventore beatae?',
                
                'short_des' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum a, autem natus cum minima qui. Blanditiis rerum fugit quae non! Officia architecto hic explicabo fugiat eligendi aut qui quas enim.',
                'logo' => 'backend/img/logo-benings-ms.png',
                'photo' => 'backend/img/background.jpg',
                'address' => 'Jl. Selamat No. 41 Durian, Medan Timur',
                'phone' => '081381174410',
                'email' => 'devdikey@gmail.com'
            ],
        );

        Settings::insert($setting);
    }
}
