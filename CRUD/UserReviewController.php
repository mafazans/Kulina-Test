<?php

namespace CRUD;

// Use User Models for user_id
use CRUD\User;
// Use Order Models for order_id
use CRUD\Order;
// Use Product Models for product_id
use CRUD\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

// asumsikan dalam coding ini User telah login
// ketika melakukan create, update & delete user berada pada halaman order/product sehingga kita memiliki data product_id dan order_id
// user harus order terlebih bahulu untuk memberikan rating & review

class UserReviewController extends Controller{
	public function addUserReview(Request $request){
		$user_id = $request->auth;
		$order_id = $request->order_id;
		$product_id = $request->product_id;

		$this->validate($request, [
		    'rating' => 'required',
		    'review' => 'required',
		]);

		$data = $request->all();
		$post = [];

		$post['created_at'] = date('Y-m-d H:i:s');
		$post['updated_at'] = date('Y-m-d H:i:s');
		$post['user_id'] = $user_id;
		$post['order_id'] = $order_id;
		$post['product_id'] = $product_id;
		$post['rating'] = $data['rating'];
		$post['review'] = $data['name'];

		UserReview::add($post);

		return response()->json([
		    'status' => 'success',
		    'data' => $post
		]);
	}

	public function getProductReview(Request $request){
		$productId = $request->productId;
		$productReview = UserReview::getUserReview($productId);

		if(!$productReview){
			return response()->json([
				'status' => 'failed',
				'data' => 'Product tidak ditemukan'
			]);
		}
		return response()json([
			'status' => 'sucess',
			'data' => $productReview
		]);
	}

	public function updateReview(Request $request, $productId, $orderId, $reviewId){
		$reviewId = $request->reviewId;

		$userId = $request->auth;
		$orderId = $request->order_id;
		$productId = $request->product_id;

		$data = request->post();
		$post = [];

		// cek product exist
		$review = UserReview::findById($reviewId);
		if(!$review){
			return response()->json([
				'status' => 'failed',
				'message' => 'Review tidak ditemukan'
			]);
		}
		//check whom rating & review belongs
		$checkUser = UserReview::checkUser($userId, $productId);
			if(!$checkUser){
				return response()->json([
					'status' => 'failed',
					'message' => 'No Permission'
				]);
			}

		$post['updated_at'] = date('Y-m-d H:i:s');

		if(isset($data['rating'])) {
		    $post['rating'] = $data['rating'];
		}

		if(isset($data['review'])) {
            $post['review'] = $data['review'];
        }

    UserReview::updateData($reviewId, $post)
	}

	public function deleteReview(Request $request, $reviewId){
		$userId = $request->auth;
		$review = UserReview::findById($reviewId);

		if(!$review) {
			return response()->json([
			    'status' => 'failed',
			    'message' => 'Review tidak ditemukan'
			]);
		}

		$checkUser = UserReview::checkUser($userId, $productId);
			if(!$checkUser){
				return response()->json([
					'status' => 'failed',
					'message' => 'No Permission'
				]);
			}
		UserReview::remove($reviewId);
	}
}