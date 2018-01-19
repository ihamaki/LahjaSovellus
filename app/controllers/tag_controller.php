<?php

class TagController extends BaseController{

	public static function list(){
		$user = self::get_user_logged_in();
		$tags = Tag::all($user->id);
		View::make('tag/tag_list.html', array('tags' => $tags));
	}

	public static function show($id){
		$tag = Tag::find($id);
		self::check_if_authorized($tag->account_id);
		View::make('tag/tag_show.html', array('tag' => $tag));
	}

	public static function new(){
		View::make('tag/tag_new.html');
	}

	public static function create(){
		$user = self::get_user_logged_in();
		$params = $_POST;
		$attributes = array(
				'account_id' => $user->id,
				'name' => $params['name']
		);
		$tag = new Tag($attributes);
		$errors = $tag->errors();

		if(count($errors) == 0){
				$tag->save();
				Redirect::to('/tags', array('message' => 'Tagin luonti onnistui!'));
		}else{
				$user = self::get_user_logged_in();
				View::make('tag/tag_new.html', array('errors' => $errors, 'attributes' => $attributes));
		}
	}

	public static function edit($id){
		$tag = Tag::find($id);
		self::check_if_authorized($tag->account_id);
		View::make('tag/tag_edit.html', array('tag' => $tag));
	}

	public static function update($id){
		$tag = Tag::find($id);
		self::check_if_authorized($tag->account_id);

		$params = $_POST;
		$tag = new Tag(array(
				'id' => $id,
				'name' => $params['name']
		));
		$errors = $tag->errors();

		if(count($errors) == 0){
				$tag->update();
				Redirect::to('/tags/' . $tag->id, array('message' => 'Tagin muokkaus onnistui!'));
		}else{
				$user = self::get_user_logged_in();
				View::make('tag/tag_edit.html', array('errors' => $errors, 'tag' => $tag));
		}
	}

	public static function destroy($id){
			$tag = Tag::find($id);
			self::check_if_authorized($tag->account_id);
			$tag->delete();
			Redirect::to('/tags', array('message' => 'Tagin poisto onnistui!'));
	}
}