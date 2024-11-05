<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Auth;

class FavoriteController extends Controller
{
    // public function toggleFavorite($postId)
    // {
    //     // Dapatkan user ID yang sedang login
    //     $userId = Auth::id();

    //     // Cari apakah favorit untuk postingan ini sudah ada
    //     $favorite = Favorite::where('post_id', $postId)->where('user_id', $userId)->first();

    //     if ($favorite) {
    //         // Jika sudah ada, hapus dari favorit
    //         $favorite->delete();
    //         $isFavorite = false;
    //     } else {
    //         // Jika belum ada, tambahkan ke favorit
    //         Favorite::create([
    //             'post_id' => $postId,
    //             'user_id' => $userId,
    //         ]);
    //         $isFavorite = true;
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'is_favorite' => $isFavorite,
    //     ]);
    // }

    // public function index()
    // {
    //     $user = auth()->user();
    //     $favorites = $user->favorites()->with(['article', 'video'])->get();

    //     return view('favorite.index', compact('favorites', 'user'));
    // }

    // public function favorite(ForumPost $post)
    // {
    //     Auth::user()->favorites()->attach($post->id);
    //     return back();
    // }

    // public function unfavorite($postId)
    // {
    //     $post = ForumPost::findOrFail($postId);

    //     // Hapus dari tabel favorit
    //     Favorite::where('user_id', Auth::id())
    //             ->where('post_id', $post->post_id)
    //             ->delete();

    //     return redirect()->route('favorite.index', ['post' => $postId])
    //                     ->with('success', 'Post telah dihapus dari favorit');
    // }

    // public function __construct()
	// {
	// 	parent::__construct();

	// 	$this->middleware('auth');
	// }

    public function index()
	{
        $user = auth()->user();
        $favorites = $user->favorites()->with(['article', 'video'])->get();
		$favorites = Favorite::where('user_id', \Auth::user()->id)
			->orderBy('created_at', 'desc')->paginate(10);

		$this->data['favorites'] = $favorites;

		return view('favorite.index', compact('favorites', 'user'));
	}

    public function store(Request $request)
	{
		$request->validate(
			[
				'product_slug' => 'required',
			]
		);

		$product = Product::where('slug', $request->get('product_slug'))->firstOrFail();

		$favorite = Favorite::where('user_id', \Auth::user()->id)
			->where('product_id', $product->id)
			->first();
		if ($favorite) {
			return response('You have added this product to your favorite before', 422);
		}

		Favorite::create(
			[
				'user_id' => \Auth::user()->id,
				'product_id' => $product->id,
			]
		);

		return response('The product has been added to your favorite', 200);
	}

    public function destroy($id)
	{
		$favorite = Favorite::findOrFail($id);
		$favorite->delete();

		\Session::flash('success', 'Your favorite has been removed');

		return redirect('favorites');
	}


}
