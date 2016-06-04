<?php

namespace App\Support\Storage;

use App\Support\Storage\Contracts\StorageInterface;
use Session;

class SessionStorage implements StorageInterface
{
	protected $bucket;

	public function __construct($bucket = 'default')
	{
		if(! Session::has($bucket)) 
		{
			Session::put($bucket, []);
		}

		$this->bucket = $bucket;
	}

	public function set($index, $value)
	{
		return Session::put("{$this->bucket}.{$index}", $value);
	}

	public function get($index) 
	{
		if (! $this->exists($index)) {
			return null;
		}

		return Session::get("$this->bucket.{$index}");
	}

	public function exists($index)
	{
		return Session::has("{$this->bucket}.{$index}");
	}

	public function all()
	{
		return Session::get("{$this->bucket}");
	}

	public function unset($index)
	{
		if ($this->exists($index)) {
			Session::forget("{$this->bucket}.{$index}");
		}
	}

	public function clear()
	{
		Session::forget($this->bucket);
	}
}