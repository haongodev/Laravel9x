<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// my page
Breadcrumbs::for('mypage', function (BreadcrumbTrail $trail) {
    $trail->push('私の研鑽データ', route('mypage'));
});

// creditRegistration
Breadcrumbs::for('creditRegistration', function (BreadcrumbTrail $trail) {
    $trail->push('研鑽を積み上げる(単位登録)', route('creditRegistration'));
});

// creditRegistration > registry
Breadcrumbs::for('creditRegistry', function (BreadcrumbTrail $trail) {
    $trail->parent('creditRegistration');
    $trail->push('(選択した類型)', route('creditRegistry'));
//  $trail->push($category->title, route('category', $category)); for dynamic
});
