<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::controller('notifications', 'NotificationsController');
Route::post('notifications/notify', [
    'as' => 'pusher.notify',
    'uses' => 'NotificactionsController@postNotify'
]);
Route::get('/', 'WelcomeController@index');
Route::get('loginN', 'WelcomeController@loginN');
Route::get('home', 'WelcomeController@indexGuest');

Route::get('homes', 'HomeController@index');
Route::get('blockedByAdmin', 'WelcomeController@blockedByAdmin');
Route::get('homeProblemSetter', 'HomeController@indexProblem');
Route::get('homeSolver', 'HomeController@indexSolver');
Route::get('homeAdmin', 'HomeController@indexAdmin');

get('/broadcast', function() {
    event(new \SolutionBook\Entities\TestEvent('Broadcasting in Laravel using Pusher!'));

    return view('welcome');
});

get('/bridge', function() {
    $pusher = \Illuminate\Support\Facades\App::make('pusher');

    $pusher->trigger( 'test-channel',
        'test-event',
        array('text' => 'Preparing the Pusher Laracon.eu workshop!'));

    return view('welcome');
});
Route::get('/register', [
    'as' => 'welcome.register',
    'uses' => 'WelcomeController@getRegister'
]);




Route::post('/addRegister', [
    'as' => 'welcome.addRegister',
    'uses' => 'WelcomeController@addRegister'
]);

Route::get('/test',function(){
//    $path = public_path("testing/cosas.out");
    $nombre = "Marco Perez";
    $key= "P erez";
    dd(strpos($nombre,$key));

    $contentFile = file_get_contents(public_path()."/testing/pruebaC.c");
    $badWords = array('thread','while(1)','while(true)','for(;;)','exec','system','fork','pthread_t','pthread_create');

    $wordsFinded=array();
    foreach($badWords as $bw)
    {
        if(str_contains($contentFile,$bw))
        {
            array_push($wordsFinded,$bw);
        }
    }
    if (empty($wordsFinded)) {
        dd("No hay malas palabras");
    }
    else{
        dd($wordsFinded);
    }

});


Route::get('redirect/{provider}', 'AccountController@github_redirect');
// Get back to redirect url
Route::get('login/{provider}', 'AccountController@github');
Route::get('/termsAndConditions', [
    'as' => 'account.termsConditions',
    'uses' => 'AccountController@termsConditions'
]);

Route::post('/changeNameUser', [
    'as' => 'account.changeNameUser',
    'uses' => 'AccountController@changeNameUser'
]);

//Route::get('/notice/{id}', 'NoticesController@oneNotice');

Route::get('/notice/{id}', [
    'as' => 'notices.oneNotice',
    'uses' => 'NoticesController@oneNotice'
]);
Route::post('/findUsername', [
    'as' => 'welcome.findUsername',
    'uses' => 'WelcomeController@findUsername'
]);
Route::get('/phpinfo', function(){
    return phpinfo();
});



Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',

]);

