# ribs-module-comment

[![Build Status](https://scrutinizer-ci.com/g/Piou-piou/ribs-module-comment/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Piou-piou/ribs-module-comment/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Piou-piou/ribs-module-comment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Piou-piou/ribs-module-comment/?branch=master)

This a blog module wich it run under Ribs-framework all version. It can be used with any ribs module which run over Ribs 2.3.5.6

## To use it
### Explanations to call the module in controller

In the controller of any module, before to create $arr value wich will be used in twig initialise getting of the comments.
To do this it's very simple, you have to do inly those two lines : 

```PHP
$comment = new \modules\comment\app\controller\Comment();
$comments = ["name_of_array" => $comment->getComments("name_of_table", id_number)];
```

### Explanations of the var
* name_of_array : define the name of the array wich will be used for twig call in template
* name_of_table : the name of the table to associate comment to a page or a specific module
* id_number : the id in the table name to associate comment to a specific page, article, ...

### Example for the controller
For exemple you have the blog module activated on your website, to add comment on articles you have to change controller
that get an article

#### Controller without comments activated
```PHP
$article = new \modules\blog\app\controller\Article();
$article->getArticle();
	
$category = new \modules\blog\app\controller\Category();
$category->getCategoryArticle();
	
$arr = \modules\blog\app\controller\Blog::getValues();
	
\core\App::setTitle(" ".$arr["blog"]["article"]["title"]);
\core\App::setDescription("". $arr["blog"]["article"]["title"]);
```

#### Controller with comments activated
```PHP
$article = new \modules\blog\app\controller\Article();
$article->getArticle();
	
$category = new \modules\blog\app\controller\Category();
$category->getCategoryArticle();

$comment = new \modules\comment\app\controller\Comment();
$comments = ["comments" => $comment->getComments("_blog_article", 1)];

$arr = array_merge(\modules\blog\app\controller\Blog::getValues(), $comments);
	
\core\App::setTitle(" ".$arr["blog"]["article"]["title"]);
\core\App::setDescription("". $arr["blog"]["article"]["title"]);
```

### Explanations to call the module in views

In views parts you just have to add a simple line of code where you want to display all comments wich were added to twig var before.
Where you want to display comments you have to do this : 
```twig
{{ name_of_array|raw }}
```

and that's all, enjoy :)