<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $member = User::where('is_admin', 0)->paginate(10);
        return view('admin.member',compact('member'));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
        $member = User::find($id);
        $member->delete();
        return redirect()->route('member.index')->with('sukses','Data Member Berhasil Dihapus');
    }

}
