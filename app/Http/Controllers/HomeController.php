<?php namespace App\Http\Controllers;

use App\Article;
use App\Photo;
use App\VideoAlbum;
use App\PhotoAlbum;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');

		//parent::__construct();

		//$this->news = $news;
		//$this->user = $user;
	}


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::with('author')->orderBy('position', 'DESC')->orderBy('created_at', 'DESC')->limit(4)->get();

//		TODO: abstract to model
		$sliders = Photo::join('photo_albums', 'photo_albums.id', '=', 'photos.photo_album_id')->where('photos.slider',
			1)->orderBy('photos.position', 'DESC')->orderBy('photos.created_at', 'DESC')->select('photos.filename',
			'photos.name', 'photos.description', 'photo_albums.folder_id')->get();

        $photoAlbums = $this->getAlbumContent('App\PhotoAlbum', 'photo', 'filename');
        $videoAlbums = $this->getAlbumContent('App\VideoAlbum', 'video', 'youtube');

		return view('pages.home', compact('articles', 'sliders', 'videoAlbums', 'photoAlbums'));
		//return view('pages.welcome');
	}

    private function getAlbumContent($class_name, $table_name, $field)
    {
        $album_table = $table_name.'s';
        $albums = $class_name::select(array(
            $table_name.'_albums.id',
            $table_name.'_albums.name',
            $table_name.'_albums.description',
            $table_name.'_albums.folder_id',
            DB::raw('(select '.$field. ' from ' . DB::getTablePrefix() . $album_table.' WHERE album_cover=TRUE and ' . DB::getTablePrefix() . $album_table.'.'.$table_name.'_album_id=' . DB::getTablePrefix() . $table_name.'_albums.id LIMIT 1) AS album_image'),
            DB::raw('(select '.$field. ' from ' . DB::getTablePrefix() . $album_table.' WHERE ' . DB::getTablePrefix() . $album_table.'.'.$table_name.'_album_id=' . DB::getTablePrefix() . $table_name.'_albums.id ORDER BY position ASC, id ASC LIMIT 1) AS album_image_first')
        ))->limit(8)->get();

        return $albums;
    }

}