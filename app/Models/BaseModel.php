<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

		/**
		 * This class sotres common funcitons required by model.
		 */


		/**
		 * Returns model by id
		 * @param  int $id
		 * @param  array  $columns
		 * @return object
		 */
		public function findById($id, $columns = array('*'))
		{
			return $this->find($id, $columns);
		}

		/**
		 * Returns model by attribute
		 * @param  string $attribute
		 * @param  string $value
		 * @param  array  $columns
		 * @return object
		 */
		public function findBy($attribute, $value, $columns = array('*'))
		{
			return $this->where($attribute, '=', $value);
		}

		/**
		 * Returns call models
		 * @param  array  $columns
		 * @return object
		 */
		public function findall($columns = array('*'))
		{
			return $this->get($columns);
		}

		/**
		 * Returns paginated collection.
		 * @param  integer $perPage
		 * @param  array   $columns
		 * @return object
		 */
		public function paginate($perPage = 1, $columns = array('*'))
		{
			return $this->paginate($perPage, $columns);
		}

		/**
		 * Created model.
		 * @param  array  $data
		 * @return object
		 */
		public function make(array $data)
		{
			return $this->create($data);
		}

		/**
		 * update model
		 * @param  array  $data
		 * @param  int $id
		 * @param  string $attribute
		 * @return object
		 */
		public function updateModel(array $data, $id, $attribute = "id")
		{
			return $this->find($id)->update($data);
		}

		/**
		 * Remove model
		 * @param  int $id
		 * @return object
		 */
		public function remove($id)
		{
			return $this->destroy($id);
		}


		/**
		 * Returns list for select box.
		 * @param  string $first
		 * @param  string $second
		 * @return object
		 */
	    public function lists($first,$second)
	    {
	        return $this->lists($first,$second);
	    }

	    /**
	     * Returns model by slug
	     * @param  string $slug
	     * @return object
	     */
		public function getIdBySlug($slug)
		{
			return $this->findBy('slug',$slug,['id'])->id;
		}


		public function getSlug($title)
		{
			$slug 		= Str::slug($title);
		    $slugCount 	= count( $this->model->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

		   	return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
		}

}
