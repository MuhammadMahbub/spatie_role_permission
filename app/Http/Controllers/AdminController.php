<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shetabit\Visitor\Models\Visit;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function index(){
        $total = Visit::whereIn('browser', ['IE', 'Firefox', 'Chrome', 'Safari', 'Opera'])->whereDate('created_at', '>', Carbon::now()->subDays(28))->get();
        $chrome = $total->where('browser', 'Chrome')->count();
        $firefox = $total->where('browser', 'Firefox')->count();
        $internet = $total->where('browser', 'IE')->count();
        $safari = $total->where('browser', 'Safari')->count();
        $opera = $total->where('browser', 'Opera')->count();

        $total = $total->count();
        // $browser = [];
        // $browser['chrome'] = round(($chrome /  $total) * 100);
        // $browser['firefox'] = round(($firefox /  $total) * 100);
        // $browser['internet'] = round(($internet /  $total) * 100);
        // $browser['safari'] = round(($safari /  $total) * 100);
        // $browser['opera'] = round(($opera /  $total) * 100);

        $today_page_views = Visit::whereDate('created_at', '=', Carbon::today())->count();

        $unique_users = User::count();

        $top_pages = Visit::select('url')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('url')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
        return view('admin.index',compact(  'today_page_views', 'unique_users', 'top_pages'));
    }

    // User List
    public function userList(){
        $users = User::orderBy('name', 'asc')->get();

        return view('admin.users.index', compact('users'));
    }
    public function userEdit($id){
        $user = User::find($id);
        $user_permissions = DB::table("model_has_permissions")->where("model_has_permissions.model_id",$id)->pluck('model_has_permissions.permission_id')->all();
        $user_roles = DB::table("model_has_roles")->where("model_has_roles.model_id",$id)->pluck('model_has_roles.role_id')->all();
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.users.edit',compact('user','roles','permissions','user_roles','user_permissions'));
    }
    public function userUpdate(Request $request, $id){
        $user = User::find($id);
        $user->update([
            'name'=>$request->name,
        ]);
        $user->syncRoles($request->role);
        $user->syncPermissions($request->permission);
        return redirect()->route('users.index');
    }

     // User Delete
    public function userDestroy($id){
        $user = User::find($id);
        // $user_permissions = DB::table("model_has_permissions")->where("model_has_permissions.model_id",$id)->pluck('model_has_permissions.permission_id')->all();
        // $user_roles = DB::table("model_has_roles")->where("model_has_roles.model_id",$id)->pluck('model_has_roles.role_id')->all();
        // foreach($user_permissions as $user_permission){
        //     $user->revokePermissionTo($user_permission);
        // }
        // foreach($user_roles as $user_role){
        //     $user->removeRole($user_role);
        // }

        $user->delete();

        return back()->withSuccess('User deleted');
    }

    public function user_role_assign($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.users.role_assign',compact('roles','user'));
    }
    public function user_role(Request $request){
        $user = User::find($request->user);
        $role = Role::find($request->role);
        $user->syncRoles($role);
        return redirect()->route('users.index');
    }
    public function user_permission_assign($id){
        $user = User::find($id);
        $permissions = Permission::all();
        return view('admin.users.permission_assign',compact('user','permissions'));
    }
    public function user_permission(Request $request){
        $user = User::find($request->user);
        $permission = Permission::find($request->permission);
        $user->syncPermissions($permission);
        return redirect()->route('users.index');
    }

}
