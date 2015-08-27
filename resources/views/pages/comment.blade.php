@extends('app')
@section('title') Comments :: @parent @stop
@section('content')
<div class="container col-md-8 col-md-offset-2" ng-app="commentApp" ng-controller="mainController">
    <!-- PAGE TITLE =============================================== -->
    <div class="page-header">
        <h2>Laravel and Angular Single Page Application</h2>
        <h4>Commenting System</h4>
    </div>
    <!-- NEW COMMENT FORM =============================================== -->
    <form ng-submit="submitComment()"> <!-- ng-submit will disable the default form action and use our function -->

        <!-- AUTHOR -->
        <div class="form-group">
            <input type="text" class="form-control input-sm" name="author" ng-model="commentData.author" placeholder="Name">
        </div>

        <!-- COMMENT TEXT -->
        <div class="form-group">
            <input type="text" class="form-control input-lg" name="comment" ng-model="commentData.text" placeholder="Say what you have to say">
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>
    </form>

    <!-- LOADING ICON =============================================== -->
    <!-- show loading icon if the loading variable is set to true -->
    <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

    <!-- THE COMMENTS =============================================== -->
    <!-- hide these comments if the loading variable is true -->

    <table class="table table-striped table-hover" width="100%">
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Text</th>
            <th></td>
        </tr>
        <tr ng-repeat="comment in comments">
            <td>@{{ comment.id }}</td>
            <td>@{{ comment.author }}</td>
            <td>@{{ comment.text }}</td>
            <td><a href="#" ng-click="deleteComment(comment.id)" class="text-muted">Delete</a></td>
        </tr>
    </table>

</div>
@endsection
