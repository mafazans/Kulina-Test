<!-- This is model UserReview -->
<?php

namespace CRUD;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Directory extends Model {
	protected $table = 'user_review';

	public static function add($data) {
	    DB::table('user_review')
	        ->insert($data);
	}

	public static function getUserReview($productId){
		$result = DB::table('user_review')
		->select('product_id', 'user_id', 'rating', 'review')
		->where('productId', '=', $productId)
		->get();
		$data = [];

		foreach($result as $res){
			$data[] = [
				'product_id' => $res->$product_id
				'user_id' => $res->$user_id
				'rating' => $res->$rating
				'review' => $res->$review
			]
		}
		return $data;
	}

	public static function updateData($id, $data) {
	    DB::table('user_review')
	        ->where('id', $id)
	        ->update($data);
	}

	public static function remove($id) {
	    DB::table('user_review')
	        ->where('id', $id)
	        ->delete();
	}

	public static function findById($productId) {
		return DB::table('user_review')
			->select('user_review.*')
			->where('user_review.product_id', $productId)
			->get()
			->first();
	}

	public static function checkUser($userId, $productId){
		return DB::table('user_review')
			->select('user_review.*')
			->where('user_id', $userId)
			->where('product_id', $productId)
			->get()
			->first();
	}
}
