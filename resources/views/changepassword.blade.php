@extends('layouts.DashboardLayout')
@section('content')
<div class="p-4  bg-white shadow">
    <div class="">
        <section>
<header>
<h2 class="text-lg font-medium text-gray-900">
Update Password
</h2>

<p class="mt-1 text-sm text-gray-600">
Ensure your account is using a long, random password to stay secure.
</p>
</header>

<form method="post" action="http://127.0.0.1:8000/password" class="mt-6 space-y-6">
<input type="hidden" name="_token" value="KrBO7XCslVK57qwyeHh5SJVH3fbwge1vvDjEVSdF">        <input type="hidden" name="_method" value="put">
<div>
<label class="block font-medium text-sm text-gray-700" for="current_password">
Current Password
</label>
<input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="current_password" name="current_password" type="password" autocomplete="current-password">
        </div>

<div>
<label class="block font-medium text-sm text-gray-700" for="password">
New Password
</label>
<input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="password" name="password" type="password" autocomplete="new-password">
        </div>

<div>
<label class="block font-medium text-sm text-gray-700" for="password_confirmation">
Confirm Password
</label>
<input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
        </div>

<div class="flex items-center gap-4">
<button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
Save
</button>

        </div>
</form>
</section>
    </div>
</div>
@endsection

