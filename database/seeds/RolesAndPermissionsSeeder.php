<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
 	
	public function run()
	{	
		
	DB::table('roles')->delete();
        DB::table('permissions')->delete();

        $guest = new Role();
        $guest->name = 'guest';
        $guest->display_name = 'Покупатель';
        $guest->description = 'Покупатель без регистрации на сайте';
        $guest->save();

        $commenter = new Role();
        $commenter->name = 'commenter';
        $commenter->display_name = 'Зарегистрированный пользователь';
        $commenter->description = 'Зарегистрированный пользователь. Может оставлять комментарии и лайки в блоге, редактировать свой профиль, отслеживать свои заказы.';
        $commenter->save();

        $editor = new Role();
        $editor->name = 'editor';
        $editor->display_name = 'Редактор сайта';
        $editor->description = 'Редактор сайта. Имеет доступ к разделам панели управления сайтом для его наполнения и редактирования контента';
        $editor->save();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Администратор сайта';
        $admin->description = 'Администратор имеет полный доступ к панели управления сайтом, включая управление заказами через Интернет магазин и правами пользователей.';
        $admin->save();

        $makeShopping = new Permission();
        $makeShopping->name = 'make-shopping';
        $makeShopping->save();
        $guest->attachPermission($makeShopping);
        
        $makeComments = new Permission();
        $makeComments->name = 'make-comments';
        $makeComments->save();
        $commenter->attachPermissions(array($makeComments,$makeShopping) );
        
        $makeArticles = new Permission();
        $makeArticles->name = 'make-articles';
        $makeArticles->save();
        $editor->attachPermissions(array($makeArticles,$makeComments,$makeShopping));
        
        $editSite = new Permission();
        $editSite->name = 'edit-site';
        $editSite->save();
        $admin->attachPermissions(array($editSite,$makeArticles,$makeComments,$makeShopping));

	}
	
}

// php artisan db:seed  -> we run DatabaseSeeder.php , where function run() starts this file:
//  $this->call(RolesAndPermissionsSeeder::class);
// or we can run this class directly:
//php artisan db:seed --class=RolesAndPermissionsSeeder