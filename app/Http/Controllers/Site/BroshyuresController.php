<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Broshyur;
use App\Models\Pages\Pageinnovation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BroshyuresController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $posts = Broshyur::orderBy('id', 'desc')
            ->paginate(20);

        return view('site.broshyures.index')->with([
            'title' => 'Բոլորը',
            'posts' => $posts,
        ]);
    }

    public function download( $filename = '' ) {
        //PDF file is stored under project/public/download/info.pdf
      //  $file = storage_path(). '\files\\'. $filename;
        //$file= public_path(). "/download/info.pdf";
        asset('storage/files/meWMDc5g_mail_shipped_message.pdf');



        $headers = [

            'Content-Type' => 'application/pdf',

        ];


        //return response()->download($file, 'meWMDc5g_mail_shipped_message.pdf', $headers);
        return Storage::download($file, 'meWMDc5g_mail_shipped_message.pdf', $headers);
        /*Test*/
        exit('777');
        /*Testend*/
        // Check if file exists in storage directory
        $file_path = storage_path(). '\files\\'. $filename;
      //  $file_path = asset('storage/files').'/' . $filename;


        return \Response::download( $file_path);

        $headers = [

            'Content-Type' => 'application/pdf',

        ];



        return response()->download($file, 'filename.pdf', $headers);

        if ( file_exists( $file_path ) ) {


            return \Response::download( $file_path);

          //  return response()->download(storage_path('app/' . $file->location));


        } else {
            // Error exit( 'Requested file does not exist on our server!' );
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Broshyur::where(['slug' => $slug])->firstOrFail();
        if(!$post->hasTranslation('name',\App::getLocale())){
            abort(403);
        }
        return view('site.broshyures.show', compact('post'))->with([
            'title' => $post->name,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
