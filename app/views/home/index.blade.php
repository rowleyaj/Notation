<div class="postList">
	<header><input type="text" ng-model="query" placeholder="Search"></header>
	<ul class="unstyled">
		<li ng-repeat="post in posts | filter:query" ng-click="showPost(post)">
			<a href="#/[[post.slug]]">[[post.title]]</a>
		</li>
	</ul>
</div>

<div class="canvas">
	<h2>[[currentPost.title]]</h2>
	<div class="dateLine">[[currentPost.date]]</div>
	<div class="post" ng-bind-html-unsafe="currentPost.content">
</div>