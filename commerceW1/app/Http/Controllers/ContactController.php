<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class ContactController extends Controller
{
    private function data()
    {
        if (!Cookie::has('contact'))
        {
            return [];
        }

        // Terima as JSON
        $data = Cookie::get('contact');
        $data = \json_decode($data);
        return $data;
    }

    public function View()
    {
        return \view('contact');
    }

    public function ActionContact(Request $request)
    {
        $data = $this->data();
        $d = [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "phone" => $request->input('phone'),
            "message" => $request->input('message'),
        ];

        $data[] = $d;

        $data = \json_encode($data);
        $c = Cookie::make("contact", $data, 60*24*30);
        Cookie::queue($c);

        // dd($request->all());
        // dd(Cookie::get('contact'));
        return 'Success';
    }

    public function ContactList(Request $request)
    {
        // dd($request->cookie('contact'));
        $contacts = json_decode($request->cookie('contact'), true) ?? [];
        return view('contactlist', ['contacts' => $contacts]);


    }



    public function deleteContact($index)
    {
        // Mendapatkan data kontak dari cookie
        $contacts = json_decode(request()->cookie('contact'), true) ?? [];

        // Memeriksa apakah indeks yang diberikan valid
        if (isset($contacts[$index])) {
            // Menghapus data kontak berdasarkan indeks
            unset($contacts[$index]);

            // Mengurutkan kembali array untuk mengisi indeks yang kosong
            $updatedContacts = array_values($contacts);

            // Membuat cookie baru dengan data yang telah dihapus
            $cookie = cookie("contact", json_encode($updatedContacts), 60*24*30);

            // Memberikan respons bahwa penghapusan berhasil
            return redirect()->back()->with('success', 'Contact deleted successfully.');
        }

        // Jika indeks tidak valid, memberikan respons bahwa penghapusan gagal
        return redirect()->back()->with('error', 'Failed to delete contact.');
    }
}


