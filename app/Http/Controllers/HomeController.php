<?php

namespace App\Http\Controllers;

use App\Models\XMLWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(protected XMLWriter $XMLWriter)
    {
    }

    public function viewHomepage(Request $request)
    {

        try {
            $downloadXml = $request->query('downloadXml');
            if ($downloadXml) {
                Session::flash("downloadXml", true);
            }
            $xmlData = simplexml_load_file(storage_path('app/public/sitemap.xml'));
            $data = $xmlData->children();
            return view('welcome', ['xmlData' => $data, 'downloadXml' => $downloadXml]);
        } catch (\ErrorException $err) {
            return view('welcome', ['xmlData' => null]);
        }

    }

    public function downloadXmlFile()
    {
        return $this->XMLWriter->download();
    }
}
