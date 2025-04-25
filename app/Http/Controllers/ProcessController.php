<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Artisan;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Response;
use Illuminate\View\View;

class ProcessController extends Controller
{
    /**
     * Display generator.
     *
     * @return Response
     */
    public function getGenerator()
    {
        $roles = Role::all();
        return view('laravel-admin::generator',compact('roles'));
    }

    /**
     * Process generator.
     *
     * @return Response
     */
    public function postGenerator(Request $request)
    {
        $this->validate($request,[
            'crud_name'  => 'required',
            'menu_icon' => 'required',
            'fields' => 'required',
        ]);

        $commandArg = [];
        $commandArg['name'] = $request->crud_name;

        if ($request->has('fields')) {
            $fieldsArray = [];
            $validationsArray = [];
            $x = 0;
            foreach ($request->fields as $field) {
                if ($request->fields_required[$x] == 1) {
                    $validationsArray[] = $field;
                }

                $fieldsArray[] = $field . '#' . $request->fields_type[$x];

                $x++;
            }

            //ผู้สร้างกับผู้แก้ไข สถานะ
            $fieldsArray[] = 'state#boolean';
            $fieldsArray[] = 'created_by#bigint';
            $fieldsArray[] = 'updated_by#bigint';
            $commandArg['--fields'] = implode(";", $fieldsArray);
        }

        if (!empty($validationsArray)) {
            $commandArg['--validations'] = implode("#required;", $validationsArray) . "#required";
        }

        if ($request->has('route')) {
            $commandArg['--route'] = $request->route;
        }

        if ($request->has('view_path')) {
            $commandArg['--view-path'] = $request->view_path;
        }

        if ($request->has('controller_namespace')) {
            $commandArg['--controller-namespace'] = $request->controller_namespace;
        }

        if ($request->has('model_namespace')) {
            $commandArg['--model-namespace'] = $request->model_namespace;
        }

        if ($request->has('route_group')) {
            $commandArg['--route-group'] = $request->route_group;
        }

        if ($request->has('relationships')) {
            $commandArg['--relationships'] = $request->relationships;
        }

        if ($request->has('form_helper')) {
            if($request->form_helper == null || $request->form_helper == ""){
                $commandArg['--form-helper'] = 'html';
            }else{
                $commandArg['--form-helper'] = $request->form_helper;
            }
        }

        if ($request->has('soft_deletes')) {
            $commandArg['--soft-deletes'] = $request->soft_deletes;
        }


        try {

            //Create update-state Route
            $routes = File::get(base_path('routes/web.php'));
            $update_route = "Route::put('{$request->route_group}/".strtolower($request->crud_name)."/update-state', '{$request->controller_namespace}\\{$request->crud_name}Controller@update_state');";
            File::put(base_path('routes/web.php'), $routes."\n".$update_route);

            Artisan::call('crud:generate', $commandArg);

            $menus = json_decode(File::get(base_path('resources/laravel-admin/menus.json')));

            $name = $commandArg['name'];
            $routeName = ($commandArg['--route-group']) ? $commandArg['--route-group'] . '/' . snake_case($name, '-') : snake_case($name, '-');
            $icon_partials = explode(' ',$request->menu_icon);
            $icon = array_last($icon_partials);


            $menus->menus = array_map(function ($menu) use ($name, $routeName,$icon) {
                if ($menu->section == 'Modules') {
                    array_push($menu->items, (object) [
                        'title' => $name,
                        'icon' => $icon,
                        'url' => '/' . $routeName,
                    ]);
                }

                return $menu;
            }, $menus->menus);

            File::put(base_path('resources/laravel-admin/menus.json'), json_encode($menus, JSON_PRETTY_PRINT));

            Artisan::call('migrate');

            //Permission given to Admin
            $name = str_slug($name,'-');
           $admins =  User::has('roles')->where('name','=','admin')->get();
            $add_permission = \App\Permission::firstOrCreate(
                ['name' => 'add-'.$name]);
            $edit_permission = \App\Permission::firstOrCreate(
                ['name' => 'edit-'.$name]);
            $view_permission =\App\Permission::firstOrCreate(
                ['name' => 'view-'.$name]);
            $delete_permission = \App\Permission::firstOrCreate(
                ['name' => 'delete-'.$name]);

            foreach ($admins as $admin) {
                $role = $admin->roles()->where('name','=','admin')->first();

                if(!$admin->hasPermission($add_permission)){
                    $role->givePermissionTo($add_permission);
                }

                if(!$admin->hasPermission($edit_permission)){
                    $role->givePermissionTo($edit_permission);
                }

                if(!$admin->hasPermission($view_permission)){
                    $role->givePermissionTo($view_permission);
                }

                if(!$admin->hasPermission($delete_permission)){
                    $role->givePermissionTo($delete_permission);
                }
            }

            //Write Permission To File AdminSeeder
            $AdminSeeder = File::get(base_path('database/seeds/AdminSeeder.php'));
      			$text_permission = '$'.$name.'_add    = Permission::firstOrCreate([\'name\' => \'add-'.$name.'\']);
      $'.$name.'_view   = Permission::firstOrCreate([\'name\' => \'view-'.$name.'\']);
      $'.$name.'_edit   = Permission::firstOrCreate([\'name\' => \'edit-'.$name.'\']);
      $'.$name.'_delete = Permission::firstOrCreate([\'name\' => \'delete-'.$name.'\']);

      if (!$admin->hasPermission($'.$name.'_add)) {
        $admin_role->givePermissionTo($'.$name.'_add);
      }
      if (!$admin->hasPermission($'.$name.'_view)) {
        $admin_role->givePermissionTo($'.$name.'_view);
      }
      if (!$admin->hasPermission($'.$name.'_edit)) {
        $admin_role->givePermissionTo($'.$name.'_edit);
      }
      if (!$admin->hasPermission($'.$name.'_delete)) {
        $admin_role->givePermissionTo($'.$name.'_delete);
      }

      #EndCommand';

            $AdminSeeder = str_replace("#EndCommand", $text_permission, $AdminSeeder);
            File::put(base_path('database/seeds/AdminSeeder.php'), $AdminSeeder);

        } catch (\Exception $e) {
            return Response::make($e->getMessage(), 500);
        }

        Session::flash('message','Your CRUD has been generated. See on the menu.');

        return redirect('crud-generator');
    }
}
