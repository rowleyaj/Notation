<?php
use dflydev\markdown\MarkdownExtraParser;

class PostsController extends BaseController {

	private function assemblePost($input)
	{
		$newPost = "\n";
		$newPost .= "title: ".$input['title']."\n";
		$newPost .= "date: ".$input['date']."\n";
		$newPost .= "\n------\n\n";
		$newPost .= $input['markdown'];
		return $newPost;
	}

	private function parsePost($post)
	{
		$md = new MarkdownExtraParser();
		$r = array();
		$r['filename'] = basename($post);
		$r['id'] = substr($r['filename'], 0, 2);
		$r['slug'] = substr(substr($r['filename'], 3), 0, -3);
		$post = file_get_contents($post);
		$info = explode('------', $post);
		$r['markdown'] = trim($info[1]);
		$r['content'] = $md->transformMarkdown(trim($info[1]));
		$pieces = explode("\n", $info[0]);
		foreach ($pieces as $piece) {
			if($piece)
			{
				$exp = explode(':', $piece);
				$r[$exp[0]] = trim($exp[1]);
			}
		}
		return (object) $r;
	}

	private function getPosts()
	{
		$posts = glob(app_path().'/posts/*.md');
		$return = array();
		foreach($posts as $post) $return[] = $this->parsePost($post);
		return array_reverse($return);
	}

	private function getPost($post)
	{
		$posts = $this->getPosts();
		foreach ($posts as $p) {
			if($p->filename == $post) return $p;
		}
	}

	public function index()
	{
		return Response::json($this->getPosts());
	}

	public function update($filename)
	{
		if(!Auth::check()) return 'Error';
		$input = array(
			'title' => Input::json('title'),
			'date' => Input::json('date'),
			'markdown' => Input::json('markdown'),
		);
		$newPost = $this->assemblePost($input);
		$fp = fopen(app_path().'/posts/'.$filename, 'w');
		fwrite($fp, $newPost);
		fclose($fp);
		return Response::json($this->getPost($filename));
	}

	public function store()
	{
		if(!Auth::check()) return 'Error';
		$input = array(
			'title' => Input::json('title'),
			'date' => Input::json('date'),
			'markdown' => Input::json('markdown'),
		);
		$newPost = $this->assemblePost($input);
		$posts = $this->getPosts();

		if($posts){
			$filename = (sprintf("%02s", $posts[0]->id+1)).'-'.Input::json('slug').'.md';
		} else {
			$filename = '01-'.Input::json('slug').'.md';
		}

		$fp = fopen(app_path().'/posts/'.$filename, 'w');
		fwrite($fp, $newPost);
		fclose($fp);

		return Response::json($this->getPost($filename));
	}

	public function destroy($filename)
	{
		if(!Auth::check()) return 'Error';
		unlink(app_path().'/posts/'.$filename);
		return 'Deleted';
	}

}