Route::group(['middleware' => 'auth'],function(){


    Route::group(['middleware' => 'role:super'],function() {
        //susped account
        Route::post('/activeAccount', [
            'as' => 'users.activeAccount',
            'uses' => 'UsersController@activeAccount'
        ]);
        Route::get('/getNotices', [
            'as' => 'notices.getNotices',
            'uses' => 'NoticesController@getNotices'
        ]);
        Route::get('/getAddNotice', [
            'as' => 'notices.getAddNotice',
            'uses' => 'NoticesController@getAddNotice'
        ]);

        Route::get('/getNotices', [
            'as' => 'notices.getNotices',
            'uses' => 'NoticesController@getNotices'
        ]);

        Route::post('/addNotice', [
            'as' => 'notices.addNotice',
            'uses' => 'NoticesController@addNotice'
        ]);

        Route::delete('/deleteNotice/{id}', [
            'as' => 'notices.deleteNotice',
            'uses' => 'NoticesController@deleteNotice'
        ]);

        Route::post('/updateNotice', [
            'as' => 'notices.updateNotice',
            'uses' => 'NoticesController@updateNotice'
        ]);

        Route::get('/getAddProblemSetter', [
            'as' => 'users.getAddProblemSetter',
            'uses' => 'UsersController@getAddProblemSetter'
        ]);

        Route::post('/addProblemSetter', [
            'as' => 'users.addProblemSetter',
            'uses' => 'UsersController@addProblemSetter'
        ]);

        Route::get('/showJudges', [
            'as' => 'judges.showJudges',
            'uses' => 'JudgesController@showJudges'
        ]);

        Route::get('/deleteJudge/{id}', [
            'as' => 'judges.deleteJudge',
            'uses' => 'JudgesController@deleteJudge'
        ]);
        Route::post('/updateJudge/{id}', [
            'as' => 'judges.updateJudge',
            'uses' => 'JudgesController@updateJudge'
        ]);

        Route::get('/suspendAccount', [
            'as' => 'user.suspendAccount',
            'uses' => 'UsersController@suspendAccount'
        ]);
        Route::post('/reactiveAccount', [
            'as' => 'user.reactiveAccount',
            'uses' => 'UsersController@reactiveAccount'
        ]);
        Route::get('/getUsers', [
            'as' => 'user.getUsers',
            'uses' => 'UsersController@getUsers'
        ]);
        Route::post('/plusWarning', [
            'as' => 'user.plusWarning',
            'uses' => 'WarningsController@validateWarning'
        ]);



    });
    Route::group(['middleware' => 'role:problem'],function() {

        Route::post('/addProblem', [
            'as' => 'problem.addProblem',
            'uses' => 'ProblemsController@addProblem'
        ]);

        Route::get('/addFormProblem', [
            'as' => 'problem.addFormProblem',
            'uses' => 'ProblemsController@addFormProblem'
        ]);

        Route::get('/deleteProblem/{id}', [
            'as' => 'problem.deleteProblem',
            'uses' => 'ProblemsController@deleteProblem'
        ]);
        Route::post('/updateProblem/{id}', [
            'as' => 'problem.updateProblem',
            'uses' => 'ProblemsController@updateProblem'
        ]);
        Route::get('/updateGetProblem/{id}', [
            'as' => 'problem.updateGetProblem',
            'uses' => 'ProblemsController@updateGetProblem'
        ]);

        Route::get('/myProblems', [
            'as' => 'problem.myProblems',
            'uses' => 'ProblemsController@myProblems'
        ]);

        Route::post('/similarProblems/{cadena}', [
            'as' => 'problem.similarProblems',
            'uses' => 'ProblemsController@similarProblems'
        ]);

        Route::post('/similarTags/{cadena}', [
            'as' => 'problem.similarTags',
            'uses' => 'ProblemsController@similarTags'
        ]);


        Route::get('/findPromovidos', [
            'as' => 'users.findPromovidos',
            'uses' => 'UsersController@findPromovidos'
        ]);

        Route::get('/viewPromotion', [
            'as' => 'users.viewPromotion',
            'uses' => 'UsersController@viewPromotion'
        ]);
        Route::post('/promotion', [ //+ y -
            'as' => 'users.promotion',
            'uses' => 'UsersController@promotion'
        ]);

        Route::get('/showWarning', [
            'as' => 'warning.showWarning',
            'uses' => 'WarningsController@showWarning'
        ]);

        Route::post('/ignoreWarning', [
            'as' => 'warning.ignoreWarning',
            'uses' => 'WarningsController@ignoreWarning'
        ]);

        Route::get('/showResolution', [
            'as' => 'warning.showResolution',
            'uses' => 'WarningsController@showResolution'
        ]);

        Route::post('/resolution', [
            'as' => 'warning.resolution',
            'uses' => 'WarningsController@resolution'
        ]);

        Route::post('/addJudge', [
            'as' => 'judges.addJudge',
            'uses' => 'JudgesController@addJudge'
        ]);
        Route::get('/getZipProblemMultimedia/{idProblem}', [
            'as' => 'problem.multimediaZip',
            'uses' => 'ProblemsController@getZipMultimediaProblem'
        ]);

    });


    Route::group(['middleware' => 'role:solver'],function() {



        Route::post('/addSolution', [ //peticion para agregar solucion
            'as' => 'solution.addSolution',
            'uses' => 'SolutionsController@addSolution'
        ]);

        Route::get('/addFormSolution/idProblem:{idProblem}', [ //muestra formulario para agregar solucion
            'as' => 'solution.getFormSolution',
            'uses' => 'SolutionsController@getFormSolution'
        ]);

        Route::get('/partialSolutions', [ //muestra formulario para agregar solucion
            'as' => 'solution.partialsSolutions',
            'uses' => 'SolutionsController@partialSolutions'
        ]);

        Route::get('/deleteSolution/{id}', [
            'as' => 'solution.deleteSolution',
            'uses' => 'SolutionsController@deleteSolution'
        ]);

        Route::get('/getUpdateSolution/{id}', [
            'as' => 'solution.getUpdateSolution',
            'uses' => 'SolutionsController@getUpdateSolution'
        ]);
        Route::post('/updateSolution', [
            'as' => 'solution.updateSolution',
            'uses' => 'SolutionsController@updateSolution'
        ]);

        Route::get('/mySolutions', [
            'as' => 'solution.mySolutions',
            'uses' => 'SolutionsController@mySolutions'
        ]);
        Route::get('/showSolution/{id}', [ //para guest
            'as' => 'solution.showSolution',
            'uses' => 'SolutionsController@showSolution'
        ]);

        Route::post('/suspendAccount', [
            'as' => 'users.suspendAccount',
            'uses' => 'UsersController@suspendAccount'
        ]);

        Route::get('/addWarning/{id}{type}', [ //si es 1 es problema si es 0 es solución
            'as' => 'warning.getAddWarning',
            'uses' => 'WarningsController@getAddWarning'
        ]);
        Route::post('/addWarning', [ //si es 1 es problema si es 0 es solución
            'as' => 'warning.addWarning',
            'uses' => 'WarningsController@addWarning'
        ]);

        Route::get('/myWarnings', [
            'as' => 'warning.myWarnings',
            'uses' => 'WarningsController@myWarnings'
        ]);
        Route::get('/miPerfil', [
            'as' => 'users.myPerfil',
            'uses' => 'UsersController@myPerfil'
        ]);
        Route::post('/addlike/{id}', [
            'as' => 'likes.addLike',
            'uses' => 'LikesController@addLike'
        ]);

        Route::delete('/dislike/{id}', [
            'as' => 'likes.disLike',
            'uses' => 'LikesController@disLike'
        ]);

        Route::get('/solutionsOrdered', [ //para guest
            'as' => 'solutions.orderSolutions',
            'uses' => 'SolutionsController@orderSolutions'
        ]);
        Route::get('/getZipSolutionMultimedia/{idProblem}/{idSolution}', [
            'as' => 'solution.multimediaZip',
            'uses' => 'SolutionsController@getZipMultimediaSolution'
        ]);

        Route::post('/ignoreWarning', [
            'as' => 'warning.ignoreWarning',
            'uses' => 'WarningsController@ignoreWarning'
        ]);

        Route::get('/deleteWarning/{id}', [
            'as' => 'warning.deleteWarning',
            'uses' => 'WarningsController@deleteWarning'
        ]);

        Route::post('/deView', [
            'as' => 'notification.deView',
            'uses' => 'NotificationsController@deView'
        ]);

        Route::post('/findUserLikes', [
            'as' => 'user.findUserLikes',
            'uses' => 'UsersController@findUserLikes'
        ]);


    });
    Route::get('/allProblems', [
        'as' => 'problem.allProblems',
        'uses' => 'ProblemsController@allProblems'
    ]);

    Route::get('/findProblem', [
        'as' => 'problem.findProblem',
        'uses' => 'ProblemsController@findProblem'
    ]);

    Route::get('/showProblem/{id}', [ //para guest
        'as' => 'problem.showProblem',
        'uses' => 'ProblemsController@showProblem'
    ]);


});
