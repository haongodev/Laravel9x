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

// Sakura set
Breadcrumbs::for('sakuraSet', function (BreadcrumbTrail $trail) {
    $trail->parent('mypage');
    $trail->push('さくらセットに取り組む', route('sakuraSet'));
});
// Sakura set > your try
Breadcrumbs::for('yourTry', function (BreadcrumbTrail $trail) {
    $trail->parent('sakuraSet');
    $trail->push('あなたの取り組み状況', route('yourTry'));
});

// CurrentLearningSituation
Breadcrumbs::for('cls', function (BreadcrumbTrail $trail) {
    $trail->parent('mypage');
    $trail->push('現在の研鑽状況', route('cls'));
});

// creditRegistration
Breadcrumbs::for('creditRegistration', function (BreadcrumbTrail $trail) {
    $trail->push('研鑽を記録する(単位登録)', route('creditRegistration'));
});


// creditRegistration > type selected
Breadcrumbs::for('typeSelected', function (BreadcrumbTrail $trail) {
    $typeNativeId = request('type_native_id',0);
    if($typeNativeId == 1){
        $title = '研修・学会等';
    }else if($typeNativeId == 2){
        $title = '社会的活動';
    }else{
        $title = 'スーパービジョン';
    }
    $trail->parent('creditRegistration');
    $trail->push($title, route('typeSelected'));
//  $trail->push($category->title, route('category', $category)); for dynamic
});

// creditRegistration > type selected > registry
Breadcrumbs::for('creditRegistry', function (BreadcrumbTrail $trail) {
    $trail->parent('typeSelected');
    $trail->push('単位登録', route('creditRegistry'));
//  $trail->push($category->title, route('category', $category)); for dynamic
});

// creditRegistration > type selected > registry > edit
Breadcrumbs::for('creditEdit', function (BreadcrumbTrail $trail) {
    $trail->parent('creditRegistry');
    $trail->push('修正', route('creditEdit'));
//  $trail->push($category->title, route('category', $category)); for dynamic
});
