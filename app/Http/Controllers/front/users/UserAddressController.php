<?php

namespace App\Http\Controllers\front\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\users\UpdateAddressRequest;
use App\Http\Requests\api\users\userAddressRequest;
use App\Http\Resources\users\AddressesResource;
use App\Models\Users\Address;
use App\Traits\messageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAddressController extends Controller
{
    use messageTrait;
    public function index(){
        try {
        $user = auth()->user();
        $addresses = $user->addresses()->get();
        return $this->successfully(trans('api.userAddresses'), [
            'addresses' => AddressesResource::collection($addresses)
        ]);
        } catch (\Exception $e) {

            return $this->failed($e->getMessage());
        }
    }

    public function store(userAddressRequest $request){
        $user = auth()->user();
        $data = $request->validated();
        DB::beginTransaction();
        try{
            if($user->addresses()->count() == 0){
                $data['is_default'] = true;
            }else{
                $data['is_default'] = false;
            }
            $user->addresses()->create($data);
            DB::commit();
            return $this->index();
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed($e->getMessage());
        }
    }

    public function update(userAddressRequest $request, Address $address){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $address->update($data);
            if ($request->default) {
                $user = auth()->user();
                $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
            }
            DB::commit();
            return $this->index();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failed($e->getMessage());
        }
    }

    public function changeDefaultAddress(Address $address)
    {
        try {
        $user = auth()->user();
        $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        $address->update(['is_default' => true]);
        return $this->index();
        } catch (\Exception $e) {

            return $this->failed($e->getMessage());
        }
    }

    public function destroy(Address $address)
    {
        try {
        $user = auth()->user();

            if ($user->id == $address->user_id) {
                $address->delete();
                return $this->index();
            }
            return $this->failed(trans('api.YouAreNotTheOwnerOfThisAddress'));


        } catch (\Exception $e) {

            return $this->failed($e->getMessage());
        }
    }
}
