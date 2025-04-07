<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('userprofile')->get();

        return $this->Ok($users, "Users has been retrieved!");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        if (isset($inputs['first_name'])) {
            $inputs['first_name'] = $this->SanitizeString($inputs["first_name"]);
        }

        if (isset($inputs['last_name'])) {
            $inputs['last_name'] = $this->SanitizeString($inputs["last_name"]);
        }

        $validator = validator()->make($inputs, [
            "username" => "required|string|min:4|max:25|alpha_dash|unique:users",
            "email" => "required|email|max:50|unique:users",
            "first_name" => "required|string|min:4|max:50|regex:/^[a-zA-Z '.,-]*$/",
            "last_name" => "required|string|min:4|max:50|regex:/^[a-zA-Z '.,-]*$/",
            "password" => "required|string|min:7|max:100"
        ]);

        if ($validator->fails()) 
        {
            return $this->BadRequest($validator, "Error creating user!");
        }

        $user = User::create($validator->validated());
        $user->userProfile()->create($validator->validated());
        $user->userProfile;

        return $this->Created($user, "User $user->username has been created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if(empty($user)) 
        {
            return $this->NotFound("User id $id does not exists!");
        }

        $user->userProfile;

        $full_name = $user->userProfile->first_name;

        return $this->Ok($user, "User $full_name has been retrieved!");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (empty($user)) 
        {
            return $this->NotFound("User id $id does not exist!");
        }

        $inputs = $request->all();
        // Returns Error if Inputs are empty (but not Working!!)
        if (empty(array_filter($inputs))) {
            return $this->BadRequest(null, "Input cannot be empty!");
        }

        if (isset($inputs['first_name'])) {
            $inputs['first_name'] = $this->SanitizeString($inputs["first_name"]);
        }

        if (isset($inputs['last_name'])) {
            $inputs['last_name'] = $this->SanitizeString($inputs["last_name"]);
        }

        $validator = validator()->make($inputs, [
            "username" => "sometimes|string|min:4|max:25|alpha_dash|unique:users,username,$id",
            "email" => "sometimes|email|max:50|unique:users,email,$id",
            "first_name" => "sometimes|string|min:4|max:50|regex:/^[a-zA-Z '.,-]*$/",
            "last_name" => "sometimes|string|min:4|max:50|regex:/^[a-zA-Z '.,-]*$/",
            "password" => "sometimes|string|min:7|max:100"
        ]);

        if ($validator->fails()) 
        {
            return $this->BadRequest($validator, "Error updating user!");
        }

        $validatedData = $validator->validated();

        // Update user fields
        $user->update($validatedData);

        // Update profile fields
        $profileData = array_intersect_key($validatedData, array_flip(['first_name', 'last_name', 'contact_number']));
        if (!empty($profileData)) {
            $user->userProfile()->update($profileData);
        }

        $user->userProfile;

        return $this->Ok($user, "User $user->username has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (empty($user)) 
        {
            return $this->NotFound("User id $id does not exist!");
        }

        $user->delete();

        return $this->Ok($user, "User $user->username has been deleted!");
    }
}
