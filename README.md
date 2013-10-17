newscred
========

Class for working with NewsCred API

example usage to grab the links to articles from a search and put in an array:

		$newscred = new NewsCred('yourapikeyhere');
		$options['query'] = 'Obama Debt Ceiling';
		$results = json_decode($newscred->searchArticles($options));
		$links = array();
		foreach ($results->article_set as $article) {
			array_push($links, $article->link);
		}
    echo print_r($links);
